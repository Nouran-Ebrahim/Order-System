<?php

namespace App\Http\Controllers;

use App\Models\PriceList;
use Illuminate\Http\Request;
use Service\PriceList\PriceListService;
use ViewModel\PriceList\PriceListViewModel;
class PriceListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $PriceListService;
    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);
        $this->PriceListService = new PriceListService();
    }
    public function index()
    {
        $relation = ['products'];
        $PriceLists = $this->PriceListService->all($relation);
        // dd($PriceLists);
        return view('PriceList.index', ['PriceLists' => $PriceLists]);
    }

    public function create()
    {
        $viewModel = new PriceListViewModel;
        return view('PriceList.create',[
            'viewModel'=>$viewModel,
        ]);
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $PriceLists = $this->PriceListService->create($request->all());
        // dd($PriceLists);
        if ($PriceLists['validation_errors'])
            return redirect()->back()->withInput()->withErrors($PriceLists['validation_errors']);

        return redirect('PriceList')->with('created', 'created');

    }

    public function show(PriceList $PriceList)
    {
        //
    }


    public function edit($id)
    {
        $PriceList = $this->PriceListService->find($id);
        $viewModel = new PriceListViewModel;
        $ProductArray = $PriceList->products()->pluck('price_lists_products.product_id')->all();

        return view('PriceList.edit', ['PriceList' => $PriceList, 'viewModel' => $viewModel,'ProductArray'=>$ProductArray]);
    }


    public function update($id, Request $request)
    {
        $PriceList = $this->PriceListService->update($id, $request->all());
        // dd($PriceList);
        if ($PriceList['validation_errors'])
            return redirect()->back()->withInput()->withErrors($PriceList['validation_errors']);

        return redirect('PriceList')->with('updated', 'updated');
    }

    public function destroy($id)
    {

        $this->PriceListService->delete($id);

        return redirect()->back()->with('Delete', 'Delete');
    }
}
