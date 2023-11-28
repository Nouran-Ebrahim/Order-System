<?php


namespace ViewModel\PriceList;


use Service\Product\ProductService;

class PriceListViewModel
{

    public function products()
    {
        return (new ProductService())->all();
    }
}
