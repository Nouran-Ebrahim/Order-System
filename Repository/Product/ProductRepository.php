<?php


namespace Repository\Product;


use App\Models\Product;


class ProductRepository
{

    private $productModel;


    public function __construct()
    {
        $this->productModel = new Product();
    }

    public function create(array $data)
    {

        $product = $this->productModel->create($data);


        return $product->fresh();
    }

    public function update(array $data)
    {

        // dd($data);
        $product = $this->productModel->find($data['id']);

        $product->update($data);

        return $product->fresh();
    }

    public function find($id, $relation = [])
    {
        return $this->productModel->whereId($id)->with($relation)->first();
    }


    public function all($relation = [])
    {

        $product = $this->productModel->with($relation)->get();

        return $product;

    }


}
