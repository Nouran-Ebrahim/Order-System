<?php


namespace Service\Product;


use Illuminate\Validation\Rule;


trait ProductServiceHelper
{

    protected function validationCreate($data)
    {
        return validator($data,[
            'name' => 'required',
            'code' => 'required|unique:products,code',


        ]);
    }

    protected function validationUpdate($data)
    {
        // dd($data);
        return validator($data,[
            'name' => 'required',
            'code' => 'required|unique:products,code,'.$data["id"],
        ]);
    }
}
