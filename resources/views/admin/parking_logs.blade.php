@extends('layouts.portal.index')

@section('css_scripts')
    <link href="{{ asset('assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
        rel="stylesheet" />
@endsection

@section('content')
    <div id="content" class="app-content">

        <ol class="breadcrumb float-xl-end" style="--bs-breadcrumb-divider: '::';" aria-label="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Parking Logs</li>
        </ol>

        <h1 class="page-header">
            Parking Logs
        </h1>

        @include('layouts.portal.alerts_block')

        <div class="mb-3 d-md-flex justify-content-md-end justify-content-sm-between">
            <div class="mt-md-0 mt-2">
                <a href="{{ route('member.cars') }}" target="_blank"
                    class="text-dark btn btn-md btn-outline-primary text-decoration-none">
                    <i class="fa fa-download fa-fw me-1 text-dark text-opacity-100"></i> Export List as PDF
                </a>
            </div>
        </div>

        <div class="row">

            <div class="col-md-12">

                <div class="panel mt-4">

                    <div class="panel-heading text-white">
                        <h4 class="panel-title"><i class="fa fa-fax"></i> Parking Logs</h4>
                        <div class="panel-heading-btn">

                            {{-- <a href="" data-bs-toggle="modal" data-bs-target="#createModal" class="btn btn-outline-warning text-white btn-rounded px-4 rounded-pill"><i
                                    class="fa fa-plus fa-lg me-2 ms-n2 text-white"></i> Add Team Position
                            </a> --}}

                            {{-- <a href="javascript:;" class="btn btn-xs btn-icon btn-success" id="refresh-button" data-toggle="panel-reload"><i
                                    class="fa fa-redo"></i>
                            </a> --}}

                        </div>
                    </div>


                    <div class="panel-body">

                        <table id="team-position-table" class="table table-striped table-bordered align-middle">
                            <thead>
                                <tr>
                                    {{-- <th width="1%" data-orderable="false"></th> --}}
                                    <th class="text-nowrap">Car Reg. No.</th>
                                    <th class="text-nowrap">Entry Time</th>
                                    <th class="text-nowrap">Exit Time</th>
                                    <th class="text-nowrap">Parking Space No.</th>

                                </tr>
                            </thead>
                            <tbody>

                                {{-- @foreach ($positions as $position)
                                    <tr class="odd gradeX">
                                        <td>{{ $position->position_name }}</td>
                                        <td>{{ $position->position_abbreviation }}</td>
                                        <td>{{ $position->position_description }}</td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-outline-primary text-warning"
                                                data-bs-toggle="modal" data-bs-target="#editModal" title="Edit"
                                                data-position-id="{{ $position->id }}"><i class="fa fa-pen"></i></a>

                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal" title="Delete"
                                                data-position-id="{{ $position->id }}"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach --}}


                            </tbody>
                        </table>
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

                if ($('#team-position-table').length !== 0) {
                    $('#team-position-table').DataTable({
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
    @endsection
