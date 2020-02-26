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
              
                                <div class="border p-3 mb-3">
                                  <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">Direct Bank Transfer</a></h3>
              
                                  <div class="collapse" id="collapsebank">
                                    <div class="py-2">
                                      <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                    </div>
                                  </div>
                                </div>
              
                                <div class="border p-3 mb-3">
                                  <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsecheque" role="button" aria-expanded="false" aria-controls="collapsecheque">Cheque Payment</a></h3>
              
                                  <div class="collapse" id="collapsecheque">
                                    <div class="py-2">
                                      <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                    </div>
                                  </div>
                                </div>
              
                                <div class="border p-3 mb-5">
                                  <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsepaypal" role="button" aria-expanded="false" aria-controls="collapsepaypal">Paypal</a></h3>
              
                                  <div class="collapse" id="collapsepaypal">
                                    <div class="py-2">
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
