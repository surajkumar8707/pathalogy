@extends('layouts.app')
@section('title', getSettings()->app_name.':: Privacy Policy')
@section('content')
    <div class="back_re">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">
                        <h2>Privacy Policy</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- our_room -->
    <div class="our_room">
        <div class="container">
            <h2>Introduction</h2>
            <p>Guest House is committed to protecting your privacy and ensuring a safe online experience. This Privacy
                Policy outlines how we collect, use, and safeguard your information.</p>

            <h2>Information We Collect</h2>
            <ol>
                <li><strong>Personal Information:</strong> We may collect personal information such as your name, email
                    address, phone number, and payment details when you make a reservation or interact with our website.
                </li>
                <li><strong>Usage Data:</strong> We may collect information about your use of our website, including IP
                    address, browser type, and pages visited, to improve our services and user experience.</li>
            </ol>

            <h2>How We Use Your Information</h2>
            <ol>
                <li><strong>Booking and Service:</strong> We use your personal information to process bookings, provide
                    customer support, and enhance your experience at Guest House.</li>
                <li><strong>Marketing:</strong> With your consent, we may use your information to send you promotional
                    materials, newsletters, and offers related to our services. You can opt out of receiving these
                    communications at any time.</li>
                <li><strong>Improvement:</strong> We use usage data to analyze and improve our website and services.</li>
            </ol>

            <h2>Data Sharing and Security</h2>
            <ol>
                <li><strong>Third Parties:</strong> We do not sell or rent your personal information to third parties. We
                    may share your information with service providers who assist us in operating our business and providing
                    services to you, under strict confidentiality agreements.</li>
                <li><strong>Security Measures:</strong> We implement appropriate security measures to protect your personal
                    information from unauthorized access, alteration, or disclosure.</li>
            </ol>

            <h2>Your Rights</h2>
            <ol>
                <li><strong>Access and Correction:</strong> You have the right to access and correct your personal
                    information. If you wish to update or delete your information, please contact us.</li>
                <li><strong>Complaints:</strong> If you have any concerns about how your information is handled, please
                    contact us. You also have the right to lodge a complaint with the relevant data protection authority.
                </li>
            </ol>

            <h2>Changes to This Policy</h2>
            <p>We may update this Privacy Policy from time to time. Any changes will be posted on our website, and we
                encourage you to review this policy periodically.</p>
        </div>
    </div>
    <!-- end our_room -->
@endsection
