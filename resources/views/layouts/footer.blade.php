<aside
    class="footerHolder bg-lightGray footer container-fluid overflow-hidden px-xl-20 px-lg-14 pt-xl-12 pb-xl-8 pt-lg-12 pt-md-8 pt-10 pb-lg-8">
    <div class="d-flex flex-wrap flex-lg-nowrap">
        <div class="coll-1 pr-3 mb-sm-4 mb-3 mb-lg-0">
            <h3 class="headingVI fwEbold text-uppercase mb-7">Contact Us</h3>
            <ul class="list-unstyled footerContactList mb-3">
                <li class="mb-3 d-flex flex-nowrap"><span class="icon icon-place mr-3"></span>
                    <address class="fwEbold m-0">Address: Grabmany Pvt Ltd, 116, Goodwill Promoters, Roja Street, Porur,
                        Chennai - 600125 .
                        .</address>
                </li>
                <li class="mb-3 d-flex flex-nowrap"><span class="icon icon-phone mr-3"></span> <span
                        class="leftAlign">Phone : <a href="tel:99622 38784;">+9199622 38784</a></span></li>
                <li class="email d-flex flex-nowrap"><span class="icon icon-email mr-2"></span> <span
                        class="leftAlign">Email: <a href="mailto: info@grabmany.com;"> info@grabmany.com</a></span></li>
            </ul>

        </div>
        <div class="coll-2 mb-sm-4 mb-3 mb-lg-0">
            <h3 class="headingVI fwEbold text-uppercase mb-6">Quick Links</h3>
            <ul class="list-unstyled footerNavList">
                <li class="mb-1"><a href="/">Home</a></li>
                <li class="mb-2"><a href="/about">About</a></li>
                <li class="mb-2"><a href="/cart">Cart</a></li>
                <li class="mb-2"><a href="/contact">Contact</a></li>
            </ul>
        </div>
        <div class="coll-3 mb-sm-4 mb-3 mb-lg-0">
            <h3 class="headingVI fwEbold text-uppercase mb-6">My Account</h3>
            <ul class="list-unstyled footerNavList">
                @if (Auth::check())
                    <li class="mb-1"><a href="/profile">My account</a></li>
                    <li class="mb-2"><a href="/orderhistory">Orders history</a></li>
                @else
                    <li class="mb-1"><a href="/login">My account</a></li>
                    <li class="mb-2"><a href="/login">Orders history</a></li>
                @endif

            </ul>
        </div>
        <div class="coll-3 mb-sm-4 mb-3 mb-lg-0">
            <h3 class="headingVI fwEbold text-uppercase mb-6">Social Media Links</h3>
            <ul class="list-unstyled followSocailNetwork d-flex flex-nowrap">
                <!-- <li class="fwEbold mr-xl-11 mr-sm-6 mr-4">Follow us:</li> -->
                <li class="mr-xl-6 mr-sm-4 mr-2"><a href="javascript:void(0);" class="fab fa-facebook-f"></a></li>
                <li class="mr-xl-6 mr-sm-4 mr-2"><a href="javascript:void(0);" class="fab fa-instagram"></a></li>
                {{-- <li class="mr-xl-6 mr-sm-4 mr-2"><a href="javascript:void(0);" class="fab fa-pinterest"></a></li>
                <li class="mr-2"><a href="javascript:void(0);" class="fab fa-google-plus-g"></a></li> --}}
            </ul>
        </div>


    </div>
</aside>

<footer id="footer" class="container-fluid overflow-hidden px-lg-20 bg-dark" style="background: #90c892 !important;">
    <div class="col-12 copyRightHolder v-II text-center pt-md-3 pb-md-4 py-2" style="color: #000;">
        <p class="mb-0">Copyright 2025 by <a href="javascript:void(0);">Grab Many</a> - All right reserved</p>
    </div>
</footer>