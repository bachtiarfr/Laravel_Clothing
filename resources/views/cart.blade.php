
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="{{url('/')}}"> Home</a> / <a href="{{url('/cart')}}"> Cart</a> / <a href="{{url('/')}}"> Checkout</a>
            <hr/>
   
            <div class="card mt-2">
                <div class="card-body">
                    Trade My Point !
                    <div class="row justify-content-center">

                        <div class="col-md-12 mt-2">
                                <div class="card">
                                        <div class="site-section m-2">
                                                <div class="container">
                                                    <div class="row mb-5">
                                                        <form class="col-md-12" method="post">
                                                            <div class="site-blocks-table">
                                                                <table class="table table-bordered text-center m-2">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="product-thumbnail">Product ID</th>
                                                                            <th class="product-thumbnail">Product Name</th>
                                                                            <th class="product-thumbnail">Quantities</th>
                                                                            <th class="product-thumbnail">Product Price</th>
                                                                            <th class="product-thumbnail">Total / Items</th>
                                                                            <th class="product-thumbnail">Remove</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="isiTable">
                                                                        {{-- all customer cart will display here --}}
                                                                        
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </form>
                                                    </div>
                                            
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="row mb-5">
                                                                
                                                                <div class="col-md-6">
                                                                    <a class="btn btn-outline-primary btn-sm btn-block" href="{{url('/products')}}">Continue Shopping</a>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="col-md-6 pl-5">
                                                            <div class="row justify-content-end">
                                                                <div class="col-md-7">
                                                                    <div class="row">
                                                                        <div class="col-md-12 text-right border-bottom mb-5">
                                                                            <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-6">
                                                                            <span class="text-black">Total</span>
                                                                        </div>
                                                                        <div class="col-md-6 text-right">
                                                                               <strong class="text-black" id="tot">Rp. {{$total->total}} ,-</strong>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <button class="btn btn-primary btn-lg btn-block" onclick="window.location='{{url('checkout')}}'">Proceed To Checkout</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
