<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class CustomerOrderDetails extends Model
{
    use SoftDeletes;

    public $table = 'customer_orders';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = ['customer_loyalty_id','order_id','products_id','product_units_id','item_quantity','expiry_date','selling_price','special_price','special_price_start_date','special_price_end_date','reject_cancel_reason','order_status','created_by','updated_by','created_at','updated_at'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
