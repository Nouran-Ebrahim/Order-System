<?php


namespace Repository\Customer;


use App\Models\Customer;


class CustomerRepository
{

    private $customerModel;


    public function __construct()
    {
        $this->customerModel = new Customer();
    }

    public function create(array $data)
    {

        $customer = $this->customerModel->create($data);


        return $customer->fresh();
    }

    public function update($id,array $data)
    {


        $customer = $this->customerModel->find($id);

        $customer->update($data);

        return $customer->fresh();
    }

    public function find($id, $relation = [])
    {
        return $this->customerModel->whereId($id)->with($relation)->first();
    }


    public function all($relation = [])
    {

        $customer = $this->customerModel->with($relation)->get();

        return $customer;

    }


}
