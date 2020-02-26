@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="{{url('/home')}}"> Home </a> / <a href="{{url('/products')}}"> Products </a>
            <hr>
            <div class="card">
                <div class="card-body">
                    product
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-body">
                        <div class="row text-center">
                                @foreach ($products as $item)
                                <div class="col-sm-3 mt-1">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">{{$item->name}}</h5>
                                            <a href="{{url('/products/detail')}}/{{$item->id}}">
                                                <img class="col md-6" src="{{url("product/". $item->image)}}" style="width: 200px" alt="image">
                                            </a>
                                            <p>Rp. {{$item->price}} ,-</p>
                                            @if (Auth::check())
                                                <button class="btn btn-primary AddToCart" 
                                                data-id="{{ $item->id }}" 
                                                data-name="{{ $item->name }}"
                                                data-price="{{ $item->price }}" >Add To Cart</button>
                                                @else
                                                <a class="btn btn-primary" href="{{ route('login')  }}">Add To Cart
                                                </a>
                                            @endif                                     
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
