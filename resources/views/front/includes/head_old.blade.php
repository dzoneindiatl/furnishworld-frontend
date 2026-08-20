<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <title>Furnish World</title>
   <link rel="shortcut icon" href="{{ env('WEBSITE_URL').'uploads/settings/'.@$favIcon->value }}" type="image/x-icon" />
   <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200;0,6..12,300;0,6..12,400;0,6..12,500;0,6..12,600;0,6..12,700;0,6..12,800;0,6..12,900;0,6..12,1000;1,6..12,200;1,6..12,300;1,6..12,400;1,6..12,500;1,6..12,600;1,6..12,700;1,6..12,800;1,6..12,900;1,6..12,1000&display=swap" rel="stylesheet">    
   <!-- CSS FIle-->
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/tejap/css/fontawesome.min.css')}}" type="text/css" />
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/tejap/css/jquery-ui.min.css')}}" type="text/css" />
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/tejap/css/animate.min.css')}}" type="text/css" />
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/tejap/css/fancybox.min.css')}}" type="text/css" />
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/tejap/css/slick.css')}}" type="text/css" />
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/tejap/css/bootstrap.min.css')}}" type="text/css" />
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/tejap/css/style.css')}}" type="text/css" />
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/tejap/css/responsive.css')}}" type="text/css" />

   <!-- Js Library -->
   <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>