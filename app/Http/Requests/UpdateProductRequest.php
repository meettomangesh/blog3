<?php

namespace App\Http\Requests;

use App\Product;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        $segments = $this->segments();
        $id = $segments[sizeof($segments) - 1];
        $startDate = strtotime('-1 days', strtotime($this->all()['special_price_start_date']));
        $startDateNew = date('d F Y', $startDate);
        if (!$this->request->get('special_price')) {
            $this->request->set('special_price_start_date', null);
            $this->request->set('special_price_end_date', null);
        }

        $validationRules = [
            /* 'special_price' => ['required_with:special_price_start_date, special_price_end_date'],
            'special_price_start_date' => ['required_with:special_price_end_date','date'],
            'special_price_end_date' => ['required_with:special_price_start_date','date','date_format:d F Y','after:' . $startDateNew], */
            'sku' => ['required','max:50','unique:products,sku,'.$id], //alphaSpaces
            'custom_text' => ['max:20'],
            'product_name' => ['required','max:100'], //alphaSpaces
            /* 'status' => ['required','numeric'] */
        ];
        if ($this->request->get('display_custom_text_or_date') == 2) {
            $validationRules['custom_text'] = ['required','max:20'];
        }
        return $validationRules;
    }
}
