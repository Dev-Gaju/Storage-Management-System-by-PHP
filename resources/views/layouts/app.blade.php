<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" ></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel custom-navber">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}" style="color: white">
                    <img src={{url('img/logo.png')}} style="height: 28px;">Cold Storage
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                       
                        <!-- Authentication Links -->
                        @if(Auth::guard('admin')->check())
                        <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: white">
                                    {{ Auth::guard('admin')->user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{url('admin/home')}}"><i class="fa fa-qq pull-right"></i> Dashboard</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                             @elseif(Auth::guard('service_provider')->check())
                        <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: white">
                                    {{ Auth::guard('service_provider')->user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{url('provider/post_list')}}"><i class="fa fa-qq pull-right"></i> Post List</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @elseif(Auth::guard('web')->check())
                        <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: white">
                                    {{ Auth::guard('web')->user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{url('booking_list')}}"><i class="fa fa-qq pull-right"></i> Dashboard</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @else
                            <li class="nav-item dropdown margin-top">
                                <a href="#" class="dropdown-toggle color-white" data-toggle="dropdown" role="button" aria-expanded="false" >{{ __('Login') }}</a>
                               
                             

                                <ul class="dropdown-menu" role="menu">
                                    <li class="dropdown-item">
                                        <a href="{{ route('provider_login') }}">
                                            Service Provider
                                        </a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a href="{{ route('client_login') }}">
                                            Customer
                                        </a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a href="{{ route('admin_loginpanel') }}">
                                            Admin
                                        </a>
                                    </li>
                                </ul>
                      
                          
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link color-white" style="margin-left: 15px;" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @endguest
                         <li class="nav-item">
                            <a href="{{url('about_us')}}" class="nav-link " style="margin-right: 30px;color:white">About Us</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
      {{--footer--}}
      
     <div class="row">
        <div class="col-md-12" style="background-color: black;color: white;text-align: center;padding: 10px;">All Rights Reserved @ Tech Planet <a href="https://www.facebook.com/ethi.hanif"><img src="{{url('../img/fb.png')}}" style=" height: 26px;"></a></div>
         
    
   </div>
</body>
</html>


