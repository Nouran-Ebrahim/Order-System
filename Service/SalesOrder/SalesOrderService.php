<?php


namespace Service\SalesOrder;

use Illuminate\Support\Facades\DB;

use Repository\SalesOrder\SalesOrderRepository;

class SalesOrderService
{

    use SalesOrderServiceHelper;

    protected $SalesOrderRepository;

    public function __construct()
    {
        $this->SalesOrderRepository = new SalesOrderRepository();
    }

    public function create(array $data)
    {

        try {

            $validation = $this->validationCreate($data);
            if ($validation->fails()) {
                return [
                    'validation_errors' => $validation->getMessageBag(),
                ];

            }

            $item = $this->SalesOrderRepository->create($data);

            return $item;
        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }

    public function update($id, array $data)
    {
        try {

            $validation = $this->validationUpdate($data);
            if ($validation->fails()) {
                return [
                    'validation_errors' => $validation->getMessageBag(),
                ];
            }


            // dd($data);
            $item = $this->SalesOrderRepository->update($id, $data);


            return $item;
        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }

    public function all($relation = [])
    {
        // dd(1);
        try {
            $items = $this->SalesOrderRepository->all($relation);
            return $items;
        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }



    public function find($id, $relation = [])
    {
        try {
            $item = $this->SalesOrderRepository->find($id, $relation);
            return $item;
        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }
    public function findBy($key, $value)
    {
        try {
            $item = $this->SalesOrderRepository->findBy($key, $value);
            return $item;
        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }

    public function delete($id, $ralation = [])
    {
        // dd($id);
        try {
            $item = $this->SalesOrderRepository->find($id, $ralation);

            $item->delete();

        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }

}
