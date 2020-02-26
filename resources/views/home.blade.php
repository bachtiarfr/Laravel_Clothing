@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="{{url('/')}}"> Home</a>
            <hr/>
            <div class="card">
                <div class="card-body btn-warning text-center">
                <h2>Maju Mundur Cloth !</h2>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-body text-center">
                    <div class="row justify-content-center">
                        <i class="fas fa-shipping-fast fa-2x ml-5" style="color:Dodgerblue"></i> <p class="ml-1">Free Shiping ongkir</p>
                        <i class="fa fa-gift fa-2x ml-5" style="color:Dodgerblue"></i> <p class="ml-1">Free Reward</p>
                        <i class="fa fa-check fa-2x ml-5" style="color:Dodgerblue"></i> <p class="ml-1">Trusted</p>

                    </div>
                </div>
            </div>
            <div class="card mt-2">
                
                <div class="card-body">
                    Trade My Points !
                    <div class="row justify-content-center">

                        <div class="col-md-12 mt-2">
                            @foreach ($reward_list as $list)
                            <div class="card">
                                <div class="card-body btn-primary text-center mt-2">
                                    <h1>{{$list->details}} <h3>({{$list->point}} Point)</h3> </h1>
                                    @if (Auth::check())
                                <button class="btn btn-success AddVoucher" 
                                data-voucher="{{ $list->id }}">Trade</button>
                                @else
                                <a class="btn btn-success" href="{{ route('login')  }}">Trade
                                </a>
                                @endif 
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
