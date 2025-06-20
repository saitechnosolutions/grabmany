@extends('layouts.default')
@section('main-content')
<style>
    .subscribeSecBlock{
        display: none;
    }
</style>
<section class="introBannerHolder d-flex w-100 bgCover" style="background-image: ;">
				<div class="container">
					<div class="row">
						<div class="col-12 pt-lg-23 pt-md-15 pt-sm-10 pt-6 text-center">
							<h1 class="headingIV fwEbold playfair mb-4">Contact</h1>
							<ul class="list-unstyled breadCrumbs d-flex justify-content-center">
								<li class="mr-2"><a href="/">Home</a></li>
								<li class="mr-2">/</li>
								<li class="active">Contact</li>
							</ul>
						</div>
					</div>
				</div>
			</section>
			<div class="contactSec container pt-xl-24 pb-xl-23 py-lg-20 pt-md-16 pb-md-10 pt-10 pb-0">
				<div class="row">
					<div class="col-12">
						<ul class="list-unstyled contactListHolder mb-0 d-flex flex-wrap text-center">
							<li class="mb-lg-0 mb-6">
								<span class="icon d-block mx-auto bg-lightGray py-4 mb-4"><i class="fas fa-map-marker-alt"></i></span>
								<strong class="title text-uppercase playfair mb-5 d-block">address</strong>
								<address class="mb-0">Grabmany Pvt Ltd, 116, <br> Goodwill Promoters, Roja Street, Porur, <br>  Chennai - 600125
<span class="d-block"></span></address>
							</li>
							<li class="mb-lg-0 mb-6">
								<span class="icon d-block mx-auto bg-lightGray py-4 mb-3"><i class="fas fa-headphones"></i></span>
								<strong class="title text-uppercase playfair mb-5 d-block">phone</strong>
								<a href="tel:99622 38784" class="d-block">+91 99622 38784</a>
								<!-- <a href="tel:9385569919" class="d-block">(+84) - 321 - 654 - 987</a> -->
							</li>
							<li class="mb-lg-0 mb-6">
								<span class="icon d-block mx-auto bg-lightGray py-5 mb-3"><i class="fas fa-envelope"></i></span>
								<strong class="title text-uppercase playfair mb-5 d-block">email</strong>
								<a href="mailto:nfo@grabmany.com" class="d-block"> nfo@grabmany.com</a>
								<!-- <a href="#" class="d-block">info@Two.lnk</a> -->
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- mapHolder -->
			<!-- <div class="mapHolder">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3903.6435465965324!2d79.78338577371376!3d11.929876336863062!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a536199883963a5%3A0x1e3ff775dfc45a47!2sKrishna&#39;s%20Dwaraka!5e0!3m2!1sen!2sin!4v1744952400877!5m2!1sen!2sin" style="border:0;" allowfullscreen="">
				</iframe>

			</div> -->
			<section class="contactSecBlock container pt-xl-23 pb-xl-24 pt-lg-20 pb-lg-10 pt-md-16 pb-md-8 py-10">
				<div class="row">
					<header class="col-12 mainHeader mb-10 text-center">
						<h1 class="headingIV playfair fwEblod mb-7">Get In Touch</h1>
						<p>Give your valuable feedbacks and enquiries to us!<br class="d-block"> We are reach you soon!</p>
					</header>
				</div>
				<div class="row">
					<div class="col-12">
						<form class="contactForm">
							<div class="d-flex flex-wrap row1 mb-md-1">
								<div class="form-group coll mb-5">
									<input type="text" id="name" class="form-control" name="name" placeholder="Your name  *">
								</div>
								<div class="form-group coll mb-5">
									<input type="email" class="form-control" id="email" name="Email" placeholder="Your email  *">
								</div>
								<div class="form-group coll mb-5">
									<input type="tel" class="form-control" id="tel" name="tel" placeholder="Telephone number  *">
								</div>
							</div>
							<div class="form-group w-100 mb-6">
								<textarea class="form-control" placeholder="Meesage  *"></textarea>
							</div>
							<div class="text-center">
								<button type="submit" class="btn btnTheme btnShop md-round fwEbold text-white py-3 px-4 py-md-3 px-md-4">Send Message</button>
							</div>
						</form>
					</div>
				</div>
			</section>
@endsection
