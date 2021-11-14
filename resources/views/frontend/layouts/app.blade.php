<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style media="screen">
    .logo {max-width:35%;padding-top: 0px;width:180px;}
    @media only screen and (max-width: 600px) {
        .cover {display:none}
        .logo {max-width:35%;padding-top: 15px ;width:180px;}

          }
    </style>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&region=bd&language=en&key=AIzaSyCkFKYdC9MIbLPQFKYkReYqKACH0hOLFHU"  type="text/javascript"></script>

</head>
<body>
    <div id="" class="phone-number">
      <div class="header" style="background:#f7f7f7;height:100px;padding:12px;border-bottom:2px dashed #ddd">
        <div class="container">
          <a href="{{url("/")}}"> <img src="cholo.png" class="logo" /> </a>

              @guest
                  <a class="btn btn-md btn-dark float-right" style="margin-top:24px" href="{{ route('login') }}">{{ __('Login') }}</a>
                  @if (Route::has('register'))
                  <a class="btn btn-md btn-success float-right"  style="margin-top:24px;margin-right:12px;margin-left:12px"  href="{{ route('register') }}">{{ __('Register') }}</a>
                  @endif
              @else
                  <a class="btn btn-md btn-danger float-right"  style="margin-top:24px;margin-right:12px;margin-left:12px" href="{{ route('logout') }}"
                      onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                  <a class="btn btn-md btn-success float-right desktop" style="margin-top:24px;" href="{{url('myaccount')}}">My Account</a>

              @endguest
              <a class="btn btn-md btn-dark float-right desktop" style="margin-top:24px;margin-right:12px" href="tel:+8801716903902">Hotline: 01716 903 902</a>

        </div>
      </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

<div class="" style="min-height:72px">

</div>
    <div class="fixed-top mobile" style="background:#303030;min-height:24px;padding:8px;color:white;text-decoration:none" align="center"> <a style="color:white;text-decoration:none" href="tel:+8801716903902">Hotline: 01716 903 902</a> </div>
</body>
</html>
