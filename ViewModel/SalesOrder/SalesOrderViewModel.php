<?php


namespace ViewModel\SalesOrder;


use Service\Customer\CustomerService;
use Service\PriceList\PriceListService;
use Service\Product\ProductService;

class SalesOrderViewModel
{

    public function products()
    {
        return (new ProductService())->all();
    }
    public function pricLists()
    {
        return (new PriceListService())->all();
    }
    public function customers()
    {
        return (new CustomerService())->all();
    }
}
