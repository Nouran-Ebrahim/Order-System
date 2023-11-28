<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Service\Product\ProductService;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $productService;
    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);
        $this->productService = new ProductService();
    }
    public function index()
    {
        $products = $this->productService->all();
        // dd($products);
        return view('product.index', ['products' => $products]);
    }

    public function create()
    {
        return view('product.create');
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $products = $this->productService->create($request->all());
        // dd($products['validation_errors']);
        if ($products['validation_errors'])
            return redirect()->back()->withInput()->withErrors($products['validation_errors']);

        return redirect('products')->with('created', 'created');

    }

    public function show(Product $product)
    {
        //
    }


    public function edit($id)
    {
        $product = $this->productService->find($id);
        return view('product.edit', ['product' => $product]);
    }


    public function update($id, Request $request)
    {
        $product = $this->productService->update($id, $request->all());
        // dd($product);
        if ($product['validation_errors'])
            return redirect()->back()->withInput()->withErrors($product['validation_errors']);

        return redirect('products')->with('updated', 'updated');
    }

    public function destroy($id)
    {

        $this->productService->delete($id);

        return redirect()->back()->with('Delete', 'Delete');
    }
}
