<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>
    <link rel="stylesheet" href="{{asset('assets/css/mybootstrap.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/color.css')}}">
    <script src="{{asset('assets/JS/tinymce/tinymce.min.js')}}"></script>
    <script>tinymce.init({ selector:'.tinymce' });</script>
</head>
<body>
    <header class="col-md-12">
        <div class="container">
            <div class="col-md-3" >
                <img src="{{asset('assets/Images/logo.png')}}" style="margin:15px 0px 5px 0px; float:left">
            </div>
            <div class="col-md-2 col-md-offset-6">
                @if (!request()->routeIs('index'))
                    <a href="{{route('logout')}}" class="logoutbtn">Logout</a>
                @endif
            </div>
        </div>
    </header>
    <div class="col-md-12" style="background:#1C5978"> 
        <div class="container">
            <div class="col-md-3">
                <p style="color:white; font-weight:bold; font-family:arial; font-size:12px; margin:7px 0px; float:left; letter-spacing:1; word-spacing:3">Friday, 8th June 2012</p>
            </div>
        </div>
    </div>
