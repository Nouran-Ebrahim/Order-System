<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Service\Customer\CustomerService;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $customerService;
    public function __construct()
    {
        $this->middleware(['auth','isAdmin']);
        $this->customerService = new CustomerService();
    }
    public function index()
    {
        $cutomers = $this->customerService->all();
        // dd($cutomers);
        return view('customer.index', ['customers' => $cutomers]);
    }

    public function create()
    {
        return view('customer.create');
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $cutomers = $this->customerService->create($request->all());
        // dd($cutomers['validation_errors']);
        if ($cutomers['validation_errors'])
            return redirect()->back()->withInput()->withErrors($cutomers['validation_errors']);

        return redirect('customers')->with('created', 'created');

    }

    public function show(Customer $customer)
    {
        //
    }


    public function edit($id)
    {
        $cutomer = $this->customerService->find($id);
        return view('customer.edit', ['cutomer' => $cutomer]);
    }


    public function update($id, Request $request)
    {
        $cutomer = $this->customerService->update($id, $request->all());
        // dd($cutomer);
        if ($cutomer['validation_errors'])
            return redirect()->back()->withInput()->withErrors($cutomer['validation_errors']);

        return redirect('customers')->with('updated', 'updated');
    }

    public function destroy($id)
    {

        $this->customerService->delete($id);

        return redirect()->back()->with('Delete', 'Delete');
    }
}
