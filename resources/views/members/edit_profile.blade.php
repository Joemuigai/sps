@extends('layouts.portal.index')

@section('css_scripts')
    <style>
        /* File Upload */
        .fake-shadow {
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }

        .fileUpload {
            position: relative;
            overflow: hidden;
        }

        .fileUpload #photo-id {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            padding: 0;
            font-size: 33px;
            cursor: pointer;
            opacity: 0;
            filter: alpha(opacity=0);
        }

        .img-preview {
            max-width: 100%;
        }
    </style>
@endsection

@section('content')
    <div id="content" class="app-content">

        <ol class="breadcrumb float-xl-end" style="--bs-breadcrumb-divider: '::';" aria-label="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('member.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('member.profile') }}">Member Profile</a></li>
            <li class="breadcrumb-item active">Update Profile</li>
        </ol>

        <h1 class="page-header">
            Update Profile
        </h1>

        @include('layouts.portal.alerts_block')

        <div class="panel mt-5">

            <div class="panel-heading text-white">
                <h4 class="panel-title"><i class="fa fa-user-shield"></i> Update Profile ::
                    {{ $student->first_name . ' ' . $student->last_name }} </h4>

            </div>


            <div class="panel-body">

                <form id='team-head-form' method="POST" action="{{ route('member.updateProfile', ['member' => $student->id]) }}" enctype="multipart/form-data">

                    @csrf

                    @method('PATCH')

                    <small class="mb-3 text-uppercase" style="font-weight: bold;"> <i class="fa fa-user-shield"></i>
                        Personal Information</small>
                    <hr>

                    <div class="row mb-15px">

                        <div class="col-md-3">

                            <div class="col-md-12">
                                <label class="form-label col-form-label" for="passport_photo">Passport Photo <span
                                    class="text-danger">*</span></label>
                                <div class="input-group @error('passport_photo') is-invalid @enderror">

                                    @if ($student->student_photo)
                                        <img id="player-image" src="{{ asset('storage/' . $student->student_photo->file_path) }}" class="img-thumbnail" style="height: 300px;" alt="User Image">
                                    @else
                                        <img id="player-image" src="{{ asset('assets/img/user/person.png') }}" class="img-thumbnail" style="height: 300px;" alt="User Image">
                                    @endif
                                </div>
                                @error('passport_photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="input-group mt-3">
                                    <div class="input-group-btn">
                                        <div class="fileUpload btn btn-default fake-shadow">
                                            <span><i class="fa fa-upload"></i> Upload Passport photo</span>
                                            <input id="photo-id" name="passport_photo" type="file"
                                                onchange="handlePhotoUpload(event)">
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="col-md-9">

                            <div class="row">

                                <div class="col-sm-4">
                                    <label class="form-label col-form-label" for="student_id">Student ID <span
                                            class="text-danger">*</span></label>
                                    <input type="number"
                                        class="form-control form-control-lg mb-5px @error('student_id') is-invalid @enderror"
                                        id="student_id" name="student_id" value="{{ $student->student_id }}"
                                        placeholder="Enter SU Student ID" />
                                    @error('student_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <label class="form-label col-form-label" for="expiry_date">ID Expiry Date <span
                                            class="text-danger">*</span></label>
                                    <input type="date"
                                        class="form-control form-control-lg mb-5px @error('expiry_date') is-invalid @enderror"
                                        id="expiry_date" name="expiry_date" value="{{ $student->expiry_date }}"
                                        placeholder="Enter ID Expiry Date" autocomplete="off" />
                                    @error('expiry_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <label class="form-label col-form-label" for="national_id">National ID </label>
                                    <input type="number"
                                        class="form-control form-control-lg mb-5px @error('national_id') is-invalid @enderror"
                                        id="national_id" name="national_id" value="{{ $student->national_id }}"
                                        placeholder="Enter National ID" />
                                    @error('national_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <label class="form-label col-form-label" for="passport_number">Passport No. </label>
                                    <input type="text"
                                        class="form-control form-control-lg mb-5px @error('passport_number') is-invalid @enderror"
                                        id="passport_number" name="passport_number" value="{{ $student->passport_no }}"
                                        placeholder="Enter Passport No." />
                                    @error('passport_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <label class="form-label col-form-label" for="first_name">First Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control form-control-lg mb-5px @error('first_name') is-invalid @enderror"
                                        id="first_name" name="first_name" value="{{ $student->first_name }}"
                                        placeholder="Enter First Name" />
                                    @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <label class="form-label col-form-label" for="middle_name">Middle Name </label>
                                    <input type="text"
                                        class="form-control form-control-lg mb-5px @error('middle_name') is-invalid @enderror"
                                        id="middle_name" name="middle_name" value="{{  $student->middle_name }}"
                                        placeholder="Enter Middle Name" />
                                    @error('middle_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <label class="form-label col-form-label" for="last_name">Last Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control form-control-lg mb-5px @error('last_name') is-invalid @enderror"
                                        id="last_name" name="last_name" value="{{ $student->last_name }}"
                                        placeholder="Enter Last Name" />
                                    @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <label class="form-label col-form-label" for="email">Email Address <span
                                            class="text-danger">*</span></label>
                                    <input type="email"
                                        class="form-control form-control-lg mb-5px @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ $student->email }}" readonly
                                        placeholder="Enter Email Address" />
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <label class="form-label col-form-label" for="disabled">Disabled <span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-12 pt-2 mb-5px">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="no"
                                                name="disabled" value="No" {{ $student->disabled == 'No' ? 'checked' : '' }} />
                                            <label class="form-check-label" for="no">No</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="yes"
                                                name="disabled" value="Yes" {{ $student->disabled == 'Yes' ? 'checked' : '' }} />
                                            <label class="form-check-label" for="yes">Yes</label>
                                        </div>
                                    </div>
                                </div>






                                <div class="col-sm-4">
                                    <label class="form-label col-form-label" for="mobile">Phone Number <span
                                            class="text-danger">*</span></label>
                                    <input type="number"
                                        class="form-control form-control-lg mb-5px @error('mobile') is-invalid @enderror"
                                        id="mobile" name="mobile" value="{{ $student->mobile }}"
                                        placeholder="Enter Phone Number" autocomplete="off" />
                                    @error('mobile')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>



                                <div class="col-sm-4">
                                    <label class="form-label col-form-label" for="address">Address <span
                                            class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control form-control-lg mb-5px @error('address') is-invalid @enderror"
                                        id="address" name="address" value="{{ $student->address }}"
                                        placeholder="Enter Residential Address" />
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <label class="form-label col-form-label" for="course_faculty">Course Department <span
                                            class="text-danger">*</span>
                                    </label>
                                    <select
                                        class="form-select form-select-lg mb-5px @error('course_faculty') is-invalid @enderror"
                                        name="course_faculty" id="course_faculty">
                                        <option value="">--- Select Course Departmemnt ---</option>
                                        <option value="SCES" {{ $student->course_faculty == 'SCES' ? 'selected' : '' }}>School of
                                            Computing and Engineering Sciences</option>
                                        <option value="SIMS" {{ $student->course_faculty == 'SIMS' ? 'selected' : '' }}>
                                            Strathmore Institute of Mathematical Sciences</option>
                                        <option value="SBS" {{ $student->course_faculty == 'SBS' ? 'selected' : '' }}>Strathmore
                                            Business School</option>
                                        <option value="SLS" {{ $student->course_faculty == 'SLS' ? 'selected' : '' }}>Strathmore
                                            Law School</option>
                                        <option value="SI" {{ $student->course_faculty == 'SI' ? 'selected' : '' }}>Strathmore
                                            Institute of Management and Technology</option>
                                        <option value="STH" {{ $student->course_faculty == 'STH' ? 'selected' : '' }}>School of
                                            Tourism and Hospitality</option>
                                        <option value="SHSS" {{ $student->course_faculty == 'SHSS' ? 'selected' : '' }}>School of
                                            Humanities and Social Sciences</option>
                                    </select>
                                    @error('course_faculty')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label col-form-label" for="mode_of_study">Mode of Study <span
                                            class="text-danger">*</span></label>
                                    <div class="col-md-12 pt-2 mb-5px">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="day"
                                                name="mode_of_study" value="Day" {{ $student->mode_of_study == 'Day' ? 'checked' : '' }} />
                                            <label class="form-check-label" for="day">Day {0600Hrs-1700hrs}</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="evening"
                                                name="mode_of_study" value="Evening" {{ $student->mode_of_study == 'Evening' ? 'checked' : '' }} />
                                            <label class="form-check-label" for="evening">Evening
                                                {1700Hrs-2100Hrs}</label>
                                        </div>

                                    </div>
                                </div>



                            </div>

                        </div>

                    </div>

                    <hr>

                    <small class="mb-3 text-uppercase" style="font-weight: bold;"> <i class="fa fa-address-book"></i>
                        Application Documents</small>
                    <hr>

                    <div class="row mb-15px">


                        <div class="col-sm-4">
                            <label class="form-label col-form-label" for="national_id_copy">Copy of National ID / Passport <span
                                    class="text-danger">*</span></label>
                            <input type="file"
                                class="form-control form-control-lg mb-5px @error('national_id_copy') is-invalid @enderror"
                                id="national_id_copy" name="national_id_copy" />

                            @error('national_id_copy')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <span class="text-danger">* (Only scanned pdf file is allowed. Size should be less than
                                5MB)</span>
                        </div>

                        <div class="col-sm-4">
                            <label class="form-label col-form-label" for="student_id_copy">Copy of Student ID <span
                                    class="text-danger">*</span></label>
                            <input type="file"
                                class="form-control form-control-lg mb-5px @error('student_id_copy') is-invalid @enderror"
                                id="student_id_copy" name="student_id_copy" />

                            @error('student_id_copy')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <span class="text-danger">* (Only scanned pdf file is allowed. Size should be less than
                                5MB)</span>
                        </div>






                    </div>









                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <button type="submit" class="btn btn-success waves-effect waves-light"><i
                                class="fas fa-plus-circle"></i> Update Profile Info</button>
                        <button type="button" class="btn btn-danger waves-effect waves-light"
                            onclick="document.getElementById('team-head-form').reset();"> <i
                                class="fas fa-times-circle"></i> Cancel</button>
                    </div>

                </form>


            </div>


        </div>
    @endsection


    @section('js_scripts')
        <script>
            function handlePhotoUpload(event) {
                var file = event.target.files[0];
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#player-image').attr('src', e.target.result);
                }

                reader.readAsDataURL(file);
            }
        </script>

        {{-- <script>
            $(document).ready(function() {
                $('#team_id').on('change', function() {
                    var team_id = $(this).val();
                    if (team_id) {
                        $.ajax({
                            url: "{{ route('admin.getTeamEmail', ':id') }}".replace(':id', team_id),
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                $('#email').val(data.email);
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.log(textStatus, errorThrown);
                            }
                        });
                    } else {
                        $('#email').val('');
                    }
                });
            });
        </script> --}}
    @endsection
