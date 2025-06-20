@extends('layouts.default')
@section('main-content')
    <style>
        .about-card {
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        .about-card_title {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .about-card_text {
            font-size: 16px;
            color: #555;
            line-height: 1.7;
        }

        .team-info ul {
            list-style: none;
            padding-left: 0;
            margin-top: 20px;
        }

        .team-info ul li {
            margin-bottom: 10px;
            font-size: 16px;
        }

        .team-info ul li b {
            color: #333;
        }

        .edit-button {
            background-color: #01236a;
            color: #fff;
            padding: 6px 16px;
            border-radius: 6px;
            border: none;
        }

        .edit-button:hover {
            background-color: #347c2f;
        }

        .widget.widget_categories {
            background: #f9f9f9;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.03);
        }

        .widget_title {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .tagcloud li {
            list-style: none;
            margin-bottom: 10px;
        }

        .tagcloud a {
            display: block;
            background-color: #e0e0e0;
            padding: 10px 20px;
            border-radius: 8px;
            color: #333;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .tagcloud a:hover {
            background-color: #01236a;
            color: #fff;
        }

        .modal-content {
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .modal-title {
            font-weight: 600;
        }

        .form-label {
            font-weight: 500;
        }

        .form-control {
            background-color: #fff !important;
        }

        .btn-primary {
            background-color: #01236a;
            border-color: #01236a;
        }

        .btn-primary:hover {
            background-color: #347c2f;
            border-color: #347c2f;
        }

        .subscribeSecBlock {
            display: none !important;
        }

        label {
            display: inline-block;
            margin-bottom: -2px !important;
        }
    </style>
    <section class="th-blog-wrapper mt-5 pt-5 space-extra-bottom">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-xxl-8 col-lg-7">
                    <div class="about-card">
                        <div class="about-card_content mb-50">
                            <h4 class="about-card_title text-theme" style="    text-transform: capitalize;">
                                {{ Auth::User()->name }}
                            </h4>

                            <p class="  my-3" style="    text-transform: capitalize;"><b>Hello {{ Auth::User()->name }},</b>
                            </p>
                            <p class="about-card_text">From your account you can easily view and track orders. You can
                                manage and
                                change your account information like address, contact information and
                                history of orders.</p>
                            <div class="row my-3">
                                <div class="col-6 start">
                                    <div class="" fdprocessedid="r51a0u">Account Information</div>
                                </div>
                                <div class="col-6 text-end"><button class="th-btn edit-button" fdprocessedid="r51a0u"
                                        data-toggle="modal" data-target="#exampleModal"
                                        data-whatever="@getbootstrap">Edit</button></div>
                            </div>
                            <div class="team-info">
                                <ul>
                                    <li><b>User Name:</b> <span
                                            style="    text-transform: capitalize;">{{ Auth::User()->name }}</span></li>
                                    <li><b>Phone Number:</b> <a href="tel:+16325643654"
                                            style="color:#000;">{{ Auth::User()->phone }}</a></li>
                                    <li><b>Email:</b>
                                        <a href="mailto:danielmartin@gmail.com"
                                            style="color:#000;">{{ Auth::User()->email }}</a>
                                    </li>

                                </ul>
                            </div>

                        </div>
                    </div>





                </div>
                <div class="col-xxl-4 col-lg-5">
                    <aside class="sidebar-area">

                        <div class="widget widget_categories  ">
                            <h3 class="widget_title">My Account</h3>
                            <ul class="tagcloud">
                                <li>
                                    <a href="/userprofile" class="py-3"
                                        style="  background:#01236a;color:#fff">Profile</a>
                                    {{-- <span>(8)</span> --}}
                                </li>
                                <li>
                                    <a href="/orderhistory" class="py-3"> Order History</a>
                                    {{-- <span>(6)</span> --}}
                                </li>
                                <li>
                                    <a href="/cart" class="py-3">Cart</a>
                                    {{-- <span>(5)</span> --}}
                                </li>
                                <li>
                                    <a href="/logout" class="py-3">Logout</a>
                                    {{-- <span>(2)</span> --}}
                                </li>

                            </ul>
                        </div>

                    </aside>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm" action="/edituser" method="post">
                        @csrf
                        <input type="hidden" class="form-control" name="editid" value="{{ Auth::User()->id }}">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" value="{{ Auth::User()->name }}"
                                name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="mobile" class="form-label">Mobile Number</label>
                            <input type="text" class="form-control" id="mobile" value="{{ Auth::User()->phone }}"
                                name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ Auth::User()->email }}" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
                <!-- <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Send message</button>
                                              </div> -->
            </div>
        </div>
    </div>
    <!-- <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true"
                                                style="">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editUserModalLabel">Edit User Details</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="editUserForm" action="/edituser" method="post">
                                                                @csrf
                                                                <input type="hidden" class="form-control" name="editid" value="{{ Auth::User()->id }}">
                                                                <div class="mb-3">
                                                                    <label for="username" class="form-label">Username</label>
                                                                    <input type="text" class="form-control" id="username" value="{{ Auth::User()->name }}"
                                                                        name="name" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="mobile" class="form-label">Mobile Number</label>
                                                                    <input type="text" class="form-control" id="mobile" value="{{ Auth::User()->phone }}"
                                                                        name="phone" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="email" class="form-label">Email</label>
                                                                    <input type="email" class="form-control" id="email" name="email"
                                                                        value="{{ Auth::User()->email }}" required>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
@endsection
