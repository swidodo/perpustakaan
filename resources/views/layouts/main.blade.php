<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - Perpustakaan</title>
    
    <link rel="stylesheet" href="{{asset('assets/css/main/app.css')}}">
    <link rel="shortcut icon" href="{{asset('assets/images/logo/favicon.svg')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('assets/images/logo/favicon.png')}}" type="image/png">
    <link rel="stylesheet" href="{{asset('assets/css/shared/iconly.css')}}">
</head>

<body>
    <div id="app">
      @include('includes.sidebar')
       @yield('pages-content') 
      @include('includes.footer')
      @include('includes.script')
   </div>
</body>
</html>
