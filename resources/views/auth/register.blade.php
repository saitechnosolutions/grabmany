@extends('layouts.default')
@section('main-content')
    <style>
        /* General Section Styles */
        .track-area {
            padding: 40px 20px;
            background: #f9f9f9;
        }

        /* Login Section */
        .login-section {
            display: flex;
            justify-content: center;
            margin-bottom: 40px;
        }

        .login-box {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            padding: 30px;
            width: 100%;
            max-width: 675px;
        }

        .login-icon {
            font-size: 28px;
            color: #01236a;
            margin-bottom: 15px;
        }

        .login-content h4 {
            font-size: 22px;
            color: #333;
            margin-bottom: 10px;
        }

        .login-content p {
            font-size: 14px;
            color: #555;
        }

        .login-input {
            display: flex;
            align-items: center;
            background: #f1f1f1;
            border-radius: 8px;
            margin-bottom: 15px;
            padding: 10px;
        }

        .login-input span {
            margin-right: 10px;
            color: #01236a;
        }

        .login-input input {
            border: none;
            background: transparent;
            flex: 1;
            padding: 10px;
            font-size: 15px;
        }

        .remember-forget {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me input {
            margin-right: 5px;
        }

        .login-btn {
            text-align: center;
        }

        .btn-submit {
            background: #01236a;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 30px;
            font-size: 15px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
        }

        .btn-submit i {
            margin-left: 8px;
        }

        .btn-submit:hover {
            background: #b147b2;
        }

        /* Register Section */
        .register-section {
            display: flex;
            justify-content: center;
        }

        .register-box {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            padding: 30px;
            width: 100%;
            max-width: 675px;
        }

        .register-icon {
            font-size: 28px;
            color: #01236a;
            margin-bottom: 15px;
        }

        .register-content h4 {
            font-size: 22px;
            color: #333;
            margin-bottom: 10px;
        }

        .register-content p {
            font-size: 14px;
            color: #555;
        }

        .register-input {
            display: flex;
            align-items: center;
            background: #f1f1f1;
            border-radius: 8px;
            margin-bottom: 15px;
            padding: 10px;
        }

        .register-input span {
            margin-right: 10px;
            color: #01236a;
        }

        .register-input input {
            border: none;
            background: transparent;
            flex: 1;
            padding: 10px;
            font-size: 15px;
        }

        .have-account {
            text-align: center;
            margin-bottom: 15px;
        }

        .have-account a {
            color: #01236a;
            font-size: 14px;
        }

        .register-btn {
            text-align: center;
        }

        .register-btn .btn-submit {
            background: #01236a;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 30px;
            font-size: 15px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
        }

        .register-btn .btn-submit i {
            margin-left: 8px;
        }

        .register-btn .btn-submit:hover {
            background: #b147b2;
        }

        .subscribeSecBlock {
            display: none !important;
        }
    </style>



    <section class="track-area pb-40">
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <div class="register-section">
                    <div class="register-box">
                        <div class="register-icon">
                            <i class="fa fa-lock"></i>
                        </div>
                        <div class="register-content">
                            <h4>Sign Up</h4>
                            <p>Create your account to enjoy all the features.</p>
                        </div>
                        <form action="/register" method="POST">
                            @csrf
                            <div class="register-input">
                                <span><i class="fa fa-user"></i></span>
                                <input type="text" name="name" placeholder="Full Name" required>
                            </div>
                            <div class="register-input">
                                <span><i class="fa fa-envelope"></i></span>
                                <input type="email" name="email" placeholder="Email" required>
                            </div>
                            <div class="register-input">
                                <span><i class="fa fa-phone"></i></span>
                                <input type="text" name="phone" placeholder="Phone" required>
                            </div>
                            <div class="register-input">
                                <span><i class="fa fa-key"></i></span>
                                <input type="password" name="password" placeholder="Password" required>
                            </div>
                            <div class="have-account">
                                <a href="/login">Already Have an Account?</a>
                            </div>
                            <div class="register-btn">
                                <button type="submit" class="btn-submit">Register Now <i
                                        class="fa fa-long-arrow-right"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Login Section -->


        <!-- Register Section -->

    </section>

    <script>
        const loginBtn = document.getElementById("loginBtn");
        const registerBtn = document.getElementById("registerBtn");
        const loginForm = document.getElementById("loginForm");
        const registerForm = document.getElementById("registerForm");

        loginBtn.onclick = function() {
            loginBtn.classList.add("active");
            registerBtn.classList.remove("active");
            loginForm.classList.add("active");
            registerForm.classList.remove("active");
        };

        registerBtn.onclick = function() {
            registerBtn.classList.add("active");
            loginBtn.classList.remove("active");
            registerForm.classList.add("active");
            loginForm.classList.remove("active");
        };
    </script>

    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"></script>
    <script>
        const addValidator = new JustValidate("#loginform", {
                validateBeforeSubmitting: true,

            })


            .addField('#log_phone', [{
                    rule: 'required',
                    errorMessage: "Mobile Number is required",
                },
                {
                    rule: 'minLength',
                    value: 10,
                    message: 'Phone number must be min 10 numbers.',
                },
                {
                    rule: 'maxLength',
                    value: 10,
                    message: 'Phone number must be max 10 numbers.',
                },
                {
                    rule: 'customRegexp',
                    value: /^[0-9]+$/,
                    errorMessage: 'Phone number should  contain numbers'
                }

            ])


            .addField('#log_password', [{
                    rule: 'required',

                },


            ])


            .onSuccess((event) => {
                $('#loginform').submit();
            });
    </script>
    <script>
        const addValidator1 = new JustValidate("#registerform", {
                validateBeforeSubmitting: true,

            })
            .addField("#reg_name", [{
                    rule: "required",
                    errorMessage: "Name is required",
                },
                {
                    rule: 'minLength',
                    value: 3,
                    errorMessage: '*Name should be at least 3 characters long',
                },
                {
                    rule: 'maxLength',
                    value: 30,
                    errorMessage: '*Name should be at maximum 30 characters long',
                },
                {
                    rule: 'customRegexp',
                    value: /^[a-zA-Z\s.]+$/,
                    errorMessage: '*Name should not contain numbers or symbols'
                }
            ])
            .addField('#reg_email', [{
                    rule: 'required',
                    errorMessage: "Email is required",
                },
                {
                    rule: 'email',
                },

            ])

            .addField('#reg_phone', [{
                    rule: 'required',
                    errorMessage: "Mobile Number is required",
                },
                {
                    rule: 'minLength',
                    value: 10,
                    message: 'Phone number must be min 10 numbers.',
                },
                {
                    rule: 'maxLength',
                    value: 10,
                    message: 'Phone number must be max 10 numbers.',
                },
                {
                    rule: 'customRegexp',
                    value: /^[0-9]+$/,
                    errorMessage: 'Phone number should  contain numbers'
                }

            ])


            .addField('#reg_password', [{
                    rule: 'required',

                },

            ])


            .onSuccess((event) => {
                $('#registerform').submit();
            });
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(".toggle-password").click(function() {
            $(this).toggleClass("field-icon");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
@endsection
