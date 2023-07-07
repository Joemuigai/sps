@extends('layouts.auth.index')

@section('css_scripts')
@endsection

@section('content')
    <div class="login login-v2 fw-bold">

        <div class="login-cover">
            <div class="login-cover-img" style="background-image: url({{ asset('assets/img/login-bg/login-bg-17.jpg') }})"
                data-id="login-cover-image"></div>
            <div class="login-cover-bg"></div>
        </div>


        <div class="login-container">

            <div class="login-header mb-30px">
                <div class="brand">
                    <div class="d-flex align-items-center navbar-brand">
                        <img src="{{ asset('assets/img/logo/studentaffairslogo.png') }}" height="95px" alt="Strath Logo" />
                    </div>
                    {{-- <small class="text-white">SMART PARKING SYSTEM</small> --}}
                </div>

            </div>


            <div class="login-content">
                <form action="{{ route('login.user') }}" method="POST" class="fs-13px">

                    @include('layouts.portal.alerts_block')

                    @csrf

                    <div class="input-group mb-15px">
                        <input type="text" class="form-control h-45px fs-13px @error('username') is-invalid @enderror"
                            name="username" id="username" value="{{ old('username') }}" placeholder="Username" />

                        <span class="input-group-text">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>

                        @error('username')
                            <div class="invalid-feedback text-bold" style="color: #fff;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="input-group mb-15px">
                                <input type="password"
                                    class="form-control h-45px fs-13px @error('password') is-invalid @enderror"
                                    name="password" id="password" value="{{ old('password') }}" placeholder="Password" />

                                <span class="input-group-text password-toggle mr-3" onclick="togglePasswordVisibility()">
                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                </span>
                                <span class="input-group-text border-primary text-white" style="background-color: #12089b"
                                    data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="right"
                                    title="Password Guidelines <hr><li>Must be 8 characters long</li><li>Must contain lowercase and uppercase</li><li>Must have atleast a number</li>">
                                    <i class="fa fa-question" aria-hidden="true"></i>
                                </span>
                                @error('password')
                                    <div class="invalid-feedback text-bold" style="color: #fff;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>



                    <div class="form-check mb-30px">
                        <div class="row">
                            <div class="col-6">
                                <input class="form-check-input" type="checkbox" value="1" name="remember"
                                    id="remember" />
                                <label class="form-check-label text-white" for="remember">
                                    Remember Me
                                </label>
                            </div>
                            <div class="col-6 text-end">
                                <label class="form-check-label text-white" for="remember">
                                    <i class="fa fa-lock"></i> <a href="{{ route('account.forgotPassword') }}"
                                        style="color: #fff;">Forgot Password</a>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-15px">
                        <button type="submit" style="background-color: #12089b;"
                            class="btn d-block h-45px w-100 btn-lg fs-14px text-white">Sign me
                            in <i class="fa fa-sign-in-alt"></i> </button>
                    </div>
                    <div class="mb-10px pb-40px text-white">
                        Don't have an account ? Click <a href="{{ route('account.register') }}"
                            style="color: #fff;">here</a> to
                        register.
                    </div>
                    <hr class="text-white" />
                    <div class="text-white text-center  mb-0">
                        &copy; Smart Parking System <?= date('Y') ?> -
                    </div>
                </form>
            </div>

        </div>

    </div>
@endsection

@section('js_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var eyeIcon = document.querySelector(".password-toggle i");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            }
        }
    </script>

    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
@endsection
