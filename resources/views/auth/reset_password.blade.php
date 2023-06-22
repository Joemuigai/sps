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
                <form action="{{ route('password.change') }}" method="POST" class="fs-13px">

                    @include('layouts.portal.alerts_block')

                    @csrf

                    <input type="hidden" class="form-control h-45px fs-13px @error('token') is-invalid @enderror" name="token" id="token" value="{{ $token }}" placeholder="Token" />



                    <div class="form-floating mb-15px">
                        <input type="email" class="form-control h-45px fs-13px @error('email') is-invalid @enderror" name="email" id="email" value="{{ $email }}" readonly placeholder="Email" />
                        <label for="email" class="d-flex align-items-center fs-13px text-gray-600">Email</label>
                        @error('email')
                            <div class="invalid-feedback text-bold" style="color: #d0ae5e;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-15px">
                        <input type="password" class="form-control h-45px fs-13px @error('password') is-invalid @enderror" name="password" id="password" value="{{ old('password') }}" placeholder="Password" />
                        <label for="password" class="d-flex align-items-center fs-13px text-gray-600">New Password</label>
                        @error('password')
                            <div class="invalid-feedback text-bold" style="color: #d0ae5e;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-15px">
                        <input type="password" class="form-control h-45px fs-13px @error('password') is-invalid @enderror" name="confirm_password" id="password" value="{{ old('confirm_password') }}" placeholder="Password" />
                        <label for="confirm_password" class="d-flex align-items-center fs-13px text-gray-600">Confirm Password</label>
                        @error('confirm_password')
                            <div class="invalid-feedback text-bold" style="color: #d0ae5e;">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="mb-15px">
                        <button type="submit" style="background-color: #12089b;" class="btn d-block h-45px w-100 btn-lg fs-14px text-white">Reset Password <i class="fa fa-sign-in-alt"></i> </button>
                    </div>
                    <div class="mb-10px pb-40px text-white">
                        {{-- Forgot password ? Click <a href="{{ route('account.forgotPassword')}}" style="color: #d0ae5e;">here</a> to
                        reset. --}}
                    </div>
                    <hr class="text-white" />
                    <div class="text-white text-center  mb-0">
                        &copy; Smart Parking System <?= date('Y') ?>
                    </div>
                </form>
            </div>

        </div>

    </div>
@endsection

@section('js_scripts')
@endsection
