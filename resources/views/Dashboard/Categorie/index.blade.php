@extends('Dashboard.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Categorie Lists</h3>
                    <a href="{{url('Dashboard/Categories/create')}}" class="btn btn-success">add new categorie</a>
                </div>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Categorie ID</th>
                        <th scope="col">Categorie Name</th>
                        <th scope="col">Handle</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorie as $item)
                      <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>
                        <form action="{{url('Dashboard/Categories',$item->id)}}" method="POST" style='display:inline-block'>
                            @method("delete")
                            @csrf
                            <button class="btn btn-danger btn-delete" id="btnHapusProduct" data-id="{{ $item->id }}">Delete</button>
                        </form>
                        <a href="{{url('Dashboard/Categories/edit',$item->id)}}" class="btn btn-primary" id="addToCart">Edit</a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                
            </div>
        </div>
    </div>
</div>
@endsection
