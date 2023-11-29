<?php


namespace Service\PriceList;

use Illuminate\Support\Facades\DB;

use Repository\PriceList\PriceListRepository;

class PriceListService
{

    use PriceListServiceHelper;

    protected $PriceListRepository;

    public function __construct()
    {
        $this->PriceListRepository = new PriceListRepository();
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

            $item = $this->PriceListRepository->create($data);

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
            $item = $this->PriceListRepository->update($id, $data);


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
            $items = $this->PriceListRepository->all($relation);
            return $items;
        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }

    public function hasProducts()
    {
        // dd(1);
        try {
            $items = $this->PriceListRepository->hasProducts();
            return $items;
        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }

    public function find($id, $relation = [])
    {
        try {
            $item = $this->PriceListRepository->find($id, $relation);
            return $item;
        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }

    public function delete($id)
    {
        // dd($id);
        try {
            $item = $this->PriceListRepository->find($id);

            $item->delete();

        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }

}
