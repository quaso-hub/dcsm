@extends('auth.layouts.master')
@section('title', 'Sign-up')

@section('css')
@endsection

@section('style')
@endsection


@section('content')
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card">
                    <div>
                        <div>
                            <a class="logo text-start"  href="{{ route('register.form') }}"
                            class="text-decoration-none sidebar-logo animated-logo">

                            <i class="bi bi-shop fs-4 text-danger logo-icon"></i>

                            <span class="fw-bold fs-5 text-dark for-light m-0">AJOFOOD</span>

                            <span class="fw-bold fs-5 text-light for-dark m-0">AJOFOOD</span>
                        </a>
                        </div>

                        <div class="login-main">
                            <form class="theme-form" method="POST" action="{{ route('register') }}">
                                @csrf

                                <h4>Create your account</h4>
                                <p>Enter your personal details to create account</p>

                                <div class="form-group">
                                    <label class="col-form-label pt-0">Your Name</label>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <input class="form-control" type="text" name="first_name" required
                                                placeholder="First name">
                                        </div>
                                        <div class="col-6">
                                            <input class="form-control" type="text" name="last_name" required
                                                placeholder="Last name">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Email Address</label>
                                    <input class="form-control" type="email" name="email" required
                                        placeholder="Test@gmail.com">
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <input class="form-control" type="password" name="password" required placeholder="*********">
                                    <div class="show-hide"><span class="show"></span></div>
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Confirm Password</label>
                                    <input class="form-control" type="password" name="password_confirmation" required placeholder="*********">
                                    <div class="show-hide"><span class="show"></span></div>
                                </div>

                                <div class="form-group mb-0">
                                    <div class="checkbox p-0">
                                        <input id="checkbox1" name="agree" type="checkbox" required>
                                        <label class="text-muted" for="checkbox1">Agree with <a class="ms-2"
                                                href="#">Privacy Policy</a></label>
                                    </div>
                                    <button class="btn btn-primary btn-block" type="submit">Create Account</button>
                                </div>

                                <h6 class="text-muted mt-4 or">Or signup with</h6>

                                <div class="social mt-4">
                                    <div class="btn-showcase"><a class="btn btn-light" href="https://www.linkedin.com/login"
                                            target="_blank"><i class="txt-linkedin" data-feather="linkedin"></i> LinkedIn
                                        </a><a class="btn btn-light" href="https://twitter.com/login?lang=en"
                                            target="_blank"><i class="txt-twitter" data-feather="twitter"></i>twitter</a><a
                                            class="btn btn-light" href="https://www.facebook.com/" target="_blank"><i
                                                class="txt-fb" data-feather="facebook"></i>facebook</a></div>
                                </div>
                                <p class="mt-4 mb-0">Already have an account?<a class="ms-2"
                                        href="{{ route('login.form') }}">Sign in</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>

    @if ($errors->any())
        <script>
            swal("Error!", "{{ $errors->first() }}", "error");
        </script>
    @endif

    <script>
        document.querySelectorAll('.show-hide').forEach(function(wrapper) {
            const input = wrapper.previousElementSibling;
            const toggle = wrapper.querySelector('span');

            toggle.addEventListener('click', function () {
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
