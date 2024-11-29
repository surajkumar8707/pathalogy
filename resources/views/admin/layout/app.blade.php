<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/admin/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ public_asset('assets/admin/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ public_asset('assets/admin/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ public_asset('assets/admin/vendor/css/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ public_asset('assets/admin/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ public_asset('assets/admin/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet"
        href="{{ public_asset('assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ public_asset('assets/admin/vendor/libs/apex-charts/apex-charts.css') }}" />
    {{-- <link rel="stylesheet" href="{{ public_asset('build/assets/app-Cok-cHVn.css') }}">
    <script rel="stylesheet" href="{{ public_asset('build/assets/app-Bg1aHGgo.js') }}"></script> --}}

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ public_asset('assets/admin/vendor/js/helpers.js') }}"></script>

    <script src="{{ public_asset('assets/admin/js/config.js') }}"></script>

    @vite(['resources/sass/app.scss'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @stack('styles')
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">


            <!-- Menu -->
            @include('admin.layout.sidebar')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('admin.layout.header')
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    @yield('content')
                    <!-- / Content -->

                    <!-- Footer -->
                    @include('admin.layout.footer')
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ public_asset('assets/admin/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ public_asset('assets/admin/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ public_asset('assets/admin/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ public_asset('assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ public_asset('assets/admin/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ public_asset('assets/admin/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ public_asset('assets/admin/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ public_asset('assets/admin/js/dashboards-analytics.js') }}"></script>
    {{-- <script rel="stylesheet" href="{{ public_asset('build/assets/app-Bg1aHGgo.js') }}"></script> --}}
    <script rel="stylesheet" href="{{ public_asset('build/assets/app-BU-axLcQ.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @vite(['resources/js/app.js'])

    <!-- Place this tag in your head or just before your close body tag. -->
    {{-- <script async defer src="https://buttons.github.io/buttons.js"></script> --}}

    {{-- custom script --}}
    <script>
        const csrfToken = '{{ csrf_token() }}';
        const baase_url = '{{ url('') }}';

        document.addEventListener('DOMContentLoaded', function() {
            const profileComponents = document.querySelectorAll('.student_profile_pic, .student_sign_pic');

            profileComponents.forEach(component => {
                const accountUserImage = component.querySelector('.account-avatar');
                const fileInput = component.querySelector('.account-file-input');
                const resetFileInput = component.querySelector('.account-image-reset');

                if (accountUserImage) {
                    const resetImage = accountUserImage.src;

                    fileInput.onchange = () => {
                        if (fileInput.files[0]) {
                            accountUserImage.src = window.URL.createObjectURL(fileInput.files[0]);
                        }
                    };

                    resetFileInput.onclick = () => {
                        fileInput.value = '';
                        accountUserImage.src = resetImage;
                    };
                }
            });
        });

        // function ajaxRequest(url, data, method = 'GET', headers, callback) {
        //     $.ajax({
        //         url: url,
        //         type: 'POST',
        //         headers: headers,
        //         data: data,
        //         success: function(response) {
        //             console.log(response);

        //             if (response.status == 'success') {
        //                 toastr.success(response.message, 'Success !', );
        //                 displaySpan.text(response.data.lower_value);
        //             } else {
        //                 toastr.error(response.message, 'Error !', );
        //             }

        //             // if (response.success) {
        //             //     displaySpan.text(newValue);
        //             // } else {
        //             //     alert('Error: ' + response.message);
        //             // }
        //         },
        //         error: function(xhr) {
        //             console.error('Error:', xhr.responseText);
        //             alert('An error occurred while saving the data.');
        //         },
        //         complete: function() {
        //             displaySpan.removeClass('d-none');
        //             input.addClass('d-none');
        //         }
        //     });
        // }

        function ajaxRequest(url, data, method = 'GET', headers, callback) {
            $.ajax({
                url: url,
                type: method,
                headers: headers,
                data: data,
                success: function(response) {
                    console.log(response);

                    if (response.status == 'success') {
                        toastr.success(response.message, 'Success!');
                    }
                    if (response.status == 'error') {
                        toastr.error(response.message, 'Error!');
                    }
                    // Call the callback function with the response
                    if (callback) {
                        callback(response);
                    }
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                    alert(xhr.responseText);
                },
                complete: function() {}
            });
        }
    </script>


    @stack('scripts')

    @include('admin.layout.toastr')
</body>

</html>
