<?php


namespace Service\Customer;


use Illuminate\Validation\Rule;


trait CustomerServiceHelper
{

    protected function validationCreate($data)
    {
        return validator($data,[
            'name' => 'required',
            'code' => 'required',
            'country'=>'required',

        ]);
    }
    protected function validationUpdate($data)
    {
        return validator($data,[
            'name' => 'required',
            'code' => 'required',
            'country' => 'required',
        ]);
    }
}
