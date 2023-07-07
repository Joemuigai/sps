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
                <form action="{{ route('account.registerUser') }}" method="POST" class="fs-13px">

                    @include('layouts.portal.alerts_block')

                    @csrf

                    <div class="input-group mb-15px">
                        <input type="text" class="form-control h-45px fs-13px @error('username') is-invalid @enderror"
                            name="username" id="username" value="{{ old('username') }}" placeholder="Staff ID / Student ID" />

                        <span class="input-group-text">
                            <i class="fa fa-id-card-clip" aria-hidden="true"></i>
                        </span>

                        @error('username')
                            <div class="invalid-feedback text-bold" style="color: #f80303;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="input-group mb-15px">
                        <input type="text" class="form-control h-45px fs-13px @error('first_name') is-invalid @enderror"
                            name="first_name" id="first_name" value="{{ old('first_name') }}" placeholder="First Name" />

                        <span class="input-group-text">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>

                        @error('first_name')
                            <div class="invalid-feedback text-bold" style="color: #f80303;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="input-group mb-15px">
                        <input type="text" class="form-control h-45px fs-13px @error('last_name') is-invalid @enderror"
                            name="last_name" id="last_name" value="{{ old('last_name') }}" placeholder="Last Name" />

                        <span class="input-group-text">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>

                        @error('last_name')
                            <div class="invalid-feedback text-bold" style="color: #f80303;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="input-group mb-15px">
                        <input type="email" class="form-control h-45px fs-13px @error('email') is-invalid @enderror"
                            name="email" id="email" value="{{ old('email') }}" placeholder="Email" />

                        <span class="input-group-text">
                            <i class="fa fa-at" aria-hidden="true"></i>
                        </span>

                        @error('email')
                            <div class="invalid-feedback text-bold" style="color: #f80303;">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="mb-15px">
                        <button type="submit" style="background-color: #12089b;" class="btn d-block h-45px w-100 btn-lg fs-14px text-white">Sign Up <i class="fa fa-sign-in-alt"></i> </button>
                    </div>
                    <div class="mb-10px pb-40px text-white">
                        Already have an account? Click <a href="{{ route('account.login')}}" style="color: #fff;">here</a> to
                        login.
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
