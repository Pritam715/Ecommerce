<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>OutDoor Fashion</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <!-- Font awesome -->
    <link href="{{asset('Frontend/css/font-awesome.css')}}" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="{{asset('Frontend/css/bootstrap.css')}}" rel="stylesheet">   
    <!-- SmartMenus jQuery Bootstrap Addon CSS -->
    <link href="{{asset('Frontend/css/jquery.smartmenus.bootstrap.css')}}" rel="stylesheet">
    <!-- Product view slider -->
    <link rel="stylesheet" type="text/css" href="{{asset('Frontend/css/jquery.simpleLens.css')}}">    
    <!-- slick slider -->
    <link rel="stylesheet" type="text/css" href="{{asset('Frontend/css/slick.css')}}">
    <!-- price picker slider -->
    <link rel="stylesheet" type="text/css" href="{{asset('Frontend/css/nouislider.css')}}">
    <!-- Theme color -->
    <link id="switcher" href="{{asset('Frontend/css/theme-color/default-theme.css')}}" rel="stylesheet">
    <!-- <link id="switcher" href="css/theme-color/bridge-theme.css" rel="stylesheet"> -->
    <!-- Top Slider CSS -->
    <link href="{{asset('Frontend/css/sequence-theme.modern-slide-in.css')}}" rel="stylesheet" media="all">
    
    <!-- Main style sheet -->
    <link href="{{asset('Frontend/css/style.css')}}" rel="stylesheet">    
    
    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    @stack('css')

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  

  </head>
  <body> 
   
        @yield("header")
        @yield("content")
        @yield("footer")

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="{{asset('Frontend/js/bootstrap.js')}}"></script>  
  <!-- SmartMenus jQuery plugin -->
  <script type="text/javascript" src="{{asset('Frontend/js/jquery.smartmenus.js')}}"></script>
  <!-- SmartMenus jQuery Bootstrap Addon -->
  <script type="text/javascript" src="{{asset('Frontend/js/jquery.smartmenus.bootstrap.js')}}"></script>  
  <!-- To Slider JS -->
  <script src="{{asset('Frontend/js/sequence.js')}}"></script>
  <script src="{{asset('Frontend/js/sequence-theme.modern-slide-in.js')}}"></script>  
  <!-- Product view slider -->
  <script type="text/javascript" src="{{asset('Frontend/js/jquery.simpleGallery.js')}}"></script>
  <script type="text/javascript" src="{{asset('Frontend/js/jquery.simpleLens.js')}}"></script>
  <!-- slick slider -->
  <script type="text/javascript" src="{{asset('Frontend/js/slick.js')}}"></script>
  <!-- Price picker slider -->
  <script type="text/javascript" src="{{asset('Frontend/js/nouislider.js')}}"></script>
 
  <!-- Custom js -->
  <script src="{{asset('Frontend/js/custom.js')}}"></script> 
  @stack('js')

  </body>
</html>