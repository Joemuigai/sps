@extends('layouts.portal.index')

@section('css_scripts')
    <link href="{{ asset('assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
        rel="stylesheet" />
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

        .user-details {
            background-color: #f9f9f9;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .user-detail {
            margin-bottom: 10px;
        }

        .detail-label {
            font-weight: bold;
            color: #555;
        }

        .detail-value {
            color: #333;
        }
    </style>
@endsection

@section('content')
    <div id="content" class="app-content">

        <ol class="breadcrumb float-xl-end" style="--bs-breadcrumb-divider: '::';" aria-label="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('member.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Member Profile</li>
        </ol>

        <h1 class="page-header">
            Member Profile
        </h1>

        @include('layouts.portal.alerts_block')

        <div class="mb-3 d-md-flex justify-content-md-end justify-content-sm-between">
            <div class="mt-md-0 mt-2">
                <a href="{{ route('member.editProfile') }}"
                    class="btn btn-sm btn-success text-white btn-rounded px-4 rounded-pill"><i
                        class="fa fa-plus fa-lg me-2 ms-n2 text-white"></i> Update Profile</a>
            </div>
        </div>


        <div class="row mt-1">
            <div class="col-md-12">

                <div class="panel">



                    <div class="panel-heading text-white">
                        <h4 class="panel-title"><i class="fa fa-user-shield"></i> Member Profile -
                            {{ $student->first_name . ' ' . $student->last_name }}</h4>

                        <a href="javascript:;" class="btn btn-sm btn-icon btn-warning" data-toggle="panel-collapse"><i
                                class="fa fa-minus"></i></a>



                    </div>


                    <div class="panel-body">

                        <div class="row">


                            <div class="col-md-3">



                                <div class="widget-card">

                                    @if ($student->student_photo)
                                        <img id="player-image"
                                            src="{{ asset('storage/' . $student->student_photo->file_path) }}"
                                            class="img-thumbnail" style="height: 360px;" alt="User Image">
                                    @else
                                        <img id="player-image" src="{{ asset('assets/img/user/person.png') }}"
                                            class="img-thumbnail" style="height: 360px;" alt="User Image">
                                    @endif

                                </div>



                            </div>



                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6 mb-1">
                                        <div class="user-details">
                                            <div class="user-detail">
                                                <span class="detail-label">Full Name:</span>
                                                <span
                                                    class="detail-value">{{ $student->first_name . ' ' . $student->middle_name . ' ' . $student->last_name }}</span>
                                            </div>
                                            <hr>
                                            <div class="user-detail">
                                                <span class="detail-label">Student ID:</span>
                                                <span class="detail-value">{{ $student->student_id }}</span>
                                            </div>
                                            <hr>
                                            <div class="user-detail">
                                                <span class="detail-label">Email:</span>
                                                <span class="detail-value">{{ $student->email }}</span>
                                            </div>
                                            <hr>
                                            <div class="user-detail">
                                                <span class="detail-label">Mobile:</span>
                                                <span class="detail-value">{{ $student->mobile }}</span>
                                            </div>
                                            <hr>
                                            <div class="user-detail">
                                                <span class="detail-label">Address:</span>
                                                <span class="detail-value">{{ $student->address }}</span>
                                            </div>
                                            <hr>
                                            <div class="user-detail">
                                                <span class="detail-label">Mode of Study:</span>
                                                <span class="detail-value">{{ $student->mode_of_study }}</span>
                                            </div>
                                            <hr>
                                            <div class="user-detail">
                                                <span class="detail-label">National ID:</span>
                                                <span class="detail-value">{{ $student->national_id }}</span>
                                            </div>
                                            <hr>

                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-1">
                                        <div class="user-details">

                                            <div class="user-detail">
                                                <span class="detail-label">Passport No.:</span>
                                                <span class="detail-value">{{ $student->passport_no }}</span>
                                            </div>
                                            <hr>
                                            <div class="user-detail">
                                                <span class="detail-label">Student ID Expiry Date:</span>
                                                <span
                                                    class="detail-value">{{ date('d, M Y', strtotime($student->expiry_date)) }}</span>
                                            </div>
                                            <hr>
                                            <div class="user-detail">
                                                <span class="detail-label">Course Faculty:</span>
                                                <span class="detail-value">{{ $student->course_faculty }}</span>
                                            </div>
                                            <hr>
                                            <div class="user-detail">
                                                <span class="detail-label">Disabled:</span>
                                                <span class="detail-value">{{ $student->disabled }}</span>
                                            </div>
                                            <hr>
                                            <div class="user-detail">
                                                <span class="detail-label">Student ID Copy:</span>
                                                <span class="detail-value">
                                                    @if ($student->student_id_copy)
                                                    <a href="{{ route('member.downloadNationalId', ['document' => $student->student_id_copy->id]) }}"><i class="fa fa-cloud-download"></i> {{ $student->student_id_copy->file_name }}</a>
                                                    @else
                                                        No file uploaded
                                                    @endif
                                                </span>
                                            </div>
                                            <hr>
                                            <div class="user-detail">
                                                <span class="detail-label">National ID Copy: </span>
                                                <span class="detail-value">
                                                    @if ($student->student_id_copy)
                                                    <a href="{{ route('member.downloadNationalId', ['document' => $student->student_id_copy->id]) }}"><i class="fa fa-cloud-download"></i> {{ $student->student_id_copy->file_name }}</a>
                                                    @else
                                                        No file uploaded
                                                    @endif
                                                </span>
                                            </div>
                                            <hr>
                                            <div class="user-detail">
                                                <span class="detail-label">Account Status:</span>
                                                <?php if ($student->status == 'approved') : ?>
                                                <span
                                                    class="text-success px-2 pt-5px rounded fs-12px d-inline-flex align-items-center"><i
                                                        class="fa fa-circle fs-9px fa-fw me-5px"></i> Approved</span>
                                                <?php endif ?>
                                                <?php if ($student->status == 'pending') : ?>
                                                <span
                                                    class="text-primary px-2 pt-5px rounded fs-12px d-inline-flex align-items-center"><i
                                                        class="fa fa-circle fs-9px fa-fw me-5px"></i> Pending</span>
                                                <?php endif ?>
                                                <?php if ($student->status == 'declined') : ?>
                                                <span
                                                    class="text-danger px-2 pt-5px rounded fs-12px d-inline-flex align-items-center"><i
                                                        class="fa fa-circle fs-9px fa-fw me-5px"></i> Declined</span>
                                                <?php endif ?>

                                            </div>
                                            <hr>

                                        </div>
                                    </div>

                                </div>
                            </div>




                        </div>


                    </div>


                </div>

            </div>
        </div>
    @endsection


    @section('js_scripts')
        <script src="{{ asset('assets/plugins/datatables.net/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>

        <script src="{{ asset('assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}" type="text/javascript">
        </script>

        <script src="{{ asset('assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}"
            type="text/javascript"></script>

        <script src="{{ asset('assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"
            type="text/javascript"></script>

        <script>
            var handleDataTableDefault = function() {
                "use strict";

                if ($('#training-attendance-table').length !== 0) {
                    $('#training-attendance-table').DataTable({
                        responsive: true
                    });
                }
            };

            var TableManageDefault = function() {
                "use strict";
                return {
                    //main function
                    init: function() {
                        handleDataTableDefault();
                    }
                };
            }();

            $(document).ready(function() {
                TableManageDefault.init();
            });
        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
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
    @endsection
