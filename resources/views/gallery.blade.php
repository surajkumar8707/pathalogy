@extends('layouts.app')
@section('title', getSettings()->app_name . ':: Gallery Page')
@section('content')
    <br>
    <br>
    <br>
    <br>
    <br>
    <!-- GOOGLE FORM
                                            ///////////////////////////////////////////////////////////////-->

    <section id="registration" class="section">
        <h1 class="title-head has-text-centered">
            Gallery
        </h1>

        <br>

        <div class="container contain-gall">
            <!-- FIRST ROW -->
            <div class="columns gallery-test">
                <div class="column galtest">
                    <figure class="image is-256x256">
                        <a href="{{ public_asset('assets/front/img/gckcimages/GCKC1.jpg') }}" data-lightbox="GCKC">
                            <img src="{{ public_asset('assets/front/img/gckcimages/GCKC1.jpg') }}">
                        </a>
                    </figure>
                </div>

                <div class="column galtest">
                    <figure class="image is-256x256">
                        <a href="{{ public_asset('assets/front/img/gckcimages/GCKC2.jpg') }}" data-lightbox="GCKC">
                            <img src="{{ public_asset('assets/front/img/gckcimages/GCKC2.jpg') }}">
                        </a>
                    </figure>
                </div>

                <div class="column galtest">
                    <figure class="image is-256x256">
                        <a href="{{ public_asset('assets/front/img/gckcimages/GCKC3.jpg') }}" data-lightbox="GCKC">
                            <img src="{{ public_asset('assets/front/img/gckcimages/GCKC3.jpg') }}">
                        </a>
                    </figure>
                </div>

                <div class="column galtest">
                    <figure class="image is-256x256">
                        <a href="{{ public_asset('assets/front/img/gckcimages/GCKC4.jpg') }}" data-lightbox="GCKC">
                            <img src="{{ public_asset('assets/front/img/gckcimages/GCKC4.jpg') }}">
                        </a>
                    </figure>
                </div>

                <div class="column galtest">
                    <figure class="image is-256x256">
                        <a href="{{ public_asset('assets/front/img/gckcimages/GCKC5.jpg') }}" data-lightbox="GCKC">
                            <img src="{{ public_asset('assets/front/img/gckcimages/GCKC5.jpg') }}">
                        </a>
                    </figure>
                </div>
            </div>

            <!-- SECOND ROW -->
            <div class="columns gallery-test">
                <div class="column galtest">
                    <figure class="image is-256x256">
                        <a href="{{ public_asset('assets/front/img/gckcimages/GCKC6.jpg') }}" data-lightbox="GCKC">
                            <img src="{{ public_asset('assets/front/img/gckcimages/GCKC6.jpg') }}">
                        </a>
                    </figure>
                </div>

                <div class="column galtest">
                    <figure class="image is-256x256">
                        <a href="{{ public_asset('assets/front/img/gckcimages/GCKC7.jpg') }}" data-lightbox="GCKC">
                            <img src="{{ public_asset('assets/front/img/gckcimages/GCKC7.jpg') }}">
                        </a>
                    </figure>
                </div>

                <div class="column galtest">
                    <figure class="image is-256x256">
                        <a href="{{ public_asset('assets/front/img/gckcimages/GCKC8.jpg') }}" data-lightbox="GCKC">
                            <img src="{{ public_asset('assets/front/img/gckcimages/GCKC8.jpg') }}">
                        </a>
                    </figure>
                </div>

                <div class="column galtest">
                    <figure class="image is-256x256">
                        <a href="{{ public_asset('assets/front/img/gckcimages/GCKC9.jpg') }}" data-lightbox="GCKC">
                            <img src="{{ public_asset('assets/front/img/gckcimages/GCKC9.jpg') }}">
                        </a>
                    </figure>
                </div>

                <div class="column galtest">
                    <figure class="image is-256x256">
                        <a href="{{ public_asset('assets/front/img/gckcimages/GCKC10.jpg') }}" data-lightbox="GCKC">
                            <img src="{{ public_asset('assets/front/img/gckcimages/GCKC10.jpg') }}">
                        </a>
                    </figure>
                </div>
            </div>

            <!-- THRID ROW-->
            <div class="columns gallery-test">
                <div class="column galtest">
                    <figure class="image is-256x256">
                        <a href="{{ public_asset('assets/front/img/gckcimages/GCKC11.jpg') }}" data-lightbox="GCKC">
                            <img src="{{ public_asset('assets/front/img/gckcimages/GCKC11.jpg') }}">
                        </a>
                    </figure>
                </div>

                <div class="column galtest">
                    <figure class="image is-256x256">
                        <a href="{{ public_asset('assets/front/img/gckcimages/GCKC12.jpg') }}" data-lightbox="GCKC">
                            <img src="{{ public_asset('assets/front/img/gckcimages/GCKC13.jpg') }}">
                        </a>
                    </figure>
                </div>

                <div class="column galtest">
                    <figure class="image is-256x256">
                        <a href="{{ public_asset('assets/front/img/gckcimages/GCKC13.jpg') }}" data-lightbox="GCKC">
                            <img src="{{ public_asset('assets/front/img/gckcimages/GCKC13.jpg') }}">
                        </a>
                    </figure>
                </div>

                <div class="column galtest">
                    <figure class="image is-256x256">
                        <a href="{{ public_asset('assets/front/img/gckcimages/GCKC14.jpg') }}" data-lightbox="GCKC">
                            <img src="{{ public_asset('assets/front/img/gckcimages/GCKC14.jpg') }}">
                        </a>
                    </figure>
                </div>

                <div class="column galtest">
                    <figure class="image is-256x256">
                        <a href="{{ public_asset('assets/front/img/gckcimages/GCKC15.jpg') }}" data-lightbox="GCKC">
                            <img src="{{ public_asset('assets/front/img/gckcimages/GCKC15.jpg') }}">
                        </a>
                    </figure>
                </div>
            </div>

            <!-- FOURTH ROW -->
            <div class="columns gallery-test">
                <div class="column galtest">
                    <figure class="image is-256x256">
                        <a href="{{ public_asset('assets/front/img/gckcimages/GCKC16.jpg') }}" data-lightbox="GCKC">
                            <img src="{{ public_asset('assets/front/img/gckcimages/GCKC16.jpg') }}">
                        </a>
                    </figure>
                </div>

                <div class="column galtest">
                    <figure class="image is-256x256">
                        <a href="{{ public_asset('assets/front/img/gckcimages/GCKC17.jpg') }}" data-lightbox="GCKC">
                            <img src="{{ public_asset('assets/front/img/gckcimages/GCKC17.jpg') }}">
                        </a>
                    </figure>
                </div>

                <div class="column galtest">
                    <figure class="image is-256x256">
                        <a href="{{ public_asset('assets/front/img/gckcimages/GCKC18.jpg') }}" data-lightbox="GCKC">
                            <img src="{{ public_asset('assets/front/img/gckcimages/GCKC18.jpg') }}">
                        </a>
                    </figure>
                </div>

                <div class="column galtest">
                    <figure class="image is-256x256">
                        <a href="{{ public_asset('assets/front/img/gckcimages/GCKC19.jpg') }}" data-lightbox="GCKC">
                            <img src="{{ public_asset('assets/front/img/gckcimages/GCKC19.jpg') }}">
                        </a>
                    </figure>
                </div>

                <div class="column galtest">
                    <figure class="image is-256x256">
                        <a href="{{ public_asset('assets/front/img/gckcimages/GCKC20.jpg') }}" data-lightbox="GCKC">
                            <img src="{{ public_asset('assets/front/img/gckcimages/GCKC20.jpg') }}">
                        </a>
                    </figure>
                </div>
            </div>

            <!-- FIFTH ROW -->
            <div class="columns gallery-test">
                <div class="column galtest">
                    <figure class="image is-256x256">
                        <a href="{{ public_asset('assets/front/img/gckcimages/GCKC21.jpg') }}" data-lightbox="GCKC">
                            <img src="{{ public_asset('assets/front/img/gckcimages/GCKC21.jpg') }}">
                        </a>
                    </figure>
                </div>

                <div class="column galtest">
                    <figure class="image is-256x256">
                        <a href="{{ public_asset('assets/front/img/gckcimages/GCKC22.jpg') }}" data-lightbox="GCKC">
                            <img src="{{ public_asset('assets/front/img/gckcimages/GCKC22.jpg') }}">
                        </a>
                    </figure>
                </div>

                <div class="column galtest">
                    <figure class="image is-256x256">
                        <a href="{{ public_asset('assets/front/img/gckcimages/GCKC23.jpg') }}" data-lightbox="GCKC">
                            <img src="{{ public_asset('assets/front/img/gckcimages/GCKC23.jpg') }}">
                        </a>
                    </figure>
                </div>

                <div class="column galtest">
                    <figure class="image is-256x256">
                        <a href="{{ public_asset('assets/front/img/gckcimages/GCKC24.jpg') }}" data-lightbox="GCKC">
                            <img src="{{ public_asset('assets/front/img/gckcimages/GCKC24.jpg') }}">
                        </a>
                    </figure>
                </div>

                <div class="column galtest">
                    <figure class="image is-256x256">
                        <a href="{{ public_asset('assets/front/img/gckcimages/GCKC25.jpg') }}" data-lightbox="GCKC">
                            <img src="{{ public_asset('assets/front/img/gckcimages/GCKC25.jpg') }}">
                        </a>
                    </figure>
                </div>
            </div>

            <!-- SIXTH ROW -->
            <div class="columns gallery-test">
                <div class="column galtest">
                    <figure class="image is-256x256">
                        <a href="{{ public_asset('assets/front/img/gckcimages/GCKC26.jpg') }}" data-lightbox="GCKC">
                            <img src="{{ public_asset('assets/front/img/gckcimages/GCKC26.jpg') }}">
                        </a>
                    </figure>
                </div>

                <div class="column galtest">
                    <figure class="image is-256x256">
                        <a href="{{ public_asset('assets/front/img/gckcimages/GCKC27.jpg') }}" data-lightbox="GCKC">
                            <img src="{{ public_asset('assets/front/img/gckcimages/GCKC27.jpg') }}">
                        </a>
                    </figure>
                </div>

            </div>

        </div>
        </div>
    </section>

@endsection
