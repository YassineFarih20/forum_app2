 <!doctype html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">

     <!-- CSRF Token -->
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <title>@yield('title')</title>

     <!-- Scripts -->
     @vite(['resources/sass/app.scss', 'resources/js/app.js'])
 </head>

 <body>
     <div class="loader-bg">
         <div class="loader-track">
             <div class="loader-fill"></div>
         </div>
     </div>
     @if (Auth::user()->hasRole(1))
         @include('includes/adminNavMenu')
         @include('includes/adminHeader')
     @endif
     @yield('content')
 </body>

 <script src="{{ asset('lib/vendor-all.min.js') }}"></script>
 <script src="{{ asset('lib/pcoded.min.js') }}"></script>

 </html>
