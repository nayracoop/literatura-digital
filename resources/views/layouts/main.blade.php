<!DOCTYPE html>
<html lang="es"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Escrituras digitales | @yield('title')</title>

@push('stylesheets')
  <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset('css/escrituras.css')}}" rel="stylesheet">
@endpush 
@stack('stylesheets')
</head>
<body>
  @include('layouts.menu')
  <div class="container">
  @include('snippets.about')   

    <hr>
    @include('snippets.voted_stories')    
    <hr>
    @include('layouts.footer')    

  </div>
@push('javascript')
  <script src="{{ asset('js/jquery.min.js')}}"></script>
  <script src="{{ asset('js/bootstrap.min.js')}}"></script>
@endpush 
@stack('javascript')
</body>
</html>