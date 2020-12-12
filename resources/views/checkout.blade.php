@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="{{url('/home')}}"> Home </a> / <a href="{{url('/cart')}}"> Cart </a> / <a href="{{url('/checkout')}}"> Checkout </a>
            <hr>
            <div class="card">
                <div class="card-body">
                  <form action=" {{url('/checkout/transaction')}} " method="POST" >
                    @csrf
                    <div class="row">
                      <div class="col-md-6 mb-5 mb-md-0">
                          <h2 class="h3 mb-3 text-black">Your Transaction Details</h2>
                          <div class="p-3 p-lg-5 border">
                            <div class="form-group">
                              <label for="c_country" class="text-black">Country <span class="text-danger">*</span></label>
                              <select id="country" name="country" class="form-control">
                                <option value="">Indonesia</option>    
                                <option value="">bangladesh</option>    
                                <option value="">Algeria</option>    
                                <option value="">Afghanistan</option>    
                                <option value="">Ghana</option>    
                                <option value="">Albania</option>    
                                <option value="">Bahrain</option>    
                                <option value="">Colombia</option>    
                                <option value="">Dominican Republic</option>    
                              </select>
                            </div>
                            
                           
                            <div class="form-group row">
                              <div class="col-md-6">
                                <label for="c_fname" class="text-black">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" style="width: 350px" id="name" name="name">
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-md-12">
                                <label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
                                <textarea name="address" id="address" cols="30" rows="5" class="form-control" placeholder="your address..."></textarea>
                              </div>
                            </div>
              
                            <div class="form-group row">
                              <div class="col-md-6">
                                <label for="c_state_country" class="text-black">City <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" style="width: 350px" id="city" name="city">
                              </div>
                            </div>
                            
                            <div class="form-group row">
                              <div class="col-md-6">
                                <label for="c_state_country" class="text-black">Email Address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" style="width: 350px" id="email" name="email" >
                              </div>
                            </div>
                            
                            <div class="form-group row">
                              <div class="col-md-6">
                                <label for="c_state_country" class="text-black">Phone Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" style="width: 350px" id="phone" name="phone">
                              </div>
                            </div>
                           
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="row mb-5">
                            <div class="col-md-12">
                              <h2 class="h3 mb-3 text-black">Your Order</h2>
                              <div class="p-3 p-lg-5 border">
                                <table class="table site-block-order-table mb-5">
                                  <thead>
                                    <th>Product</th>
                                    <th>Total</th>
                                  </thead>
                                  <tbody>
                                    @foreach ($cart as $item)
                                    <tr>
                                      <td>{{$item->product_name}} <strong class="mx-2">x</strong> {{$item->qty}}</td>
                                      <td>{{$item->price * $item->qty }}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                      <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                                      <td class="text-black font-weight-bold"><strong>{{$total->total}}</strong></td>
                                    </tr>
                                  </tbody>
                                </table>

                                <div class="border p-3 mb-5">
                                  <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapseCheckout" role="button" aria-expanded="false" aria-controls="collapseCheckout">Check Ongkir</a></h3>
              
                                  <div class="collapse" id="collapseCheckout">
                                    <div class="py-2">
                                      <form class="form-horizontal form-ongkir" id="ongkir" method="POST" action="/submit_check_ongkir">
                                        {{-- {{csrf_field()}} --}}
                                        <div class="form-group">
                                            <label class="control-label col-sm-3">Provinsi:</label>
                                            <div class="col">
                                                <select class="form-control" id="province_origin" name="province_origin" required="">
                                                    <option value="">--Provinsi-- </option>
                                                    @foreach ($provinces as $province => $value)
                                                    <option value="{{$province}}">{{$value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3">Kota Asal:</label>
                                            <div class="col">
                                                <select class="form-control" id="city_origin" name="city_origin" required="">
                                                    <option>--Kota-- </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3">Provinsi Tujuan</label>
                                            <div class="col">
                                                <select class="form-control" id="province_destination" name="province_destination" required="">
                                                    <option value="">--Provinsi-- </option>
                                                    @foreach ($provinces as $province => $value)
                                                    <option value="{{$province}}">{{$value}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3">Kota Tujuan</label>
                                            <div class="col">
                                                <select class="form-control" id="city_destination" name="city_destination" required="">
                                                <option></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                          <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                            <label class="control-label col-sm-3">Kurir</label>
                                            <div class="col">
                                                <select class="form-control" id="courier" name="courier" required="">
                                                    <option value="pos">POS INDONESIA</option>
                                                    <option value="jne">JNE</option>
                                                    <option value="tiki">TIKI</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-3">Berat (Kg)</label>
                                            <div class="col">
                                                <input type="text" class="form-control" id="weight" name="weight" required="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-8">
                                                <input type="button" class="btn btn-default form-check-ongkir" value="Cek Ongkir">
                                            </div>
                                        </div>
                                      </form> 
                                    <div class="panel panel-default">
                                      <div class="panel-body">
                                        <table width="100%">
                                          <tr>
                                            <td width="30%"><b>Kurir</b> </td>
                                            <td>:</td>
                                            <td class="show_courier"></td>
                                          </tr>
                                          <tr>
                                            <td>Dari</td>
                                            <td>:</td>
                                            <td class="show_city_origin"></td>
                                          </tr>
                                          <tr>
                                            <td>Tujuan</td>
                                            <td>: </td>
                                            <td class="show_city_destination"></td>
                                          </tr>
                                          <tr>
                                            <td>Berat (Kg)</td>
                                            <td>: </td>
                                            <td class="show_weight"></td>
                                          </tr>
                                        </table>
                                        <table class="table table-striped table-bordered ">
                                          <thead> 
                                            <tr>
                                              <th>Nama Layanan</th>
                                              <th>Tarif</th>
                                              <th>Estimasi pengiriman</th>
                                            </tr>
                                          </thead>
                                        <tbody class="show_data_cost">  
                                        </tbody> 
                                        </table>
                                      </div>
                                      </div>
                                      <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                    </div>
                                  </div>
                                </div>
                                  <button type="submit" class="btn btn-primary btn-lg btn-block">Place Order</button>
                              </form>
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
