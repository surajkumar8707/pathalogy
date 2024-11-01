@extends('layouts.app')
@section('title', getSettings()->app_name . ':: Home Page')
@section('content')
    <!-- HERO BG
                                                        ############################################-->
    <!-- is-fullheight for full background hero or is-halfheight  -->
    <section class="hero hero-bg is-fullheight">
        <div class="hero hero-bg">
            <div class="hero-body"></div>
        </div>
    </section>

    <!-- About Us + Location
                                                        ############################################-->
    <section id="aboutclub" class="section aboutclub">
        <div class="container is-centered">
            <h1 class="title-head centered-text">About the Tournament</h1>

            <br />

            <div class="columns">
                <div class="column para-text">
                    <p>
                        Hakuakai Karate will be hosting our 1st Gold Coast Karate
                        Championships to be held on the
                        <span class="aboutclubhighlight">13th October 2018 at the Pacific Pines State High School -
                            Performing Arts Centre (PAC)</span>

                        <br />
                        <br />

                        This is an invitation only tournament and is geared towards
                        developing children, cadets and adults in gaining competition
                        experience in a safe and nurturing environment. Tournaments are
                        traditionally used to develop confidence and resilience in all
                        people. This competition will benefit all and give an opportunity
                        to those that are new and old to experience a real competition. It
                        will follow under a modified JKF & WKF rules. Divisions may be
                        adjusted as required.

                        <br />
                        <br />

                        We will have amazing medals, certificates and prizes on the day.

                        <br />
                        <br />

                        To have an event like this takes a lot of help and organisation.
                        So as a club member we require your support on the day by student
                        participation and family volunteering. We will be releasing entry
                        forms and organising volunteers this week. Invite your family and
                        friends. There will be plenty of seating for all. Bring some
                        change for food and raffles to purchase on the day. In traditional
                        Hakuakai fashion, it will be an unforgettable event for all.

                        <br />
                        <br />

                        Entry Fee : $30 for 1st family member and $25 there after.
                    </p>
                </div>

                <div class="column">
                    <div class="googlemap">
                        <iframe class="map"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3524.7492722428124!2d153.3182336107929!3d-27.940330700202804!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b9110be195c4193%3A0x7f3f6db9a07476b8!2sPacific+Pines+State+High+School%2C+Pacific+Pines+QLD+4211!5e0!3m2!1sen!2sau!4v1537194400163"
                            width="100%" height="500" frameborder="0" style="border: 0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- GCKC ENTRY FORM + POSTER DOWNLOADS
                                                        ############################################-->
    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column has-text-centered">
                    <a target="_blank" href="{{ public_asset('assets/front/img/GCKCPoster.jpeg') }}">
                        <img class="posterdownload" src="{{ public_asset('assets/front/img/GCKCPoster.jpeg') }}"
                            alt="GCKC Poster" />
                    </a>
                    <br />
                    <br />
                    <a target="_blank" href="{{ public_asset('assets/front/img/GCKCPoster.jpeg') }}"
                        class="button downloadposter">Download Poster<i class="fas fa-download"></i></a>
                </div>

                <div class="column has-text-centered">
                    <a target="_blank" href="{{ public_asset('assets/front/download/GCKCEntry Form.pdf') }}">
                        <img class="gckcentryform" src="{{ public_asset('assets/front/img/GCKCEntry.jpg') }}" />
                    </a>
                    <br />
                    <br />
                    <a target="_blank" href="{{ public_asset('assets/front/download/GCKCEntry Form.pdf') }}"
                        class="button downloadposter">Download Form<i class="fas fa-download"></i></a>
                </div>
            </div>
        </div>
    </section>

    <br />
    <br />

    <div class="container">
        <section class="customer-logos slider">
            <div class="slide"><img src="{{ public_asset('assets/front/img/sponsorships/axonauto.png') }}" /></div>
            <div class="slide"><img src="{{ public_asset('assets/front/img/sponsorships/abfurb.png') }}" /></div>
            <div class="slide"><img src="{{ public_asset('assets/front/img/sponsorships/satoru.png') }}" /></div>
            <div class="slide"><img src="{{ public_asset('assets/front/img/sponsorships/hyclean.png') }}" /></div>
            <div class="slide cust">
                <img src="{{ public_asset('assets/front/img/sponsorships/JDTupperware.png') }}" />
            </div>
            <div class="slide">
                <img src="{{ public_asset('assets/front/img/sponsorships/redroosterworongary.png') }}" />
            </div>
        </section>
    </div>
@endsection
