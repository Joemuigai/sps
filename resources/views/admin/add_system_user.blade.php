@extends('layouts.portal.index')

@section('css_scripts')

@endsection

@section('content')
    <div id="content" class="app-content">

        <ol class="breadcrumb float-xl-end" style="--bs-breadcrumb-divider: '::';" aria-label="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.systemUsers') }}">System Users</a></li>
            <li class="breadcrumb-item active">Add System User</li>
        </ol>

        <h1 class="page-header text-uppercase">
            Add System User
        </h1>

        <div class="panel mt-5">

            <div class="panel-heading text-white">
                <h4 class="panel-title"><i class="fa fa-universal-access"></i> Add System User</h4>

            </div>


            <div class="panel-body">

                <form id='user-form' method="POST" action="{{ route('add.systemUser') }}">

                    @csrf

                    <div class="row mb-15px">
                        <div class="col-sm-4">
                            <label class="form-label col-form-label" for="first_name">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg mb-5px @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="Enter First Name" autocomplete="off" />
                            @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-sm-4">
                            <label class="form-label col-form-label" for="last_name">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg mb-5px @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name') }}" placeholder="Enter Last Name" autocomplete="off" />
                            @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-sm-4">
                            <label class="form-label col-form-label" for="email">Email Address <span class="text-danger">*</span></label>
                            <input type="email" class="form-control form-control-lg mb-5px @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Enter Email Address" autocomplete="off" />
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-sm-4">
                            <label class="form-label col-form-label" for="mobile">Phone Number <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-control-lg mb-5px  @error('mobile') is-invalid @enderror"" id="mobile" name="mobile" value="{{ old('mobile') }}" placeholder="Enter Phone Number" autocomplete="off" />
                            @error('mobile')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-sm-4">
                            <label class="form-label col-form-label" for="mobile">SU Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-lg mb-5px @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" placeholder="Enter SU Username" autocomplete="off" />
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-sm-4">
                            <label class="form-label col-form-label" for="position">Position <span class="text-danger">*</span></label>
                            <select class="form-select form-select-lg mb-5px @error('role') is-invalid @enderror"
                                    name="role" id="role">
                                <option value="">--- Select User Position ---</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}"
                                        {{ old('role') == $role->name ? 'selected' : '' }}>
                                        {{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- <div class="col-sm-4">
                            <label class="form-label col-form-label" for="nationalId">Gender</label>
                            <div class="col-md-12 pt-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="male" name="gender" value="male" checked />
                                    <label class="form-check-label" for="male">Male</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="female" name="gender" value="female" />
                                    <label class="form-check-label" for="female">Female</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="others" name="gender" value="others" />
                                    <label class="form-check-label" for="others">Others</label>
                                  </div>
                            </div>
                        </div> --}}

                    </div>




                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <button type="submit" class="btn btn-success waves-effect waves-light"><i class="fas fa-plus-circle"></i> Add System User</button>
                        <button type="button" class="btn btn-danger waves-effect waves-light" onclick="document.getElementById('user-form').reset();"> <i class="fas fa-times-circle"></i> Cancel</button>
                    </div>

                </form>


            </div>


        </div>


@endsection

@section('js_scripts')

@endsection
