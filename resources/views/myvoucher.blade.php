@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="{{url('/')}}"> Home</a>
            <hr/>
            <div class="card">
                    @guest
                        <div class="card-body">
                            My Point : 
                        </div>
                    @else
                    <div class="card-body">
                            My Point : 
                            @foreach ($reward as $item)
                                {{$item->point}}
                            @endforeach
                        </div>
                    
                  @endguest
               
                        
            </div>
            <div class="card mt-2">
                <div class="card-body">
                    My Voucher !
                    <div class="row justify-content-center">
                        <div class="col-md-12 mt-2">
                            @foreach ($reward_list as $list)
                            <div class="card">
                                <div class="card-body btn-primary text-center mt-2">
                                    <h1>{{$list->id}}</h1>
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
