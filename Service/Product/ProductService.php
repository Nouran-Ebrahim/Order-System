<?php


namespace Service\Product;

use Illuminate\Support\Facades\DB;

use Repository\Product\productRepository;

class ProductService
{

    use ProductServiceHelper;

    protected $productRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepository();
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

            $item = $this->productRepository->create($data);

            return $item;
        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }

    public function update($id, array $data)
    {
        try {
            $data["id"] = $id;
            $validation = $this->validationUpdate($data);
            if ($validation->fails()) {
                return [
                    'validation_errors' => $validation->getMessageBag(),
                ];
            }


            // dd($data);
            $item = $this->productRepository->update($data);


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
            $items = $this->productRepository->all($relation);
            return $items;
        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }



    public function find($id, $relation = [])
    {
        try {
            $item = $this->productRepository->find($id, $relation);
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
            $item = $this->productRepository->find($id);

            $item->delete();

        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }

}
