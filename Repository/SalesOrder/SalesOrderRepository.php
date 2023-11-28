<?php


namespace Repository\SalesOrder;


use App\Models\Header;

use App\Models\Line;

class SalesOrderRepository
{

    private $headerModel;
    private $lineModel;

    public function __construct()
    {
        $this->headerModel = new Header();
        $this->lineModel = new Line();
    }

    public function create(array $data)
    {
        // dd($data);
        $header = $this->headerModel->create([
            'order_number' => $data['order_number'],
            'date' => $data['date'],
            'customer_id' => $data['customer_id'],
            'price_list_id' => $data['price_list_id'],
        ]);
        foreach ($data['lines'] as $line) {
            $this->lineModel->create([
                'header_id' => $header->id,
                'price' => $line['price'],
                'quantity' => $line['quantity'],
                'total' => $line['total'],
                'description' => $line['description'],
                'product_id' => $line['product_id'],
            ]);
        }

        return $header->fresh();
    }

    public function update($id, array $data)
    {

        $header = $this->headerModel->find($id);
        $header->lines()->delete();


        $header->update([
            'order_number' => $data['order_number'],
            'date' => $data['date'],
            'customer_id' => $data['customer_id'],
            'price_list_id' => $data['price_list_id'],
        ]);

        foreach ($data['lines'] as $line) {
            $this->lineModel->create([
                'header_id' => $header->id,
                'price' => $line['price'],
                'quantity' => $line['quantity'],
                'total' => $line['total'],
                'description' => $line['description'],
                'product_id' => $line['product_id'],
            ]);
        }


        return $header->fresh();
    }

    public function find($id, $relation = [])
    {
        return $this->headerModel->whereId($id)->with($relation)->first();
    }
    public function findBy($key, $value)
    {
        return $this->headerModel->where($key,$value)->first();
    }

    public function all($relation = [])
    {

        $header = $this->headerModel->with($relation)->orderBy('id', 'desc')->get();
        // dd($header);
        return $header;

    }


}
