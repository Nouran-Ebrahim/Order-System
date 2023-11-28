<?php


namespace Service\Customer;

use Illuminate\Support\Facades\DB;

use Repository\Customer\CustomerRepository;

class CustomerService
{

    use CustomerServiceHelper;

    protected $customerRepository;

    public function __construct()
    {
        $this->customerRepository = new CustomerRepository();
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

            $item = $this->customerRepository->create($data);

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
            $item = $this->customerRepository->update($id, $data);


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
            $items = $this->customerRepository->all($relation);
            return $items;
        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }



    public function find($id, $relation = [])
    {
        try {
            $item = $this->customerRepository->find($id, $relation);
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
            $item = $this->customerRepository->find($id);

            $item->delete();

        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception;
        }
    }

}
