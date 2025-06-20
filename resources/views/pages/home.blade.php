@extends('layouts.default')
@section('main-content')
    <style>
        .slick-fade .align {
            position: relative;
            overflow: hidden;
        }

        .slick-fade .align .imgHolder img {
            transition: transform 0.5s ease-out;
        }

        .slick-fade .slick-current .imgHolder img {
            transform: scale(1);
        }

        .slick-fade .slick-slide img {
            transform: scale(1.1);
        }

        .slick-fade .slick-prev,
        .slick-fade .slick-next {
            position: absolute;
            top: 50%;
            z-index: 1;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
            transition: opacity 0.3s ease;
        }

        .slick-fade .slick-prev:hover,
        .slick-fade .slick-next:hover {
            opacity: 1;
        }

        .slick-fade .slick-prev {
            left: 10px;
        }

        .slick-fade .slick-next {
            right: 10px;
        }

        .fade-new .slick-prev,
        .fade-new .slick-next {
            position: absolute;
            top: 50%;
            z-index: 1;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
            transition: opacity 0.3s ease;
            display: none;
            opacity: 0;
        }

        .fade-new .slick-prev:hover,
        .fade-new .slick-next:hover {
            opacity: 1;
        }

        .fade-new .slick-prev {
            left: 10px;
        }

        .fade-new .slick-next {
            right: 10px;
        }

        .slick-prev .slick-arrow {
            display: none;
        }

        .selectable-card {
            cursor: pointer;
            border: 1px solid #ccc;
            transition: 0.2s;
        }

        .selectable-card.active {
            border: 2px solid #004085;
            /* dark blue */
        }

        .scrolling-section {
            background: white;
            color: #000;
            white-space: nowrap;
            overflow: hidden;
            position: relative;
        }

        .scrolling-text {
            display: inline-block;
            padding-left: 100%;
            animation: scroll-left 20s linear infinite;
        }

        .scrolling-text span {
            display: inline-block;
            margin: 0 40px;
            font-family: Arial, sans-serif;
            font-size: 28px;
            position: relative;
        }

        .scrolling-text span::after {
            content: "●";
            /* color: red; */
            color: #01236a;
            margin-left: 40px;
        }

        .scrolling-text span:last-child::after {
            content: "";
        }

        @keyframes scroll-left {
            from {
                transform: translateX(0%);
            }

            to {
                transform: translateX(-100%);
            }
        }

        /* .premium-benefits-wrapper {
                                                                                                                    padding: 4rem 0;
                                                                                                                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                                                                                                                    min-height: 90vh;
                                                                                                                    display: flex;
                                                                                                                    align-items: center;
                                                                                                                }

                                                                                                                .benefit-showcase-card {
                                                                                                                    background: rgba(255, 255, 255, 0.95);
                                                                                                                    border-radius: 20px;
                                                                                                                    padding: 2rem 1.5rem;
                                                                                                                    text-align: center;
                                                                                                                    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
                                                                                                                    border: none;
                                                                                                                    transition: all 0.3s ease;
                                                                                                                    height: 100%;
                                                                                                                    backdrop-filter: blur(10px);
                                                                                                                }

                                                                                                                .benefit-showcase-card:hover {
                                                                                                                    transform: translateY(-10px);
                                                                                                                    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
                                                                                                                }

                                                                                                                .benefit-icon-circle {
                                                                                                                    width: 80px;
                                                                                                                    height: 80px;
                                                                                                                    margin: 0 auto 1.5rem;
                                                                                                                    background: linear-gradient(135deg, #667eea, #764ba2);
                                                                                                                    border-radius: 50%;
                                                                                                                    display: flex;
                                                                                                                    align-items: center;
                                                                                                                    justify-content: center;
                                                                                                                    font-size: 2rem;
                                                                                                                    color: white;
                                                                                                                    transition: all 0.3s ease;
                                                                                                                }

                                                                                                                .benefit-showcase-card:hover .benefit-icon-circle {
                                                                                                                    transform: scale(1.1) rotate(5deg);
                                                                                                                }

                                                                                                                .benefit-card-heading {
                                                                                                                    font-size: 1.25rem;
                                                                                                                    font-weight: 700;
                                                                                                                    color: #2d3748;
                                                                                                                    margin-bottom: 0.75rem;
                                                                                                                }

                                                                                                                .benefit-card-text {
                                                                                                                    color: #718096;
                                                                                                                    font-size: 0.95rem;
                                                                                                                    line-height: 1.6;
                                                                                                                    margin: 0;
                                                                                                                }

                                                                                                                .benefits-header-section {
                                                                                                                    text-align: center;
                                                                                                                    margin-bottom: 3rem;
                                                                                                                    color: white;
                                                                                                                }

                                                                                                                .benefits-main-heading {
                                                                                                                    font-size: 2.5rem;
                                                                                                                    font-weight: 800;
                                                                                                                    margin-bottom: 1rem;
                                                                                                                    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                                                                                                                }

                                                                                                                .benefits-subtitle-text {
                                                                                                                    font-size: 1.1rem;
                                                                                                                    opacity: 0.9;
                                                                                                                    max-width: 600px;
                                                                                                                    margin: 0 auto;
                                                                                                                }

                                                                                                                @media (max-width: 768px) {
                                                                                                                    .premium-benefits-wrapper {
                                                                                                                        padding: 3rem 0;
                                                                                                                    }

                                                                                                                    .benefits-main-heading {
                                                                                                                        font-size: 2rem;
                                                                                                                    }

                                                                                                                    .benefit-showcase-card {
                                                                                                                        margin-bottom: 2rem;
                                                                                                                        padding: 1.5rem 1rem;
                                                                                                                    }

                                                                                                                    .benefit-icon-circle {
                                                                                                                        width: 70px;
                                                                                                                        height: 70px;
                                                                                                                        font-size: 1.75rem;
                                                                                                                    }

                                                                                                                    .benefit-card-heading {
                                                                                                                        font-size: 1.1rem;
                                                                                                                    }
                                                                                                                }

                                                                                                                @media (max-width: 576px) {
                                                                                                                    .benefits-main-heading {
                                                                                                                        font-size: 1.75rem;
                                                                                                                    }

                                                                                                                    .benefit-icon-circle {
                                                                                                                        width: 60px;
                                                                                                                        height: 60px;
                                                                                                                        font-size: 1.5rem;
                                                                                                                    }
                                                                                                                }

                                                                                                                .benefit-showcase-card {
                                                                                                                    opacity: 0;
                                                                                                                    transform: translateY(30px);
                                                                                                                    animation: slideUpFadeIn 0.6s ease forwards;
                                                                                                                }

                                                                                                                .benefit-showcase-card:nth-child(1) {
                                                                                                                    animation-delay: 0.1s;
                                                                                                                }

                                                                                                                .benefit-showcase-card:nth-child(2) {
                                                                                                                    animation-delay: 0.2s;
                                                                                                                }

                                                                                                                .benefit-showcase-card:nth-child(3) {
                                                                                                                    animation-delay: 0.3s;
                                                                                                                }

                                                                                                                .benefit-showcase-card:nth-child(4) {
                                                                                                                    animation-delay: 0.4s;
                                                                                                                }

                                                                                                                @keyframes slideUpFadeIn {
                                                                                                                    to {
                                                                                                                        opacity: 1;
                                                                                                                        transform: translateY(0);
                                                                                                                    }
                                                                                                                } */

        .premium-benefits-wrapper {
            padding: 4rem 0;
            background: linear-gradient(135deg, #ffffff 0%, #81c784 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .benefit-showcase-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 2rem 1.5rem;
            text-align: center;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: none;
            transition: all 0.3s ease;
            height: 100%;
            backdrop-filter: blur(10px);
        }

        .benefit-showcase-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .benefit-icon-circle {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: linear-gradient(135deg, #ffffff, #81c784);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            transition: all 0.3s ease;
        }

        .benefit-showcase-card:hover .benefit-icon-circle {
            transform: scale(1.1) rotate(5deg);
        }

        .benefit-card-heading {
            font-size: 1.25rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 0.75rem;
        }

        .benefit-card-text {
            color: #718096;
            font-size: 0.95rem;
            line-height: 1.6;
            margin: 0;
        }

        .benefits-header-section {
            text-align: center;
            margin-bottom: 3rem;
            color: white;
        }

        .benefits-main-heading {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .benefits-subtitle-text {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
        }

        @media (max-width: 768px) {
            .premium-benefits-wrapper {
                padding: 3rem 0;
            }

            .benefits-main-heading {
                font-size: 2rem;
            }

            .benefit-showcase-card {
                margin-bottom: 2rem;
                padding: 1.5rem 1rem;
            }

            .benefit-icon-circle {
                width: 70px;
                height: 70px;
                font-size: 1.75rem;
            }

            .benefit-card-heading {
                font-size: 1.1rem;
            }
        }

        @media (max-width: 576px) {
            .benefits-main-heading {
                font-size: 1.75rem;
            }

            .benefit-icon-circle {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }
        }

        /* Animation on scroll */
        .benefit-showcase-card {
            opacity: 0;
            transform: translateY(30px);
            animation: slideUpFadeIn 0.6s ease forwards;
        }

        .benefit-showcase-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .benefit-showcase-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .benefit-showcase-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .benefit-showcase-card:nth-child(4) {
            animation-delay: 0.4s;
        }

        @keyframes slideUpFadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-new .slide-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: auto;
            padding: 10px;
            /* Optional padding */
        }

        .fade-new .slide-wrapper img {
            max-width: 100%;
            height: auto;
            object-fit: contain;
            /* Ensures no stretching or cropping */
        }
    </style>
    <section class="introBlock position-relative">

        <div class="fade-new">
            @if ($banners)
                @foreach ($banners as $banner)
                    <div>
                        <img src="{{ env('MAIN_URL') }}images/{{ $banner->image }}" alt="" style="object-fit: contain">
                    </div>
                @endforeach
            @endif
        </div>
    </section>

    <div class="scrolling-section">
        <div class="scrolling-text">
            <span>PREMIUM FABRICS</span>
            <span>MODERN DESIGNS</span>
            <span>COMFORT FIT</span>
            <span>SUSTAINABLE MATERIALS</span>
            <span>LIMITED EDITION DROPS</span>
            <span>FREE SHIPPING AVAILABLE</span>
        </div>
    </div>


    <!-- featureSec -->
    <section
        class="featureSec container-fluid overflow-hidden pt-xl-12 pt-lg-10 pt-md-40 pt-5 pb-xl-10 pb-lg-4 pb-md-2 px-xl-14 px-lg-7 home-feature">
        <!-- mainHeader -->
        <header class="col-12 mainHeader mb-7 text-center">
            <h1 class="headingIV fwEblod mb-4" style="font-family: DMSerifDisplay;font-weight:300;">Popular Products</h1>

        </header>
        @php
            $prod = App\Models\products::get();
        @endphp

        <div class="row p-0 overflow-hidden d-flex flex-wrap">
            @foreach ($prod as $product)
                @php

                    $firstVarient = \App\Models\ProductVarient::where('product_id', $product->id)->first();
                @endphp
                <div class="col-lg-3 col-3">
                    <div class="card" style="border-radius: 15px;height:480px">
                        <div class="card-header bg-transparent text-right">
                            <a href="/product-details/{{ $product->prod_unique_name }}"><img
                                    src="{{ env('MAIN_URL') }}images/{{ $product->product_image }}" class="card-img-top"
                                    alt="Prod Image" style="object-fit:contain;height:300px;"></a>
                        </div>


                        <div class="card-body">
                            <h5 class="card-title text-center"><a
                                    href="/product-details/{{ $product->prod_unique_name }}">{{ $product->product_name }}</a>
                            </h5>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    @if ($firstVarient->mrp_price == $firstVarient->offer_price)
                                        ₹{{ $firstVarient->mrp_price }}
                                    @else
                                        <del> ₹ {{ $firstVarient->mrp_price }}</del>
                                        ₹{{ $firstVarient->offer_price }}
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-12 text-center">
                                    <a href="/product-details/{{ $product->prod_unique_name }}"
                                        class="btn btnTheme btnShop p-2 text-white w-full">View Details</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <section
        class="featureSec container-fluid overflow-hidden pt-xl-12 pt-lg-10 pt-md-40 pt-5 pb-xl-10 pb-lg-4 pb-md-2 px-xl-14 px-lg-7 home-feature">
        <!-- mainHeader -->
        <header class="col-12 mainHeader mb-7 text-center">
            <h1 class="headingIV fwEblod mb-4" style="font-family: DMSerifDisplay;font-weight:300;">New Arrivals</h1>

        </header>
        @php
            $prod = App\Models\products::orderBy('created_at', 'desc') // Order by latest
                ->get();
        @endphp

        <div class="row p-0 overflow-hidden d-flex flex-wrap">
            @foreach ($prod as $product)
                @php

                    $firstVarient = \App\Models\ProductVarient::where('product_id', $product->id)->first();
                @endphp
                <div class="col-lg-3">
                    <div class="card" style="border-radius: 15px;height:480px">
                        <div class="card-header bg-transparent text-right">
                            <a href="/product-details/{{ $product->prod_unique_name }}"><img
                                    src="{{ env('MAIN_URL') }}images/{{ $product->product_image }}" class="card-img-top"
                                    alt="Prod Image" style="object-fit:contain;height:300px;"></a>
                        </div>


                        <div class="card-body">
                            <h5 class="card-title text-center"><a
                                    href="/product-details/{{ $product->prod_unique_name }}">{{ $product->product_name }}</a>
                            </h5>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    @if ($firstVarient->mrp_price == $firstVarient->offer_price)
                                        ₹{{ $firstVarient->mrp_price }}
                                    @else
                                        <del> ₹ {{ $firstVarient->mrp_price }}</del>
                                        ₹{{ $firstVarient->offer_price }}
                                    @endif
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-12 text-center">
                                    <a href="/product-details/{{ $product->prod_unique_name }}"
                                        class="btn btnTheme btnShop p-2 text-white w-full">View Details</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- contactListBlock -->
    {{-- <div class="contactListBlock container overflow-hidden pt-xl-8 pt-lg-10 pt-md-8 pt-4 pb-xl-12 pb-lg-10 pb-md-4 pb-1">
        <div class="row">
            <div class="col-12 col-sm-6 col-lg-3 mb-4 mb-lg-0">
                <!-- contactListColumn -->
                <div class="contactListColumn border overflow-hidden py-xl-5 py-md-3 py-2 px-xl-6 px-md-3 px-3 d-flex">
                    <span class="icon icon-van"></span>
                    <div class="alignLeft pl-2">
                        <strong class="headingV fwEbold d-block mb-1">Free shipping order</strong>
                        <p class="m-0">On orders over ₹100</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3 mb-4 mb-lg-0">
                <!-- contactListColumn -->
                <div class="contactListColumn border overflow-hidden py-xl-5 py-md-3 py-2 px-xl-6 px-md-3 px-3 d-flex">
                    <span class="icon icon-gift"></span>
                    <div class="alignLeft pl-2">
                        <strong class="headingV fwEbold d-block mb-1">Special gift card</strong>
                        <p class="m-0">The perfect gift idea</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3 mb-4 mb-lg-0">
                <!-- contactListColumn -->
                <div class="contactListColumn border overflow-hidden py-xl-5 py-md-3 py-2 px-xl-4 px-md-2 px-3 d-flex">
                    <span class="icon icon-recycle"></span>
                    <div class="alignLeft pl-2">
                        <strong class="headingV fwEbold d-block mb-1">Return &amp; exchange</strong>
                        <p class="m-0">Free return within 3 days</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3 mb-4 mb-lg-0">
                <!-- contactListColumn -->
                <div class="contactListColumn border overflow-hidden py-xl-5 py-md-3 py-2 px-xl-6 px-md-3 px-3 d-flex">
                    <span class="icon icon-call"></span>
                    <div class="alignLeft pl-2">
                        <strong class="headingV fwEbold d-block mb-1">Support 24 / 7</strong>
                        <p class="m-0">Customer support</p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


    <section class="premium-benefits-wrapper">
        <div class="container">
            <div class="benefits-header-section">
                <h2 class="benefits-main-heading">Why Choose Us</h2>
                <p class="benefits-subtitle-text">Experience premium service with benefits designed around your needs</p>
            </div>

            <div class="row g-4">
                <!-- Free Shipping -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="benefit-showcase-card">
                        <div class="benefit-icon-circle">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <h3 class="benefit-card-heading">Free Shipping</h3>
                        <p class="benefit-card-text">Complimentary delivery on all orders over $100. Fast and secure
                            shipping nationwide.</p>
                    </div>
                </div>

                <!-- Perfect Gift -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="benefit-showcase-card">
                        <div class="benefit-icon-circle">
                            <i class="fas fa-gift"></i>
                        </div>
                        <h3 class="benefit-card-heading">Perfect Gift Idea</h3>
                        <p class="benefit-card-text">Curated selections and gift wrapping services to make every occasion
                            special.</p>
                    </div>
                </div>

                <!-- Easy Returns -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="benefit-showcase-card">
                        <div class="benefit-icon-circle">
                            <i class="fas fa-undo-alt"></i>
                        </div>
                        <h3 class="benefit-card-heading">3-Day Returns</h3>
                        <p class="benefit-card-text">Hassle-free return policy within 3 days. Your satisfaction is our
                            priority.</p>
                    </div>
                </div>

                <!-- Customer Support -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="benefit-showcase-card">
                        <div class="benefit-icon-circle">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h3 class="benefit-card-heading">24/7 Support</h3>
                        <p class="benefit-card-text">Round-the-clock customer service ready to assist you anytime,
                            anywhere.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- partnerSec -->
    <div class="partnerSec container overflow-hidden pt-xl-12 pb-xl-23 pt-lg-10 pt-md-8 pt-5 pb-lg-20 pb-md-16 pb-10">
        <div class="row">
            <div class="col-12">
                <!-- partnerSlider -->
                <div class="partnerSlider d-flex flex-wrap">
                    <div>
                        <div class="logoColumn d-flex align-items-center justify-content-center">
                            <a href="javascript:void(0);"><img src="/assets/images/clients/p-logo1.png" alt="Partner Logo"
                                    class="img-fluid"></a>
                        </div>
                    </div>
                    <div>
                        <div class="logoColumn d-flex align-items-center justify-content-center">
                            <a href="javascript:void(0);"><img src="/assets/images/clients/p-logo2.png" alt="Partner Logo"
                                    class="img-fluid"></a>
                        </div>
                    </div>
                    <div>
                        <div class="logoColumn d-flex align-items-center justify-content-center">
                            <a href="javascript:void(0);"><img src="/assets/images/clients/p-logo3.png" alt="Partner Logo"
                                    class="img-fluid"></a>
                        </div>
                    </div>
                    <div>
                        <div class="logoColumn d-flex align-items-center justify-content-center">
                            <a href="javascript:void(0);"><img src="/assets/images/clients/p-logo4.png"
                                    alt="Partner Logo" class="img-fluid"></a>
                        </div>
                    </div>
                    <div>
                        <div class="logoColumn d-flex align-items-center justify-content-center">
                            <a href="javascript:void(0);"><img src="/assets/images/clients/p-logo5.png"
                                    alt="Partner Logo" class="img-fluid"></a>
                        </div>
                    </div>
                    <div>
                        <div class="logoColumn d-flex align-items-center justify-content-center">
                            <a href="javascript:void(0);"><img src="/assets/images/clients/p-logo1.png"
                                    alt="Partner Logo" class="img-fluid"></a>
                        </div>
                    </div>
                    <div>
                        <div class="logoColumn d-flex align-items-center justify-content-center">
                            <a href="javascript:void(0);"><img src="/assets/images/clients/p-logo2.png"
                                    alt="Partner Logo" class="img-fluid"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- MODAL --}}

    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-5">
                    <div class="d-flex flex-wrap gap-4">
                        <div class="fw-bold text-uppercase me-2" style="margin-right:10px;">Size:
                        </div>
                        <div class="prod_size_append_home d-flex justify-content-between align-items-center g-4">

                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-4 mt-4">
                        <div class="fw-bold text-uppercase me-2 home_prod_color_title" style="margin-right:10px;">Color:
                        </div>
                        <div class="prod_color_append_home d-flex justify-content-between align-items-center g-4">

                        </div>
                    </div>

                    <input type="hidden" name="cartModal_prod_id" id="cartModal_prod_id">
                    @if (Auth::check())
                        <input type="hidden" name="cartModal_user_id" id="cartModal_user_id"
                            value="{{ Auth::user()->id }}">
                    @endif

                    <div class="text-right">
                        <button type="button" class="btn btn-secondary cartModal_close_btn"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary cartModal_submit_btn">Submit</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
