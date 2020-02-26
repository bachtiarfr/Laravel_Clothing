@extends('Dashboard.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>My Product Lists</h3>
                    <a href="{{url('Dashboard/Products/create')}}" class="btn btn-success">add new Product</a>
                </div>
                <div class="row text-center">
                    @foreach ($products as $item)
                    <div class="col-sm-3 mt-1">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{$item->name}}</h5>
                                <img class="col md-6" src="{{url("product/". $item->image)}}" style="width: 200px" alt="image">
                                <p>Rp. {{$item->price}} ,-</p>
                                <form action="{{url('Dashboard/Products',$item->id)}}" method="POST" style='display:inline-block'>
                                    @method("delete")
                                    @csrf
                                    <button class="btn btn-danger btn-delete" id="btnHapusProduct" data-id="{{ $item->id }}">Delete</button>
                                </form>
                                <a href="{{url('Dashboard/Products/edit',$item->id)}}" class="btn btn-primary" id="addToCart">Edit</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
