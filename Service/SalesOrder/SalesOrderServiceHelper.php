<?php


namespace Service\SalesOrder;


use Illuminate\Validation\Rule;


trait SalesOrderServiceHelper
{

    protected function validationCreate($data)
    {
        return validator($data, [
            'order_number' => 'required',
            'date' => 'required',
            'customer_id' => 'required',
            'price_list_id' => 'required',
            'lines.*.price' => 'required',
            'lines.*.quantity' => 'required|numeric|min:1',
            'lines.*.total' => 'required',
            'lines.*.description' => 'required',
            'lines.*.product_id' => 'required',
        ], [
            'lines.*.price.required' => 'The price field is required.',
            'lines.*.total.required' => 'The total field is required.',
            'lines.*.quantity.required' => 'The quantity field is required.',
            'lines.*.quantity.numeric' => 'The quantity field must be number.',
            'lines.*.quantity.min' => 'The quantity field must be postive number.',
            'lines.*.description.required' => 'The description field is required.',
            'lines.*.product_id.required' => 'The product field is required.',
            'customer_id.required' => 'The customer code field is required.',
            'price_list_id.required' => 'The price list field is required.',
        ]);
    }

    protected function validationUpdate($data)
    {
        return validator($data, [
            'order_number' => 'required',
            'date' => 'required',
            'customer_id' => 'required',
            'price_list_id' => 'required',
            'lines.*.price' => 'required',
            'lines.*.quantity' => 'required|numeric|min:1',
            'lines.*.total' => 'required',
            'lines.*.description' => 'required',
            'lines.*.product_id' => 'required',
        ], [
            'lines.*.price.required' => 'The price field is required.',
            'lines.*.total.required' => 'The total field is required.',
            'lines.*.quantity.required' => 'The quantity field is required.',
            'lines.*.quantity.numeric' => 'The quantity field must be number.',
            'lines.*.quantity.min' => 'The quantity field must be postive number.',
            'lines.*.description.required' => 'The description field is required.',
            'lines.*.product_id.required' => 'The product field is required.',
            'customer_id.required' => 'The customer code field is required.',
            'price_list_id.required' => 'The price list field is required.',
        ]);
    }
}
