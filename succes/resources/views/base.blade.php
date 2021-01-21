<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="La boutique qui vend 100% du made in france ">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
   @yield('title')
    <!-- Bootstrap core CSS -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/ferme.css')}}">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="{{asset('assets/css/carousel.css')}}" rel="stylesheet">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">La Ferme MAYA</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/ferme">Board</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('quinsommes')}}">Qui sommes nous?</a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="{{route('contact')}}">Nous contactez</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
                
            </ul>

            <div class="navbar-item-custom">
                @php
                 if((Auth::user())== "" ){
                // dd('here on');

                 return redirect('/');

                 }
                 @endphp
                
                 @if ($json ?? "admin")
                 
                <a href="{{route('login')}}">Mon Compte<small>({{Auth::user()->name}})</small> </a>  | 
              <div>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Deconnexion') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
              </div>
                 
               @else 
                <a href="{{route('register')}}">Inscription</a>  | <a href="{{route('login')}}">Connexion</a>
                @endif    

            </div>
            {{--<a href="{{path('cart')}}"><img src="{{ asset('assets/img/shopping-cart.png')}}" alt="Mon panier" class="cart-icon"></a>--}}

            
           
            <!--<form class="form-inline mt-2 mt-md-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Votre recherche" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
            </form>-->
        </div>
    </nav>
</header>

<main role="main">


    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->
    <div class="container marketing mt-5">

      @yield('content')  

    </div><!-- /.container -->

    <!-- FOOTER -->
    <footer class="footer-custom">
        <p>
            &copy; 2017-2020 La Ferme MAYA, savoir-faire et savoir-être à partger<br>
            <small>
                La Ferme 100% made in Cote D'ivoire<br>
                 <a href="#">Privacy</a> &middot; <a href="#">Terms</a>
            </small>
        </p>
    </footer>
</main>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="{{asset('assets/js/bootstrap.bundle.js')}}"></script>
</body>
</html>