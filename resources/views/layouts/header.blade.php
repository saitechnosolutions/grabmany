<style>
    .nav-item .dropdown-menu {
        min-width: 150px;
    }

    .nav-item .dropdown-menu a {
        padding: 8px 12px;
        display: block;
        color: #333;
        font-size: 14px;
    }

    .nav-item .dropdown-menu a:hover {
        background-color: #f0f0f0;
    }
</style>


<style>
    .swiper-container {
        width: 100%;
        padding: 20px 138px;
    }

    .swiper-wrapper {
        display: flex;
    }

    .swiper-slide {
        text-align: center;
        font-size: 14px;
        width: auto;
    }

    .swiper-slide img {

        object-fit: cover;
        display: block;
        margin: 0 auto;
    }

    .announcement-bar {
        /* background-color: #000000; */
        background-color: #08137a;
        color: #ffffff;
        text-align: center;
        padding: 10px 20px;
        position: relative;
        width: 100%;
        box-sizing: border-box;
        font-size: 14px;
        display: flex;
        justify-content: center;
        overflow: hidden;
    }

    .announcement-slider {
        width: 100%;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .announcement-content {
        display: flex;
        position: relative;
        min-height: 24px;
        align-items: center;
        justify-content: center;
        width: 100%;
    }

    .announcement-item {
        position: absolute;
        width: 100%;
        opacity: 0;
        transition: opacity 0.5s ease-in-out;
        text-align: center;
    }

    .announcement-item.active {
        opacity: 1;
    }

    .announcement-bar a {
        color: #ffffff;
        text-decoration: underline;
    }

    .announcement-controls {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 10px;
    }

    .announcement-arrow {
        cursor: pointer;
        font-size: 16px;
        padding: 0 5px;
    }

    .announcement-dots {
        position: absolute;
        bottom: -25px;
        width: 100%;
        display: flex;
        justify-content: center;
        margin-top: 5px;
    }
</style>
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />




<div class="announcement-bar">
    <div class="announcement-controls">
        <span class="announcement-arrow" id="prev-arrow">‹</span>
    </div>

    <div class="announcement-slider">
        <div class="announcement-content">
            <div class="announcement-item active">
                FREE SHIPPING ON ALL ORDERS OVER $50 - <a href="#">SHOP NOW</a>
            </div>
            <div class="announcement-item">
                NEW COLLECTION JUST ARRIVED - <a href="#">SEE MORE</a>
            </div>
            <div class="announcement-item">
                LIMITED TIME: 20% OFF SITEWIDE - <a href="#">USE CODE: SPRING20</a>
            </div>
        </div>
    </div>

    <div class="announcement-controls">
        <span class="announcement-arrow" id="next-arrow">›</span>
    </div>
</div>

<header id="header" class="position-relative" style="background: linear-gradient(135deg, #ffffff 0%, #81c784 100%);">
    {{-- <header id="header" class="position-relative" style="background: #47db92"> --}}
    <!-- headerHolderCol -->
    <!-- <marquee> -->
    {{-- <div class="headerHolderCol pt-lg-4 ">
		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-4">
					<a href="tel:9385569919" class="tel d-flex align-items-end"><i class="icon-call mr-2"></i>
						+919385569919</a>
				</div>
				<div class="col-12 col-sm-4 text-center">
					<span class="txt d-block">Wellcome To Grab Many</span>
				</div>
				<div class="col-12 col-sm-4">
					<!-- langListII -->
					<ul class="nav nav-tabs langListII justify-content-end border-bottom-0">
						<li class="mb-3 d-flex flex-nowrap"><span class="icon icon-place mr-3"></span>
							<address class=" m-0"> Chennai</address>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div> --}}
    <!-- </marquee> -->
    <!-- headerHolder -->
    <div class="headerHolder container 	" style="padding: 10px;">
        <div class="row">
            <div class="col-6 col-sm-2">
                <!-- mainLogo -->
                <div class="logo">
                    <a href="/"><img src="/assets/images/logo.png" alt="Botanical" class="img-fluid"
                            style="width:80%;"></a>
                </div>

            </div>
            <div class="col-6 col-sm-7 col-lg-7 static-block">
                <!-- mainHolder -->
                <div class="mainHolder pt-lg-5 pt-3 justify-content-center">
                    <!-- pageNav2 -->
                    <nav class="navbar navbar-expand-lg navbar-light p-0 pageNav2 position-static">
                        <button type="button" class="navbar-toggle collapsed position-relative" data-toggle="collapse"
                            data-target="#navbarNav" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav" style="margin-top: 6px;">
                            <ul class="navbar-nav mx-auto text-uppercase d-inline-block">


                                <li class="nav-item">
                                    <a class="d-block" href="/">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/products" class="nav-link dropdown-toggle" id="navbarDropdown shopLink "
                                        role="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Shop
                                    </a>

                                    <ul class="dropdown-menu">



                                    </ul>
                                </li>


                                <li class="nav-item">
                                    <a class="d-block" href="/about">About</a>
                                </li>

                                <li class="nav-item">
                                    <a class="d-block" href="/contact">contact</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="col-sm-3 col-lg-3">
                <!-- wishListII -->
                <ul class="nav nav-tabs wishListII pt-5 justify-content-end border-bottom-0">
                    <!-- <li class="nav-item ml-0"><a class="nav-link icon-search" href="javascript:void(0);"></a></li> -->
                    <li class="nav-item">
                        <a class="nav-link position-relative " href="/wishlist">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-heart-icon lucide-heart">
                                <path
                                    d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z" />
                            </svg>

                            <span class="num rounded d-block">
                                @auth
                                    {{ App\Models\Wishlist::where('user_id', Auth::id())->count() }}
                                @else
                                    0
                                @endauth

                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link position-relative " href="/cart">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_16_216)">
                                    <path
                                        d="M14.0559 4.375C14.0559 3.80208 13.9329 3.2487 13.6868 2.71484C13.4407 2.19401 13.1169 1.73177 12.7154 1.32812C12.3138 0.924479 11.8476 0.598959 11.3165 0.351562C10.7984 0.117188 10.2609 0 9.70395 0C9.147 0 8.60948 0.117188 8.09139 0.351562C7.56034 0.598959 7.09406 0.924479 6.69254 1.32812C6.29102 1.73177 5.96721 2.19401 5.72111 2.71484C5.47502 3.2487 5.35197 3.80208 5.35197 4.375H1V16.875C1 17.8125 1.32381 18.5677 1.97142 19.1406C2.61904 19.7135 3.33141 20 4.10855 20H15.2993C16.0765 20 16.7889 19.7103 17.4365 19.1309C18.0841 18.5514 18.4079 17.7995 18.4079 16.875V4.375H14.0559ZM17.1645 16.875C17.1645 17.6562 16.9054 18.1641 16.3873 18.3984C15.8692 18.6328 15.2993 18.75 14.6776 18.75H4.73026C4.1215 18.75 3.55484 18.6328 3.03027 18.3984C2.50571 18.1641 2.24342 17.6562 2.24342 16.875V5.625H5.35197V8.125H6.59539V5.625H12.8125V8.125H14.0559V5.625H17.1645V16.875ZM6.59539 4.375C6.59539 3.6849 6.84149 2.99154 7.33368 2.29492C7.82586 1.59831 8.61595 1.25 9.70395 1.25C10.7919 1.25 11.582 1.59831 12.0742 2.29492C12.5664 2.99154 12.8125 3.6849 12.8125 4.375H6.59539Z"
                                        fill="#4C4C4C"></path>
                                </g>
                                <defs>
                                    <clipPath id="clip0_16_216">
                                        <rect width="18" height="20" fill="white"
                                            transform="matrix(1 0 0 -1 1 20)">
                                        </rect>
                                    </clipPath>
                                </defs>
                            </svg>

                            <span class="num rounded d-block">
                                @auth
                                    {{ App\Models\cart::where('user_id', Auth::id())->count() }}
                                @else
                                    0
                                @endauth
                            </span>
                        </a>
                    </li>

                    @if (Auth::check())
                        <li class="nav-item">
                            <a class="nav-link " href="/profile">
                                <span class="icon icon-header icon-user">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.99913 11.1662C12.4537 11.1662 14.4436 9.17639 14.4436 6.72179C14.4436 4.26719 12.4537 2.27734 9.99913 2.27734C7.54453 2.27734 5.55469 4.26719 5.55469 6.72179C5.55469 9.17639 7.54453 11.1662 9.99913 11.1662Z"
                                            stroke="#4C4C4C" stroke-width="1.11111"></path>
                                        <path
                                            d="M3 19.4673C3 19.4673 3.00029 12 10.0006 12C17.0009 12 17 19.4673 17 19.4673"
                                            stroke="#4C4C4C"></path>
                                    </svg>
                                </span>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link " href="/login">
                                <span class="icon icon-header icon-user">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.99913 11.1662C12.4537 11.1662 14.4436 9.17639 14.4436 6.72179C14.4436 4.26719 12.4537 2.27734 9.99913 2.27734C7.54453 2.27734 5.55469 4.26719 5.55469 6.72179C5.55469 9.17639 7.54453 11.1662 9.99913 11.1662Z"
                                            stroke="#4C4C4C" stroke-width="1.11111"></path>
                                        <path
                                            d="M3 19.4673C3 19.4673 3.00029 12 10.0006 12C17.0009 12 17 19.4673 17 19.4673"
                                            stroke="#4C4C4C"></path>
                                    </svg>
                                </span>
                            </a>
                        </li>
                    @endif

                </ul>
            </div>
        </div>
    </div>
</header>

@if (!Request::is('about') && !Request::is('contact'))
    {{-- <div class="con">
	<div class="swiper-container">
		<ul class="swiper-wrapper">
			@php
			$cati = App\Models\category::all();
			@endphp
			@foreach ($cati as $catia)
			<li class="swiper-slide">
				<a href="/products/{{ $catia->id }}" style="color:#212529;">

					<img class="mt-2" src="{{ env('MAIN_URL') }}assets/uploads/{{ $catia->category_image }}" alt=""
						width="40">{{ $catia->category_name }}
				</a>
			</li>
			@endforeach
		</ul>
	</div>
</div> --}}
@endif

<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 7,
        spaceBetween: 5,
        loop: false,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const shopLink = document.querySelector('.nav-link.dropdown-toggle');
        const dropdownMenu = shopLink.nextElementSibling;

        // Enable dropdown on hover or click
        shopLink.addEventListener('mouseenter', () => {
            dropdownMenu.classList.add('show');
            shopLink.setAttribute('aria-expanded', 'true');
        });

        shopLink.addEventListener('mouseleave', () => {
            setTimeout(() => {
                dropdownMenu.classList.remove('show');
                shopLink.setAttribute('aria-expanded', 'false');
            }, 300);
        });

        dropdownMenu.addEventListener('mouseenter', () => {
            dropdownMenu.classList.add('show');
        });

        dropdownMenu.addEventListener('mouseleave', () => {
            dropdownMenu.classList.remove('show');
            shopLink.setAttribute('aria-expanded', 'false');
        });

        // Allow "Shop" link to work even with dropdown
        shopLink.addEventListener('click', function(e) {
            window.location.href = this.getAttribute('href');
        });
    });
</script>

<script>
    // Get all announcement items and arrows
    const items = document.querySelectorAll('.announcement-item');
    const prevArrow = document.getElementById('prev-arrow');
    const nextArrow = document.getElementById('next-arrow');

    let currentIndex = 0;
    const itemCount = items.length;

    // Function to show specific announcement
    function showAnnouncement(index) {
        // Remove active class from all items
        items.forEach(item => {
            item.classList.remove('active');
        });

        // Add active class to current item
        items[index].classList.add('active');
        currentIndex = index;
    }

    // Next announcement
    function nextAnnouncement() {
        let nextIndex = (currentIndex + 1) % itemCount;
        showAnnouncement(nextIndex);
    }

    // Previous announcement
    function prevAnnouncement() {
        let prevIndex = (currentIndex - 1 + itemCount) % itemCount;
        showAnnouncement(prevIndex);
    }

    // Add event listeners to arrows
    nextArrow.addEventListener('click', nextAnnouncement);
    prevArrow.addEventListener('click', prevAnnouncement);

    // Auto-rotate announcements every 5 seconds
    setInterval(nextAnnouncement, 5000);
</script>
