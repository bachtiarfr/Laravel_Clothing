@extends('Dashboard.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Product ID</th>
                        <th scope="col">Quantities</th>
                        <th scope="col">Price</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($saleitem as $item)
                      <tr>
                        <td>{{$item->product_id}}</td>
                        <td>{{$item->qty}}</td>
                        <td>{{$item->price}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</div>
@endsection
