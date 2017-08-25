<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Gestion Des Chèques</title>

    <!-- Styles -->

    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery-3.2.1.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

</head>
<body>

    <div id="app">
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                  <!-- Collapsed Hamburger -->
                   <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                       <span class="sr-only">Toggle Navigation</span>
                       <span class="icon-bar"></span>
                       <span class="icon-bar"></span>
                       <span class="icon-bar"></span>
                   </button>
                    <!-- Branding Image -->
             <a class="navbar-brand" href="{{ url('/') }}"><i class="fa fa-home" aria-hidden="true"></i>&nbsp; Gestion Des Chèques</a>

                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li role="presentation"><a href="{{ route('login') }}">
                              Login
                              <i class="fa fa-sign-in" aria-hidden="true"></i>
                            </a></li>
                            <li><a href="{{ route('register') }}">
                              Register
                              <i class="fa fa-registered" aria-hidden="true"></i>
                            </a></li>
                        @else

                            <li><a href="{{ route('cheques.index') }}">Chèques</a></li-->
                            <li><a href="{{ route('fournisseurs.index') }}">Fournisseurs</a></li>
                            <li><a href="{{ route('carnets.index') }}">Carnets</a></li>
                            <li><a href="{{ route('profile.index') }}">Profile</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                  <i class="fa fa-user" aria-hidden="true"></i>&nbsp;
                                 {{ ucfirst(Auth::user()->prenom) }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                            &nbsp;
                                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <br>
        <br>
        <br>


        @yield('content')
    </div>

    <!-- Scripts -->


      @yield('script')

</script>
</body>
</html>
