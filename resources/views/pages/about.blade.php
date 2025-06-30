@extends('layouts.default')
@section('main-content')
    <style>
        .stepCol {
            background: linear-gradient(45deg, #e1f2e1, #9bd39e);
        }
    </style>
    <section class="introBannerHolder d-flex w-100 bgCover" style="background: url('/assets/images/about-bg.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-12 pt-lg-5 pt-md-15 pt-sm-10 pt-6 text-center">
                    <h1 class="headingIV fwEbold playfair mb-4">About Us</h1>
                    <ul class="list-unstyled breadCrumbs d-flex justify-content-center">
                        <li class="mr-2"><a href="/">Home</a></li>
                        <li class="mr-2">/</li>
                        <li class="active">About</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="abtSecHolder container pt-xl-24 pb-xl-12 pt-lg-20 pb-lg-10 pt-md-16 pb-md-8 pt-10 pb-5">
        <div class="row">
            <div class="col-12 col-lg-6 pt-xl-12 pt-lg-8">
                <h2 class="playfair fwEbold position-relative mb-7 pb-5">
                    <strong class="d-block">A Minimal Team</strong>
                    <strong class="d-block">For a Better World</strong>
                </h2>
                <p class="mb-xl-14 mb-lg-5" style="text-align: justify;">Welcome to <b>Grabmany</b> – your go-to destination
                    for premium casual wear for the whole family.
                </p>
                <p style="text-align: justify;">
                    <b>At Grabmany,</b> we believe that comfort, quality, and style should go hand in hand. We are a proudly
                    homegrown clothing brand dedicated to offering <b>high-quality, trend-forward</b> apparel for <b>Men,
                        Women, and Kids.</b>


                </p>
                <p style="text-align: justify;">
                    Whether you're looking for a soft and stylish <b>T-shirt,</b> a cozy <b>hoodie,</b> a versatile
                    <b>jogger,</b> or a chic <b>cropped top,</b> we’ve got something for every mood and moment.

                </p>
                <p style="text-align: justify;">

                    <b>Grabmany</b> — Wear It. Own It. Live It. <a href="javascript:void(0);" class="btnMore"><i>Learn
                            More</i></a>

                </p>
                <a href="/products" class="btn btnTheme btnShop fwEbold text-white md-round py-2 px-3 py-md-3 px-md-4">Grab
                    Now <i class="fas fa-arrow-right ml-2"></i></a>
            </div>
            <div class="col-12 col-lg-6 mb-lg-0 mb-4">
                <img src="/assets/images/about.png" alt="image description" class="img-fluid" style="border-radius: 15px;">
            </div>
        </div>
    </section>

    <section class="introSec bg-lightGray pt-xl-12 pb-xl-7 pt-10 pb-10">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-lg-0 mb-6 text-center">
                    <h2 class="playfair fwEbold position-relative mb-7 pb-5">
                        <strong class="d-block">What Sets Us Apart?</strong>
                    </h2>
                </div>
                <div class="col-12 col-lg-6 mb-lg-0 mb-6">
                    <img src="/assets/images/about-sec.jpg" alt="image description" class="img-fluid"
                        style="height: 470px;">
                </div>
                <div class="col-12 col-lg-6">
                    <div id="accordion" class="accordionList pt-lg-12">
                        <div class="card mb-2">
                            <div class="card-header px-xl-5 py-xl-3" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link fwEbold text-uppercase text-left w-100 p-0"
                                        data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                        aria-controls="collapseOne">
                                        Uncompromised Quality <i class="fas fa-sort-down float-right"></i>
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                data-parent="#accordion">
                                <div class="card-body px-xl-5 py-0">
                                    <p class="mb-7">Every piece we create is made using <b>top-tier fabrics</b> and
                                        crafted
                                        with attention to detail. Our mission is simple: deliver clothes that feel as good
                                        as they look.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-2">
                            <div class="card-header px-xl-5 py-xl-3" id="headingTwo">
                                <h5 class="mb-0">
                                    <button class="btn btn-link fwEbold text-uppercase text-left w-100 collapsed p-0"
                                        data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                        aria-controls="collapseTwo">
                                        Effortless Shopping Experience <i class="fas fa-sort-down float-right"></i>
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body px-xl-5 py-0">
                                    <p class="mb-7">From a user-friendly website to smooth checkout and <b>on-time
                                            deliveries,</b> we’re all about making your online shopping experience as easy
                                        and enjoyable as possible.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-2">
                            <div class="card-header px-xl-5 py-xl-3" id="headingThree">
                                <h5 class="mb-0">
                                    <button class="btn btn-link fwEbold text-uppercase text-left w-100 collapsed p-0"
                                        data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        Customer-Centric Policies <i class="fas fa-sort-down float-right"></i>
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                data-parent="#accordion">
                                <div class="card-body px-xl-5 py-0">
                                    <p class="mb-7">Shopping online should be worry-free. That’s why we offer a
                                        <b>shopper-friendly return policy</b> – because your satisfaction is our priority.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-2">
                            <div class="card-header px-xl-5 py-xl-3" id="headingFour">
                                <h5 class="mb-0">
                                    <button class="btn btn-link fwEbold text-uppercase text-left w-100 collapsed p-0"
                                        data-toggle="collapse" data-target="#collapseFour" aria-expanded="false"
                                        aria-controls="collapseFour">
                                        Fashion for Everyone <i class="fas fa-sort-down float-right"></i>
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                                <div class="card-body px-xl-5 py-0">
                                    <p class="mb-7">Whether you're lounging at home, heading out with friends, or
                                        dressing
                                        up your little ones, Grabmany helps you stay effortlessly stylish every day.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h4 class="text-center d-flex justify-content-center align-items-center mt-5">
                We’re not just a clothing brand – we’re a lifestyle choice for those who value quality, comfort, and
                convenience.
            </h4>

        </div>
    </section>
    <section class="processStepSec container pt-xl-23 pb-xl-10 pt-lg-20 pb-lg-10 pt-md-16 pb-md-8 pt-10 pb-0"
        style="background: url(/assets/images/about-back.jpg);">
        <div class="row">
            <header class="col-12 mainHeader mb-3 text-center">
                <h1 class="headingIV playfair fwEblod mb-4">Delivery Process</h1>
                <span class="headerBorder d-block mb-5"><img src="/assets/images/hbdr.png" alt="Header Border"
                        class="img-fluid img-bdr"></span>
            </header>
        </div>
        <div class="row">
            <div class="col-12 pl-xl-23 mb-lg-3 mb-10">
                <div class="stepCol position-relative bg-lightGray py-6 px-6">
                    <strong class="mainTitle text-uppercase mt-n8 mb-5 d-block text-center py-1 px-3">step 01</strong>
                    <h2 class="headingV fwEblod text-uppercase mb-3">Choose your products</h2>
                    <p class="mb-5">There are many variations of passages of lorem ipsum available, but the majority have
                        suffered alteration in some form, by injected humour. Both betanin</p>
                </div>
            </div>
            <div class="col-12 pr-xl-23 mb-lg-3 mb-10">
                <div class="stepCol rightArrow position-relative bg-lightGray py-6 px-6 float-right">
                    <strong class="mainTitle text-uppercase mt-n8 mb-5 d-block text-center py-1 px-3">step 02</strong>
                    <h2 class="headingV fwEblod text-uppercase mb-3">Connect nearest stored</h2>
                    <p class="mb-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                        Ipsum
                        has been the industry's standard dummy text ever since the 1500s.</p>
                </div>
            </div>
            <div class="col-12 pl-xl-23 mb-lg-3 mb-10">
                <div class="stepCol position-relative bg-lightGray py-6 px-6">
                    <strong class="mainTitle text-uppercase mt-n8 mb-5 d-block text-center py-1 px-3">step 03</strong>
                    <h2 class="headingV fwEblod text-uppercase mb-3">Share your location</h2>
                    <p class="mb-5">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                        laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore</p>
                </div>
            </div>
            <div class="col-12 pr-xl-23 mb-lg-3 mb-10">
                <div class="stepCol rightArrow position-relative bg-lightGray py-6 px-6 float-right">
                    <strong class="mainTitle text-uppercase mt-n8 mb-5 d-block text-center py-1 px-3">step 04</strong>
                    <h2 class="headingV fwEblod text-uppercase mb-3">Get delivered fast</h2>
                    <p class="mb-5">On the other hand, we denounce with righteous indignation and dislike men who are so
                        beguiled and demoralized by the charms of pleasure of the moment.</p>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const counters = document.querySelectorAll('.counter');

            const animateCounter = (el) => {
                const target = +el.innerText;
                let count = 0;
                const duration = 2000; // duration in ms
                const stepTime = Math.max(Math.floor(duration / target), 20); // avoid too fast updates

                const updateCounter = () => {
                    count += 1;
                    el.innerText = count;
                    if (count < target) {
                        setTimeout(updateCounter, stepTime);
                    } else {
                        el.innerText = target;
                    }
                };

                updateCounter();
            };

            const observer = new IntersectionObserver((entries, obs) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const el = entry.target;
                        animateCounter(el);
                        obs.unobserve(el); // animate only once
                    }
                });
            }, {
                threshold: 1.0
            });

            counters.forEach(counter => {
                observer.observe(counter);
            });
        });
    </script>
@endsection