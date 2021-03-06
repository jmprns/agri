<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Stp;
use App\Seller;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('product.index')
                ->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check = Product::where('name', $request->product)->get()->count();

        if($check != 0){
            return redirect()->back()->with('error', 'Product already added.');
        }

        Product::create([
            'name' => $request->product
        ]);

        return redirect()->back()->with('success', 'Product has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $update = Product::find($request->pid);
        $update->name = $request->name;
        $update->save();

        return redirect()->back()->with('success', 'Product has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        Stp::where('product_id', $id)->delete();
        return redirect()->back()->with('success', 'Product has been deleted.');
    }

    public function print()
    {
        $sellers = Seller::all();
        return view('product.print')
                ->with('sellers', $sellers);
    }
}
