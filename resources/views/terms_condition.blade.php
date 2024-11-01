@extends('layouts.app')
@section('title', getSettings()->app_name.':: Terma and Conditions')
@section('content')
    <div class="back_re">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">
                        <h2>Terms &amp; Condition</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- our_room -->
    <div class="our_room">
        <div class="container">
            <h2>Introduction</h2>
            <p>These Terms and Conditions govern your use of our services at Guest House. By making a reservation or using
                our website, you agree to abide by these terms.</p>

            <h2>Booking and Reservations</h2>
            <ol>
                <li><strong>Booking Confirmation:</strong> All bookings are subject to availability and confirmation by
                    Guest House. A reservation is confirmed when you receive a confirmation email.</li>
                <li><strong>Payment:</strong> Payment details will be required to secure your booking. Full payment or a
                    deposit may be required depending on the room type and booking conditions.</li>
                <li><strong>Cancellation Policy:</strong> Cancellations must be made according to our cancellation policy. A
                    cancellation fee may apply depending on the timing of the cancellation and the rate plan booked.</li>
            </ol>

            <h2>Check-In and Check-Out</h2>
            <ol>
                <li><strong>Check-In Time:</strong> Check-in is typically from [Check-In Time]. Early check-in may be
                    available upon request and subject to availability.</li>
                <li><strong>Check-Out Time:</strong> Check-out is usually by [Check-Out Time]. Late check-out may incur
                    additional charges and is subject to availability.</li>
            </ol>

            <h2>Use of Facilities</h2>
            <ol>
                <li><strong>Guest Conduct:</strong> Guests are expected to conduct themselves in a manner respectful to
                    other guests and staff. We reserve the right to refuse service or remove guests from the property who
                    violate this policy.</li>
                <li><strong>Damage and Loss:</strong> Guests are responsible for any damage or loss to the property or its
                    contents caused during their stay. Charges may apply for repairs or replacements.</li>
            </ol>

            <h2>Liability</h2>
            <ol>
                <li><strong>Limitation of Liability:</strong> Guest House is not liable for any loss, damage, or injury
                    arising from the use of our facilities or services, except as required by law.</li>
                <li><strong>Force Majeure:</strong> We are not liable for failure to perform any of our obligations due to
                    circumstances beyond our control, including but not limited to natural disasters, strikes, or government
                    actions.</li>
            </ol>

            <h2>Amendments</h2>
            <p>We reserve the right to amend these Terms and Conditions at any time. Any changes will be communicated
                through our website or directly to guests as appropriate.</p>
        </div>
    </div>
    <!-- end our_room -->
@endsection
