<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
    <script src="{{ asset('js/jquery.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e9f9be7bc1.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                        <a class="navbar-brand" href="{{url('/')}}">MajuMundurClothing !</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                          <span class="navbar-toggler-icon"></span>
                        </button>
                        @guest
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                          <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{url('/home')}}">Home</a>
                            </li>
                            <li class="nav-item active">
                              <a class="nav-link" href="{{url('/products')}}">Products</a>
                            </li>
                            
                           
                          </ul>
                          
                        {{-- carts icon --}}
                          <img src="{{asset('img/cart-img.png')}}" class="m-2 mr-3 Cart" width="25" alt="image">

                          <a class="btn btn-outline-success m-2 mr-3" href="{{ route('login') }}">{{ __('Login') }}</a>
                          @if (Route::has('register'))
                          <a class="btn btn-outline-primary my-2 my-sm-0" href="{{ route('register') }}">{{ __('Register') }}</a>
                          @endif
                          @else
                          <div class="collapse navbar-collapse" id="navbarSupportedContent">
                              <ul class="navbar-nav mr-auto">
                                  <li class="nav-item active">
                                      <a class="nav-link" href="{{url('/home')}}">Home</a>
                                    </li>
                                    <li class="nav-item active">
                                        <a class="nav-link" href="{{url('/products')}}">Products</a>
                                    </li>
                                    <li class="nav-item active">
                                        <a class="nav-link" href="{{url('/myvoucher')}}">My Voucher</a>
                                    </li>
                                    
                                </ul>
                          </div>
                        <img src="{{asset('img/cart-img.png')}}" class="m-2 mr-3 Cart" width="25" alt="image">
                          <div class="nav-item dropdown">
                                <a id="nav-item dropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                                
                            </div>
                        @endguest
                        </div>
                </div>
            </nav>
            <div id="sidebar" class="cart_open">
                    <i class="fa fa-arrow-circle-left" id="cart_close" aria-hidden="true"></i>
                    <h3>Your Cart</h3>
                    <hr>
                    <div class="isiCart">
                        <div class="CartItems">
                            {{-- cart items will be upload here --}}
                        </div>           
                        <a href="{{url('/cart')}}" class="btn btn-success">My Cart</a>
                        <hr>
                </div>
            </div>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
