<?php


namespace Repository\PriceList;


use App\Models\PriceList;


class PriceListRepository
{

    private $PriceListModel;


    public function __construct()
    {
        $this->PriceListModel = new PriceList();
    }

    public function create(array $data)
    {

        $PriceList = $this->PriceListModel->create($data);
        $PriceList->products()->sync($data['product_id']);
        return $PriceList->fresh();
    }

    public function update($id, array $data)
    {

        // dd($data);
        $PriceList = $this->PriceListModel->find($id);

        $PriceList->products()->sync($data['product_id']);
        return $PriceList->fresh();
    }

    public function find($id, $relation = [])
    {
        return $this->PriceListModel->whereId($id)->with($relation)->first();
    }


    public function all($relation = [])
    {

        $PriceList = $this->PriceListModel->with($relation)->get();
        //if you want also delete price list that doesn't have any products do this code
        // $PriceList = $this->PriceListModel->withCount('products')->get();
        // $newList = [];
        // foreach ($PriceList as $list) {
        //     if ($list->products_count == 0) {
        //         $list->destroy($list->id);
        //     } else {
        //          $newList[]= $list;
        //     }
        // }
        // dd($newList);
        return $PriceList;

    }
    public function hasProducts()
    {
        $PriceList = $this->PriceListModel->has('products')->get();

        return $PriceList;
    }

}
