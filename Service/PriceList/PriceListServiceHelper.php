<?php


namespace Service\PriceList;


use Illuminate\Validation\Rule;


trait PriceListServiceHelper
{

    protected function validationCreate($data)
    {
        return validator($data,[
            'name' => 'required',
            'code' => 'required',
            'description' => 'required',
            'price' => 'required',
            'product_id' => 'required',

        ], [
            'product_id.required' => "The product is required"
        ]);
    }

    protected function validationUpdate($data)
    {
        return validator($data,[
            'name' => 'required',
            'code' => 'required',
            'description' => 'required',
            'price' => 'required',
            'product_id' => 'required',
        ],[
            'product_id.required'=> "The product is required"
        ]);
    }
}
