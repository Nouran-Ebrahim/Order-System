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

    public function update($id,array $data)
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

        return $PriceList;

    }


}
