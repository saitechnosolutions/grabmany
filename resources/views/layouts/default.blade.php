<!DOCTYPE html>
<html lang="en">

<head>
    <!-- set the encoding of your site -->
    <meta charset="utf-8">
    <!-- set the Compatible of your site -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- set the page title -->
    <title>Grab Many</title>
    <link rel="icon" href="/assets/images/logo.png">
    <!-- include the site Google Fonts stylesheet -->
    <link
        href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700%7CRoboto:300,400,500,700,900&display=swap"
        rel="stylesheet">
    <!-- include the site bootstrap stylesheet -->
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <!-- include the site fontawesome stylesheet -->
    <link rel="stylesheet" href="/assets/css/fontawesome.css">
    <!-- include the site stylesheet -->
    <link rel="stylesheet" href="/assets/style.css">
    <!-- include theme plugins setting stylesheet -->
    <link rel="stylesheet" href="/assets/css/plugins.css">
    <!-- include theme color setting stylesheet -->
    <link rel="stylesheet" href="/assets/css/color.css">
    <!-- include theme responsive setting stylesheet -->
    <link rel="stylesheet" href="/assets/css/responsive.css">
    <link rel="stylesheet" href="/assets/css/login/scss">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<style>
    .loader-1 .loader-outter {
        position: absolute;
        border: 4px solid #01236a;
        border-left-color: transparent;
        border-bottom: 0;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        -webkit-animation: loader-1-outter 1s cubic-bezier(.42, .61, .58, .41) infinite;
        animation: loader-1-outter 1s cubic-bezier(.42, .61, .58, .41) infinite;
    }

    .loader-1 .loader-inner {
        position: absolute;
        border: 4px solid #01236a;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        left: calc(50% - 20px);
        top: calc(50% - 20px);
        border-right: 0;
        border-top-color: transparent;
        -webkit-animation: loader-1-inner 1s cubic-bezier(.42, .61, .58, .41) infinite;
        animation: loader-1-inner 1s cubic-bezier(.42, .61, .58, .41) infinite;
    }

    .loader {
        position: relative;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        margin: 75px;
        display: inline-block;
        vertical-align: middle;
    }

    @-webkit-keyframes loader-1-outter {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @keyframes loader-1-outter {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @-webkit-keyframes loader-1-inner {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(-360deg);
            transform: rotate(-360deg);
        }
    }

    @keyframes loader-1-inner {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(-360deg);
            transform: rotate(-360deg);
        }
    }

    #preloader {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ffffff;
        /* or any background color you prefer */
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .custom-social-bar {
        position: fixed;
        top: 50%;
        right: 0;
        transform: translateY(-50%);
        z-index: 9999;
    }

    .facebook-view-button,
    .instagram-view-button,
    .youtube-view-button,
    .linkedin-view-button {
        display: block;
        width: 49px;
        height: 49px;
        background-size: 40px 40px;
        background-repeat: no-repeat;
        background-position: center;
        /* border-radius: 0 12px 12px 0; */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        margin-bottom: 5px;
        transition: background-color 0.3s ease;
    }

    /* Facebook Button */
    .facebook-view-button {
        background-image: url('https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg');
        background-color: #1877F2;
    }

    /* Instagram Button */
    .instagram-view-button {
        background-image: url('http://www.walltowallcarpetinterior.com/wp-content/uploads/2024/09/INSTAGRAM-ICON.png');
        background-color: #E1306C;
    }

    /* YouTube Button */
    .youtube-view-button {
        background-image: url('https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg');
        background-color: #25D366;
    }

    /* LinkedIn Button */
    .linkedin-view-button {
        background-image: url('https://cdn-icons-png.flaticon.com/512/159/159832.png');
        background-color: #ffffff;
    }
</style>

<body>
    <div class="custom-social-bar">
        <a href="https://www.facebook.com/" target="_blank" class="facebook-view-button"></a>
        <a href="https://www.instagram.com/" target="_blank" class="instagram-view-button"></a>
        <a href="https://wa.me/9962238784" target="_blank" class="youtube-view-button"></a>
        <a href="tel:+919962238784" target="_blank" class="linkedin-view-button"></a>
    </div>
    <!-- pageWrapper -->
    <div id="pageWrapper">
        <!-- pageHeader -->
        <section>
            <div id="preloader">
                <div class="loader loader-1">
                    <div class="loader-outter"></div>
                    <div class="loader-inner"></div>
                </div>
            </div>

        </section>
        @include('layouts.header')
        <main>
            @yield('main-content')
        </main>

        @include('layouts.footer')

    </div>
    <!-- include jQuery library -->
    {{--
    <script src="/assets/js/jquery-3.4.1.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{--
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}
    <!-- include bootstrap popper JavaScript -->
    <script src="/assets/js/popper.min.js"></script>
    <!-- include bootstrap JavaScript -->
    <script src="/assets/js/bootstrap.min.js"></script>
    <!-- include custom JavaScript -->
    <script src="/assets/js/jqueryCustome.js"></script>
    <script src="/assets/js/ajax-pages.js"></script>
    <script src="/assets/js/homepage.js"></script>
    <script src="/assets/js/productpage.js"></script>
    <script src="/assets/js/productDescriptionPage.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        window.addEventListener('load', function () {
            const preloader = document.getElementById('preloader');
            preloader.style.opacity = '0';
            preloader.style.visibility = 'hidden';
            preloader.style.transition = 'opacity 0.3s ease';
            setTimeout(() => preloader.remove(), 300); // Remove from DOM
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                text: '{{ session('success') }}'
            });
        </script>
    @endif
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="/assets/js/checkoutpage.js"></script>

    @yield('scripts')


</body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
<!-- Include jQuery (required) and Owl Carousel JS -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
    $(document).ready(function () {
        $('.product-slider').owlCarousel({
            loop: true,
            margin: 15,
            nav: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 5000,
            navText: [
                '<i class="fas fa-chevron-left"></i>',
                '<i class="fas fa-chevron-right"></i>'
            ],
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                }
            }
        });
    });
</script>

</html>