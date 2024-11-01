@extends('layouts.app')
@section('title', getSettings()->app_name.':: About Page')
@section('content')
    <div class="back_re">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">
                        <h2>About Us</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about -->
    <div class="about">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <div class="titlepage">

                        <h2>Welcome to Guest House</h2>
                        <p>At Guest House, we pride ourselves on offering exceptional hospitality and comfort in a serene
                            and welcoming environment. Located in the heart of [Your City/Region], our hotel combines luxury
                            with a home-like atmosphere to provide an unforgettable stay for both business and leisure
                            travelers.</p>

                        <h3>Our Mission</h3>
                        <p>Our mission is to deliver personalized service and create memorable experiences for our guests.
                            Whether you're here for a short stay or an extended visit, our dedicated team is committed to
                            ensuring your needs are met with professionalism and warmth.</p>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="about_img">
                        <figure><img src="{{ public_asset('assets/front/images/pages/about.jpg') }}" alt="#" />
                        </figure>
                    </div>
                </div>
            </div>

            <div class="container">
                <main>
                    <section>
                        {{-- <h2>Welcome to Guest House</h2>
                        <p>At Guest House, we pride ourselves on offering exceptional hospitality and comfort in a serene and
                            welcoming environment. Located in the heart of [Your City/Region], our hotel combines luxury with a
                            home-like atmosphere to provide an unforgettable stay for both business and leisure travelers.</p>

                        <h3>Our Mission</h3>
                        <p>Our mission is to deliver personalized service and create memorable experiences for our guests.
                            Whether you're here for a short stay or an extended visit, our dedicated team is committed to
                            ensuring your needs are met with professionalism and warmth.</p> --}}

                        <h2>What We Offer</h2>
                        <ul>
                            <li><strong>Comfortable Rooms:</strong> Enjoy our elegantly furnished rooms designed for
                                relaxation
                                and convenience. Each room is equipped with modern amenities to make your stay enjoyable.
                            </li>
                            <li><strong>Stunning Gallery:</strong> Explore our curated gallery that showcases local art and
                                culture, adding a touch of creativity to your visit.</li>
                            <li><strong>Exceptional Service:</strong> From the moment you arrive until your departure, our
                                staff
                                is here to assist you with a smile and make sure you have everything you need.</li>
                            <li><strong>Prime Location:</strong> Located near key attractions, business centers, and dining
                                options, Guest House is the perfect base for exploring [Your City/Region].</li>
                        </ul>

                        <h3>Our Values</h3>
                        <ul>
                            <li><strong>Hospitality:</strong> We believe in making every guest feel at home with genuine,
                                attentive service.</li>
                            <li><strong>Integrity:</strong> We operate with transparency and honesty in all our dealings.
                            </li>
                            <li><strong>Excellence:</strong> We strive for the highest standards in everything we do, from
                                our
                                facilities to our service.</li>
                        </ul>

                        <p>Thank you for choosing Guest House. We look forward to welcoming you and making your stay
                            extraordinary.</p>
                    </section>
                </main>
            </div>


        </div>
    </div>
    <!-- end about -->
@endsection
