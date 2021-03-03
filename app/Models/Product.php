<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;
use App\Models\ProductImages;
use App\Models\ProductInventory;
use App\Models\ProductLocationInventory;
use App\Models\Category;
use App\Models\ProductUnits;
use App\Models\CustomerLoyalty;
use App\Models\CustomerOrders;
use DB;

class Product extends Model
{
    use SoftDeletes;

    public $table = 'products';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = ['brand_id', 'category_id', 'product_name', 'short_description', 'sku', 'expiry_date', 'stock_availability', 'status', 'view_count','created_by','updated_by'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    protected function storeProductImages ($params, $productId, $flag) {
        $images = $params->file('product_images');
        $inputs = $params->all();
        $userId = 0;
        if($flag == 1) {
            $userId = $inputs['created_by'];
        } elseif($flag == 2) {
            $userId = $inputs['updated_by'];
        }
        if ($params->hasFile('product_images')) {
            $path = '/images/products/';
            $i = 0;
            foreach ($images as $item) {
                $var = date_create();
                $time = date_format($var, 'YmdHis');
                $imageName = $time . '-' . $item->getClientOriginalName();
                $item->move(base_path().'/public' . $path, $imageName);
                ProductImages::create(array(
                    'products_id' => $productId,
                    'image_name' => $path.$imageName,
                    'display_order' => $i,
                    'created_by' => $userId
                ));
                $i++;
            }
        }
        return true;
    }

    protected function getProductImages($productId) {
        return ProductImages::select('id','image_name')->where('products_id', $productId)->get();
    }

    protected function removeProductImages($ids) {
        $imageIds = explode(',', $ids);
        foreach($imageIds as $key => $val) {
            $prodImage = ProductImages::select('id','image_name','display_order')->where('id', $val)->get()->toArray();
            if(isset($prodImage[0]['image_name']) && file_exists(public_path($prodImage[0]['image_name']))) {
                unlink(public_path($prodImage[0]['image_name']));
            }
            ProductImages::destroy($val);
        }
        return true;
    }

    protected function storeProductUnits ($params, $productId, $flag) {
        $inputs = $params->all();
        $productUnits = $inputs['unit_ids'];
        $userId = 0;
        if($flag == 1) {
            $userId = $inputs['created_by'];
        } elseif($flag == 2) {
            $userId = $inputs['updated_by'];
        }
        foreach ($productUnits as $item) {
            ProductUnits::create(array(
                'products_id' => $productId,
                'unit_id' => $item,
                'created_by' => $userId
            ));
        }
        return true;
    }

    protected function removeProductUnits($productId) {
        ProductUnits::where('products_id',$productId)->delete();
        return true;
    }

    protected function getProductById($productId) {
        $product = Product::select('id','product_name','category_id')->where('id', $productId)->get()->toArray();
        if(!empty($product[0])) {
            return $product[0];
        }
        return [];
    }

    protected function getProductName($productId) {
        $productName = Product::select('product_name')->where('id', $productId)->where('status', 1)->get()->toArray();
        if(!empty($productName[0])) {
            return $productName[0]['product_name'];
        }
        return '';
    }

    protected function getProductUnits($productId) {
        return ProductUnits::join('unit_master', 'unit_master.id', '=', 'product_units.unit_id')
            ->where('product_units.status', 1)
            ->where('product_units.products_id', $productId)
            ->get(['unit_master.id','unit_master.unit']);
            // ->toArray();
    }

    public function getProductList($params) {
        $queryResult = DB::select('call getProductList(?)', [$params]);
        // $result = collect($queryResult);
        if(sizeof($queryResult) > 0) {
            foreach($queryResult as $key => $val) {
                $productUnits = ProductUnits::join('unit_master', 'unit_master.id', '=', 'product_units.unit_id')
                    ->join('product_location_inventory', 'product_location_inventory.product_units_id', '=', 'product_units.id')
                    ->where('product_units.status', 1)
                    ->where('product_units.products_id', $val->id)
                    ->where('product_units.selling_price', '>', 0)
                    ->where('product_location_inventory.current_quantity', '>', 0)
                    // ->get(['product_units.id','unit_master.unit','TRUNCATE(product_units.selling_price, 2) AS selling_price','product_units.special_price','product_units.min_quantity','product_units.max_quantity','product_location_inventory.current_quantity'])
                    ->select(DB::raw('product_units.id, unit_master.unit, TRUNCATE(product_units.selling_price, 2) AS selling_price, IF(product_units.special_price > 0 AND product_units.special_price_start_date <= CURDATE() AND product_units.special_price_end_date >= CURDATE(), TRUNCATE(product_units.special_price, 2), 0.00)  AS special_price, product_units.special_price_start_date, product_units.special_price_end_date, product_units.min_quantity, product_units.max_quantity, product_location_inventory.current_quantity'))
                    ->get()
                    ->toArray();
                if(sizeof($productUnits) > 0) {
                    $queryResult[$key]->product_units = $productUnits;
                    $queryResult[$key]->product_images = ProductImages::select('image_name')->where('products_id', $val->id)->where('status', 1)->get()->toArray();
                } else {
                    unset($queryResult[$key]);
                }
            }
        }
        return $queryResult;
    }

    public function placeOrder($params) {
        // validate customer
        $customerLoyaltyData = CustomerLoyalty::select('id')->where('id', $params['user_id'])->where('status', 1)->get()->toArray();
        if(sizeof($customerLoyaltyData) == 0 || sizeof($params['products']) == 0) {
            return false;
        }

        $orderAmount = $totalItemQty = 0;
        // validate product
        foreach($params['products'] as $key => $value) {
            $orderAmount = $orderAmount + ((($value['special_price'] > 0) ? $value['special_price'] : $value['selling_price']) * $value['quantity']);
            $totalItemQty = $totalItemQty + $value['quantity'];
            $inputData = json_encode($value);
            $result = DB::select('call validateProduct(?)', [$inputData]);
            $reponse = json_decode($result[0]->response);
            if($reponse->status == "FAILURE" && $reponse->statusCode != 200) {
                return false;
            }
        }

        if($orderAmount != $params['payment_details']['amount']) {
            return false;
        }

        $customerOrdersResponse = CustomerOrders::create(array(
            'customer_loyalty_id' => $params['user_id'],
            'amount' => $params['payment_details']['amount'],
            'discounted_amount' => $params['payment_details']['discounted_amount'],
            'total_items' => sizeof($params['products']),
            'total_items_quantity' => $totalItemQty,
            'shipping_address_id' => $params['delivery_details']['address']['id'],
            'billing_address_id' => $params['delivery_details']['address']['id'],
            'delivery_date' => $params['delivery_details']['date'],
            'created_by' => 1
        ));
        $orderId = $customerOrdersResponse->id;
        foreach($params['products'] as $key => $value) {
            $value['order_id'] = $orderId;
            $value['customer_loyalty_id'] = $params['user_id'];
            $inputData = json_encode($value);
            $result = DB::select('call placeOrderDetails(?)', [$inputData]);
            $reponse = json_decode($result[0]->response);
            if($reponse->status == "FAILURE" && $reponse->statusCode != 200) {
                return false;
            }
        }
        return true;
    }
}
