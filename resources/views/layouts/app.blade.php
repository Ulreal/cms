<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>WEB DYNAMIQUE</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <?php
        if (isset($Config['theme'])) {
            switch($Config['theme']) {
                case 'theme1': $theme = 'https://bootswatch.com/cerulean/bootstrap.min.css'; break;
                case 'theme2': $theme = 'https://bootswatch.com/cosmo/bootstrap.min.css'; break;
                case 'theme3': $theme = 'https://bootswatch.com/flatly/bootstrap.min.css'; break;
                case 'theme4': $theme = 'https://bootswatch.com/united/bootstrap.min.css'; break;
                case 'theme5': $theme = 'https://bootswatch.com/simplex/bootstrap.min.css'; break;
                case 'theme6': $theme = 'https://bootswatch.com/darkly/bootstrap.min.css'; break;

                default: $theme = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'; break;
            }
        } else {
            $theme = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css';
        }
    ?>

    <link rel="stylesheet" href="{{$theme}}" >
    {!! HTML::style('css/app.css') !!}
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
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
                <a class="navbar-brand" href="{{ url('/') }}">
                    Société Mickaël &amp; Co.
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                @if ($Config['menu_header'] == 'true')
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Accueil</a></li>
                    @if (Auth::check())
                        <li>{{link_to_route('post.index', 'Forum')}}</li>
                        <li>{{link_to_route('chat.index', 'Chat')}}</li>
                        <li>{{link_to_route('news.index', 'News')}}</li>

                        @if (Entrust::hasRole('admin'))
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Administration <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{route('admin.config.index')}}">Configurations</a></li>
                                <li><a href="{{route('admin.forum.index')}}">Forum</a></li>
                                <li><a href="{{route('admin.config.index')}}">Chat</a></li>
                                <li><a href="{{route('admin.config.index')}}">News</a></li>
                            </ul>
                        </li>
                        @endif
                    @endif
                </ul>
                @endif

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @if (Session::has('flash_notification.message'))
        <div class="container">
            <div class="alert alert-{{ Session::get('flash_notification.level') }}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                {{ Session::get('flash_notification.message') }}
            </div>
        </div>
    @endif

    <div class="container">
        <div class="row">
            @if ($Config['menu_gauche'] == 'true')
                <div class="col-md-3">
                    <div class="sidebar-module">
                        <h4>Partner</h4>
                        <ol class="list-unstyled">
                            <li><a href="http://google.com">Google</a></li>
                            <li><a href="http://www.instic.fr/">Instic</a></li>
                        </ol>
                    </div>
                </div>
            @endif
            <div class="col-md-{{$size_content}}">
                @yield('content')
            </div>
            @if ($Config['menu_droite'] == 'true')
                <div class="col-md-3">
                    <div class="sidebar-module">
                        <h4>Social Network</h4>
                        <ol class="list-unstyled">
                            <li><a href="http://facebook.com">Facebook</a></li>
                            <li><a href="http://twitter.com">Twitter</a></li>
                        </ol>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @if ($Config['menu_footer'] == 'true')
        <footer class="footer">
            <div class="container">
                <p class="text-muted">
                    @if (!empty($Config['text_footer']))
                        {{$Config['text_footer']}}
                    @else
                        Copyright © 2016
                    @endif
                </p>
            </div>
        </footer>
    @endif

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
