<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Categorie;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorie = Categorie::all();
        $response = [
            'message' => 'Categorie View',
            'data' => $categorie
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
            'name' => 'required',
            'status' => 'required'
        ]);

        $name = $request->input("name");
        $status =  $request->input("status");


        $categorie = new Categorie([
            'name' => $name,
            'status' => $status
        ]);

        if ($categorie->save()) {
            $categorie->view_categorie = [
                'href' => 'api/Categorie/' . $categorie->id,
                'method' => 'GET'
            ];
            $response = [
                'message' => 'Product Created',
                'data' => $categorie
            ];
            return response($response, 201);
        }

        $response = [
            'message' => 'Error while Creating',
            'data' => $categorie
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
        $data = \App\Categorie::where('id', $id)->get();

        if (count($data) > 0) {
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
            'name' => 'required',
            'status' => 'required'
        ]);

        $name = $request->input("name");
        $status =  $request->input("status");

        $categorie = Categorie::findOrFail($id);

        $categorie->name = $name;
        $categorie->status = $status;


        if (!$categorie->update()) {
            return response()->json([
                'message' => 'error update categorie'
            ], 404);
        }

        $categorie->view_categorie = [
            'href' => 'api/Categorie/' . $categorie->id,
            'method' => 'GET'
        ];

        $response = [
            'message' => 'categorie updated',
            'categorie' => $categorie
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
        $categorie = Categorie::findOrFail($id);

        if (!$categorie->delete()) {

            return response()->json([
                'message' => 'delete failed'
            ], 404);
        }
        $response = [
            'message' => 'categorie deleted',
            'create' => [
                'href' => 'api/Categorie',
                'method' => 'POST'
            ]
        ];

        return response($response, 201);
    }
}
