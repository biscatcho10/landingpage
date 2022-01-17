<!DOCTYPE html>
<html lang="en">

{{ $landingData->facebook_pixel }}

<head>
    {{ $landingData->google_analytics }}
    {{ $landingData->google_tag_manager_head }}

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$type}} landing page</title>
    <link rel="icon" href="{{ asset('assets/img/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <meta name="title" content="{{ $landingData->seo_title }}">
    <meta name="description" content="{{ $landingData->seo_description }}">
    <meta name="keywords" content="{{ $landingData->seo_keywords }}">


    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-
    alpha/css/bootstrap.css" rel="stylesheet">

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

   <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

</head>


<body>
    {{ $landingData->google_tag_manager_body }}

    <!-- start section contact  -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="top_sec mb-5">
                        <h2 class="title h-100 mb-3 mb-md-0">{{ $landingData->title }}</h2>
                        <div class="logo d-flex mb-5 mb-md-0">
                            <img src="{{ asset('assets/img/logo.png') }}" alt="">
                        </div>
                        <p class="mb-0 pl-lg-4"> {{ $landingData->description }} </p>
                    </div>
                </div>
                <!-- start left sec  -->
                <div class="col-md-6">
                    <!-- start form  -->
                    <form action="{{ route('save.land') }}" method="POST">
                        @csrf

                        <input type="hidden" name="type" value="{{ $type }}">

                        <!-- start input -->
                        <div class="par_input">
                            <label for="">
                                <span class="active"></span>
                                Exhibition
                            </label>
                            <input type="text" placeholder="" value="NPE Ex Riyadh 2022">
                        </div>
                        <!-- start input -->
                        <div class="par_input">
                            <label for="">
                                <span></span>
                                Full Name
                            </label>
                            <input type="text" placeholder="please write Your Name" name="name" value="{{ old('name') }}">
                        </div>
                        <!-- start input -->
                        <div class="par_input">
                            <label for="">
                                <span></span>
                                Nationality
                            </label>
                            <input type="text" placeholder="please write Your Nationality">
                        </div>
                        <!-- start input -->
                        <div class="par_input">
                            <label for="">
                                <span></span>
                                Cell Phone
                            </label>
                            <div class="cont_input d-flex">
                                <input type="text" list="phoneSelect" name="key" class="pSelect">
                                <datalist id="phoneSelect">
                                    @foreach ($keys as $key)
                                        <option value="{{$key}}">
                                    @endforeach
                                </datalist>
                                <input class="inp_phone" name="phone_number" value="{{ old('phone_number') }}" type="tel" placeholder="please write Your cell phone">
                            </div>
                        </div>
                        <!-- start input -->
                        <div class="par_input">
                            <label for="">
                                <span></span>
                                E-Mail
                            </label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="please write Your E-Mail">
                        </div>
                        <!-- start input -->
                        <div class="par_input">
                            <label for="">
                                <span></span>
                                Profession
                            </label>
                            <input type="text" placeholder="please write Your profession">
                        </div>
                        <!-- start input -->
                        <div class="par_input">
                            <label for="">
                                <span></span>
                                How did you
                                hear about us ?
                            </label>
                            <input type="text" list="Selects" name="from_where" placeholder="Please Select">
                            <datalist id="Selects">
                                @foreach ($fromWhere as $reason)
                                    <option value="{{ $reason }}">
                                @endforeach
                            </datalist>
                        </div>
                        <!-- start btn form  -->
                        <button class="btn_form" type="submit">booking</button>
                    </form>
                    <!-- End form  -->
                </div>
                <!-- End left sec  -->

                <!-- start img section -->
                <div class="col-md-6 d-none d-md-block">
                    <div class="img_sec h-100 w-100 position-relative">
                        <img src="{{ asset('assets/img/Landing Page-Desigcopy.png') }}" alt="">
                    </div>
                </div>
                <!-- End img section -->
            </div>
        </div>
    </section>
    <!-- End section contact  -->

</body>

@include('admin.layouts.toaster')

</html>
