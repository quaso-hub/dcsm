@extends('auth.layouts.master')
@section('title', 'Login-sa-validation')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/sweetalert2.css') }}">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <div class="login-card">
                    <div>
                        <div>
                            <a class="logo text-start" href="{{ route('login.form') }}"
                                class="d-flex align-items-center gap-2 text-decoration-none sidebar-logo animated-logo">

                                <i class="bi bi-shop fs-4 text-danger logo-icon"></i>

                                <span class="fw-bold fs-5 text-dark for-light m-0">AJOFOOD</span>

                                <span class="fw-bold fs-5 text-light for-dark m-0">AJOFOOD</span>
                            </a>
                        </div>

                        <div class="login-main">
                            <div class="theme-form">
                                <h4>Sign in to account</h4>
                                <p>Enter your email & password to login</p>

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label class="col-form-label">Email Address</label>
                                        <input class="form-control email" name="email" type="email"
                                            placeholder="Test@gmail.com" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label">Password</label>
                                        <input class="form-control" type="password" name="password" required
                                            placeholder="*********">
                                        <div class="show-hide"><span class="show"></span></div>
                                    </div>


                                    <div class="form-group mb-0">
                                        <div class="checkbox p-0">
                                            <input id="checkbox1" name="remember" type="checkbox">
                                            <label class="text-muted" for="checkbox1">Remember password</label>
                                        </div>
                                        <button class="btn btn-primary btn-block" type="submit">Sign in</button>
                                    </div>
                                </form>

                                <h6 class="text-muted mt-4 or">Or Sign in with</h6>
                                <div class="social mt-4">
                                    <div class="btn-showcase"><a class="btn btn-light" href="https://www.linkedin.com/login"
                                            target="_blank"><i class="txt-linkedin" data-feather="linkedin"></i> LinkedIn
                                        </a><a class="btn btn-light" href="https://twitter.com/login?lang=en"
                                            target="_blank"><i class="txt-twitter" data-feather="twitter"></i>twitter</a><a
                                            class="btn btn-light" href="https://www.facebook.com/" target="_blank"><i
                                                class="txt-fb" data-feather="facebook"></i>facebook</a></div>
                                </div>
                                <p class="mt-4 mb-0">Don't have account?<a class="ms-2"
                                        href="{{ route('register.form') }}">Create Account</a></p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>

    @if (session('success'))
        <script>
            swal("Success!", "{{ session('success') }}", "success");
        </script>
    @endif

    @if ($errors->any())
        <script>
            swal("Error!", "{{ $errors->first() }}", "error");
        </script>
    @endif

    <script>
        $(document).on('click', '#error', function(e) {
            if ($('.email').val() == '' || $('.pwd').val() == '') {
                swal(
                    "Error!", "Sorry, looks like some data are not filled, please try again !", "error"
                )
            }
        });
    </script>

    <script>
        document.querySelectorAll('.show-hide').forEach(function(wrapper) {
            const input = wrapper.previousElementSibling;
            const toggle = wrapper.querySelector('span');

            toggle.addEventListener('click', function() {
                if (input.type === "password") {
                    input.type = "text";
                    toggle.classList.remove("show");
                } else {
                    input.type = "password";
                    toggle.classList.add("show");
                }
            });
        });
    </script>
@endsection
