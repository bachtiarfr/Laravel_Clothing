<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        $response = [
            'message' => 'Products View',
            'data' => $product
        ];
        return response($response);
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
        $this->validate($request, [
            'code' => 'required',
            'image' => 'required',
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'categorie_id' => 'required'
        ]);

        $code = $request->input("code");
        $image =  $request->input("image");
        $name =  $request->input("name");
        $price =  $request->input("price");
        $stock =  $request->input("stock");
        $categorie_id  = $request->input("categorie_id");

        $product = new Product([
            'code' => $code,
            'image' => $image,
            'name' => $name,
            'price' => $price,
            'stock' => $stock,
            'categorie_id' => $categorie_id
        ]);

        if ($product->save()) {
            $product->view_product = [
                'href' => 'api/Products/' . $product->id,
                'method' => 'GET'
            ];
            $response = [
                'message' => 'Product Created',
                'data' => $product
            ];
            return response($response, 201);
        }

        $response = [
            'message' => 'Error while Creating',
            'data' => $product
        ];

        return response($response, 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = \App\Product::where('id', $id)->get();

        if (count($data) > 0) { //mengecek apakah data kosong atau tidak
            $res['message'] = "Success!";
            $res['values'] = $data;
            return response($res);
        } else {
            $res['message'] = "Failed!";
            return response($res);
        }
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
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'code' => 'required',
            'image' => 'required',
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'categorie_id' => 'required'
        ]);

        $code = $request->input("code");
        $image =  $request->input("image");
        $name =  $request->input("name");
        $price =  $request->input("price");
        $stock =  $request->input("stock");
        $categorie_id  = $request->input("categorie_id");

        $product = Product::findOrFail($id);

        $product->code = $code;
        $product->image = $image;
        $product->name = $name;
        $product->price = $price;
        $product->stock = $stock;
        $product->categorie_id = $categorie_id;

        if (!$product->update()) {
            return response()->json([
                'message' => 'error update product'
            ], 404);
        }

        $product->view_product = [
            'href' => 'api/Products/' . $product->id,
            'method' => 'GET'
        ];

        $response = [
            'message' => 'product updated',
            'product' => $product
        ];

        return response($response, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $product = Product::findOrFail($id);

        if (!$product->delete()) {

            return response()->json([
                'message' => 'delete failed'
            ], 404);
        }
        $response = [
            'message' => 'product deleted',
            'create' => [
                'href' => 'api/Products',
                'method' => 'POST'
            ]
        ];

        return response($response, 201);
    }
}
