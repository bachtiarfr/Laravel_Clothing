<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Categorie;
use Session;
use File;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $products = Product::all();
        return view('Dashboard.Product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_categorie = Categorie::all();
        return view('Dashboard.Product.create', compact('list_categorie'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1000',
            'name' => 'required',
            'code' => 'required|unique:products,code',
            'stock' => 'required|integer',
            'price' => 'required|integer',
            'categorie_id' => 'required|integer'
        ]);
        // Menyimpan Ke database
        $product = new Product;
        $product->code = $request->input("code");
        $product->name =  $request->input("name");
        $product->price =  $request->input("price");
        $product->stock =  $request->input("stock");
        $product->categorie_id  = $request->input("categorie_id");
        $product->save();

        //upload file to Folder storage
        $request->file('image')->move(public_path('product'), $product->id . '.jpg');
        $product->image = $product->id . '.jpg';

        $product->save();
        Session::flash("success", "berhasil Menambah Product");
        return redirect()->to("Dashboard/Products");
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
        $product = Product::find($id);
        $list_categorie = Categorie::all();
        $categorie = Categorie::where('id', $product);
        return view('Dashboard.Product.edit', compact('product', 'list_categorie', 'categorie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $this->validate($request, [
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1000',
        //     'name' => 'required',
        //     'code' => 'required',
        //     'stock' => 'required|integer',
        //     'price' => 'required|integer',
        //     'categorie_id' => 'required|integer'
        // ]);
        $product = Product::find($id);
        $product->code = $request->input("code");
        $product->name =  $request->input("name");
        $product->price =  $request->input("price");
        $product->stock =  $request->input("stock");
        $product->categorie_id  = $request->input("categorie_id");
        $product->save();

        $request->file('image')->move(public_path('product'), $product->id . '.jpg');
        $product->image = $product->id . '.jpg';

        $product->save();
        Session::flash("success", "berhasil Update Prodduct");
        return redirect()->to("Dashboard/Products");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Product = Product::where('id', $id)->first();
        $Product->delete();

        return back();
    }
}
