<!DOCTYPE html>
<html lang="en">

{!! $landingData->facebook_pixel !!}

<head>
    {!! $landingData->google_analytics !!}
    {!! $landingData->google_tag_manager_head !!}

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <link rel="icon" href="img/titl-logo.png">
    <link rel="stylesheet" href="{{ asset('assets/css/style2.css') }}">
    <meta name="title" content="{{ $landingData->seo_title }}">
    <meta name="description" content="{{ $landingData->seo_description }}">
    <meta name="keywords" content="{{ $landingData->seo_keywords }}">

    <link href='https://fonts.googleapis.com/css?family=Lato:300,400|Montserrat:700' rel='stylesheet' type='text/css'>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-
    alpha/css/bootstrap.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <style type="text/css">
        body,
        td,
        th {
            font-family: Akkurat-Regular, sans-serif;
        }

        body {
            background-image: url(../My-Task%20-%20EDIT/img/Landing%20Page-Design-1280%20copy.png);
            background-repeat: no-repeat;
            background-position: center;
        }

    </style>
</head>

<body>
    {!! $landingData->google_tag_manager_body !!}


    <header class="site-header" id="header">
        <h1 class="site-header__title" data-lead-id="site-header-title">{{ $landingData->thanks_title }}</h1>
    </header>

    <div class="main-content">
        <i class="fa fa-check main-content__checkmark" id="checkmark"></i>
        <p class="main-content__body" data-lead-id="main-content-body">{{ $landingData->thanks_paragraph }}</p>
    </div>
</body>

@include('admin.layouts.toaster')

</html>
