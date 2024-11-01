@php
    $settings = getSettings();
    $social = getSocialMediaLink();
@endphp
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $settings->app_name }}:: @yield('title', 'Home Page')</title>
    <link rel="shortcut icon" href="{{ public_asset('assets/front/img/favicon.png') }}" />
    <!-- FAVICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css" />
    <link rel="stylesheet" href="{{ public_asset('assets/front/css/bulma.css') }}" />
    <link rel="stylesheet" href="{{ public_asset('assets/front/css/bulma-steps.min.css') }}" />
    <link rel="stylesheet" href="{{ public_asset('assets/front/css/style.css') }}" />

    <link rel="stylesheet" href="{{ public_asset('assets/front/css/bulma-carousel.min.css') }}" />

    <!-- LUX BAR// NAVBAR -->
    <link rel="stylesheet" href="{{ public_asset('assets/front/css/luxbar.css') }}" />

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,900|Roboto:300" rel="stylesheet" />

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous" />

    <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"></script>

    <link rel="stylesheet" href="{{ public_asset('assets/front/css/carousel.css') }}" />

    <style>
        .luxbar-item.active a {
            background-color: #007bff;
            /* Change to your desired active background color */
            color: #ffffff !important;
            /* Active link text color */
            font-weight: bold;
            /* Make the text bold */
            border-bottom: 3px solid #0056b3;
            /* Optional underline effect */
            transition: background-color 0.3s ease, color 0.3s ease;
            /* Smooth transition */
        }
    </style>
    @stack('styles')
</head>

<body>
    <!-- START OF NAVBAR
///////////////////////////////////////////////////////////////-->
    @include('layouts.header')

    @yield('content')

    <br /><br /><br />

    <!-- Footer
############################################-->
    <section class="">
        <footer>
            <div class="container">
                <div class="columns">
                    <div class="column">
                        <img class="footer-logo" src="{{ public_asset($settings->header_image) }}" alt="footer-logo" />
                    </div>

                    <div class="column">
                        <div class="flinks has-text-centered">
                            <ul>
                                <li>
                                    <a href="{{ url('') }}">HOME</a>
                                    <a href="{{ route('front.gallery') }}">GALLERY</a>
                                    <a href="{{ route('front.contact') }}">Contact</a>
                                    {{-- <a href="registration.html">Register</a> --}}
                                    <br />
                                    {{-- <span class="span-pp"><a href="privacypol.html">Privacy Policy</a></span> --}}
                                </li>
                            </ul>
                        </div>

                        <div class="footer-social-links has-text-centered">
                            <br />

                            <div class="has-text-centered social-header">
                                <h1>STAY UP TO DATE WITH US</h1>
                            </div>

                            <ul>
                                <li>
                                    <a target="_blank" href="#">
                                        <i class="fab fa-facebook-square"></i>
                                    </a>

                                    <a target="_blank" href="#">
                                        <i class="fab fa-youtube"></i>
                                    </a>

                                    <a target="_blank" href="#">
                                        <i class="fab fa-instagram"></i>
                                    </a>

                                    <a target="_blank" href="#">
                                        <i class="fab fa-twitter"></i>
                                    </a>

                                    <a target="_blank" href="#">
                                        <i class="fab fa-snapchat-ghost"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </section>

    <!-- Javascript for Nav menu
############################################-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="{{ public_asset('assets/front/js/jquery-1.11.2.min.js') }}"></script>
    <script type="text/javascript" src="{{ public_asset('assets/front/js/validator.min.js') }}"></script>
    <script type="text/javascript" src="{{ public_asset('assets/front/js/form-scripts.js') }}"></script>

    <!-- SCRIPTS FOR SPONSORSHIP CAROUSEL -->
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ public_asset('assets/front/js/carousel.js') }}"></script>
</body>

</html>
