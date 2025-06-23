@extends('layouts.default')
@section('main-content')
    <section>
        <div class="container">
            <div class="row p-5">
                <div class="col-lg-2">

                </div>
                <div class="col-lg-8">
                    <div id="first_stage_forget">
                        <div class="card">
                            <div class="card-body mt-4">
                                <h3>
                                    Reset Your Password
                                </h3>
                                <p class="mt-3">
                                    Enter your registered Phone Number to reset your password.
                                </p>
                                <form action="" id="forget_password_email_submit">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="forget_pass_email_input"
                                            aria-describedby="emailHelp" minlength="10" maxlength="10" required>
                                    </div>
                                    <button type="submit"
                                        class="btn btnTheme btnShop md-round fwEbold text-white py-3 px-4 py-md-3 px-md-4">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div id="second_stage_forget">
                        <form action="" id="forget_password_password_submit">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">New Password</label>
                                <input type="text" class="form-control" id="forget_pass_password_input"
                                    aria-describedby="emailHelp" required>
                            </div>
                            <input type="hidden" id="forget_pass_hidden_user">
                            <button type="submit"
                                class="btn btnTheme btnShop md-round fwEbold text-white py-3 px-4 py-md-3 px-md-4">Submit</button>
                        </form>
                    </div>

                </div>
                <div class="col-g-2">

                </div>
            </div>
        </div>
    </section>
@endsection
