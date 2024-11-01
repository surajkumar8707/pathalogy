<footer>
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class=" col-md-4">
                    <h3>About US</h3>
                    <p style="text-align: justify;">
                        At Guest House, we pride ourselves on offering exceptional hospitality and comfort in a serene and welcoming environment. Located in the heart of Uttrakhand, our hotel combines luxury with a home-like atmosphere to provide an unforgettable stay for both business and leisure travelers.
                    </p>

                </div>
                <div class="col-md-4">
                    <h3>Menu Link</h3>
                    <ul class="link_menu">
                        <li class="{{ isActiveRoute('front.home') }}">
                            <a href="{{ route('front.home') }}">Home</a>
                        </li>
                        <li class="{{ isActiveRoute('front.about') }}">
                            <a href="{{ route('front.about') }}">About</a>
                        </li>
                        <li class="{{ isActiveRoute('front.room') }}">
                            <a href="{{ route('front.room') }}">Our room</a>
                        </li>
                        <li class="{{ isActiveRoute('front.gallery') }}">
                            <a href="{{ route('front.gallery') }}">Gallery</a>
                        </li>
                        <li class="{{ isActiveRoute('front.contact') }}">
                            <a href="{{ route('front.contact') }}">Contact Us</a>
                        </li>
                        <li class="{{ isActiveRoute('front.terms.condition') }}">
                            <a href="{{ route('front.terms.condition') }}">Terms and Condition</a>
                        </li>
                        <li class="{{ isActiveRoute('front.privacy.policy') }}">
                            <a href="{{ route('front.privacy.policy') }}">Privacy Policy</a>
                        </li>
                    </ul>
                </div>
                <div class=" col-md-4">
                    <h3>Contact US</h3>
                    <ul class="conta">
                        <li><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $settings->address }}</li>
                        <li><i class="fa fa-mobile" aria-hidden="true"></i> <a href="tel:{{ $settings->contact }}">
                                {{ $settings->contact }} </a></li>
                        <li> <i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:{{ $settings->email }}"> {{ $settings->email }} </a></li>
                        <li>
                            <ul class="social_icon">
                                @if ($social->facebook_show == 1)
                                    <li><a href="{{ $social->facebook }}"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    </li>
                                @endif
                                @if ($social->twitter_show == 1)
                                    <li><a href="{{ $social->twitter }}"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                    </li>
                                @endif
                                @if ($social->linkedin_show == 1)
                                    <li><a href="{{ $social->linkedin }}"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                    </li>
                                @endif
                                @if ($social->youTube_show == 1)
                                    <li><a href="{{ $social->youTube }}"><i class="fa fa-youtube-play"
                                                aria-hidden="true"></i></a></li>
                                @endif
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 offset-md-1">

                        <p>
                            &copy; {{ date('Y') }} All Rights Reserved.
                            {{-- Design by <a href="https://html.design/"> Free Html
                                Templates</a>
                            <br><br>
                            Distributed by <a href="https://themewagon.com/" target="_blank">ThemeWagon</a> --}}
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>


<script>
    toastr.options = {
        closeButton: true,
        debug: true,
        newestOnTop: true,
        progressBar: true,
        positionClass: "toast-top-right",
        preventDuplicates: true,
        onclick: null,
        timeOut: 10000, // Time in milliseconds (5 seconds)
        extendedTimeOut: 5000, // Time in milliseconds for extended timeout (1 second)
    };
</script>

@if (session('success'))
    <script>
        toastr.success("{!! session('success') !!}", "Success !");
    </script>
@endif

@if (session('error'))
    <script>
        toastr.error("{!! session('error') !!}", "Error !");
    </script>
@endif

@if (session('info'))
    <script>
        toastr.info("{!! session('info') !!}", "Info !");
    </script>
@endif

@if (session('warning'))
    <script>
        toastr.warning("{!! session('warning') !!}", "Warning !");
    </script>
@endif
