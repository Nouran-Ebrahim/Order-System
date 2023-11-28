<?php

namespace App\Http\Controllers;

use App\Models\Line;
use App\Models\PriceList;
use App\Models\SalesOrder;
use Illuminate\Http\Request;
use Service\SalesOrder\SalesOrderService;
use ViewModel\SalesOrder\SalesOrderViewModel;

class SalesOrderController extends Controller
{
    private $SalesOrderService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin')->except(['create','store','ajax_products','priceListData']);

        $this->SalesOrderService = new SalesOrderService();
    }
    public function index()
    {
        $ralation = ['customer', 'priceList', 'lines'];
        $headers = $this->SalesOrderService->all($ralation);
        // dd($SalesOrders);
        return view('SalesOrder.index', ['headers' => $headers]);
    }

    public function create()
    {
        $viewModel = new SalesOrderViewModel;
        $OrderNumber = $this->getTrx(8);
        return view('SalesOrder.create', ['viewModel' => $viewModel, 'OrderNumber' => $OrderNumber]);
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $SalesOrders = $this->SalesOrderService->create($request->all());

        if ($SalesOrders['validation_errors'])
            return redirect()->back()->withInput()->withErrors($SalesOrders['validation_errors']);

        if (auth()->user()->isAdmin == 0) {
            return redirect('home');

        } else {
            return redirect('salesOrders')->with('created', 'created');
        }

    }

    public function show($id)
    {
        $lines = Line::where('header_id', $id)->with(['product', 'header'])->get();
        // dd($lines);
        $sum = 0;
        foreach ($lines as $line) {
            $sum += $line->total;
        }
        return view('SalesOrder.linesDetails', ['lines' => $lines, 'sum' => $sum]);

    }
    public function getTrx($length = 12)
    {
        $characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function edit($id)
    {
        $ralation = ['customer', 'priceList', 'lines'];
        $SalesOrder = $this->SalesOrderService->find($id, $ralation);
        $viewModel = new SalesOrderViewModel;
        return view('SalesOrder.edit', ['SalesOrder' => $SalesOrder, 'viewModel' => $viewModel]);
    }
    public function ajax_products(Request $request)
    {
        $priceList = PriceList::where('id', $request->id)->with('products')->first();
        $header = $this->SalesOrderService->findBy('price_list_id', $request->id);
        $linesProducts = Line::where('header_id', $header->id)->with('product')->get()->pluck('product_id');
        $products = $priceList->products;
        // dd($linesProducts);
        return response()->json(['products' => $products, 'linesProducts' => $linesProducts]);
    }

    public function priceListData(Request $request)
    {
        $priceList = PriceList::where('id', $request->id)->first();

        return response()->json($priceList);
    }
    public function update($id, Request $request)
    {
        $SalesOrder = $this->SalesOrderService->update($id, $request->all());
        // dd($SalesOrder);
        if ($SalesOrder['validation_errors'])
            return redirect()->back()->withInput()->withErrors($SalesOrder['validation_errors']);

        return redirect('salesOrders')->with('updated', 'updated');
    }

    public function destroy($id)
    {
        $ralation = ['lines'];
        $this->SalesOrderService->delete($id, $ralation);

        return redirect()->back()->with('Delete', 'Delete');
    }
}
