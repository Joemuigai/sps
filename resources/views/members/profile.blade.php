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
                <a href="{{ route('member.editProfile')}}"
                    class="btn btn-sm btn-success text-white btn-rounded px-4 rounded-pill"><i
                        class="fa fa-plus fa-lg me-2 ms-n2 text-white"></i> Update Profile</a>
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
