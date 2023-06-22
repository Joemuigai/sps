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
            <li class="breadcrumb-item active">System Users</li>
        </ol>

        <h1 class="page-header text-uppercase">
            System Users
        </h1>

        {{-- <div class="mb-3 d-md-flex fw-bold">
            <div class="mt-md-0 mt-2">
                @if ($system_locked)
                    <button data-bs-toggle="modal" data-bs-target="#deactivateModal" title="Unlock System Access"
                        class="text-dark btn btn-md btn-outline-success text-decoration-none"><i
                            class="fa fa-key fa-fw me-1 text-dark text-opacity-100"></i> Unlock System Access</button>
                @else
                    <button data-bs-toggle="modal" data-bs-target="#activateModal" title="Lock System Access"
                        class="text-dark btn btn-md btn-outline-danger text-decoration-none"><i
                            class="fa fa-key fa-fw me-1 text-dark text-opacity-100"></i> Lock System Access</button>
                @endif

            </div>

        </div> --}}



        {{-- <div class="modal fade" id="activateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><i class="fa fa-key"></i> Lock System Access</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger">
                            <h5><i class="fa fa-exclamation-triangle"></i> Action Notice </h5>
                            <p class="message"> This action will lock the system access by all users except the
                                Administrator.
                                <hr> Proceed to lock system access?
                            </p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-md btn-outline-primary" title="Cancel"
                            data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Cancel</button>
                        <form action="{{ route('admin.lockSystem') }}" class="activate-form" method="POST"
                            style="display: inline-block;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-md btn-outline-danger" title="Lock System Access"><i
                                    class="fa fa-key"></i> Lock System Access</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deactivateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"><i class="fa fa-key"></i> Unlock System Access</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-success">
                            <h5><i class="fa fa-exclamation-triangle"></i> Action Notice </h5>
                            <p class="message"> This action will restore the system access for all users.
                                <hr> Proceed to unlock system access?
                            </p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-md btn-outline-primary" title="Cancel"
                            data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Cancel</button>
                        <form action="{{ route('admin.unlockSystem') }}" class="activate-form" method="POST"
                            style="display: inline-block;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-md btn-outline-success" title="Lock System Access"><i
                                    class="fa fa-key"></i> Unlock System Access</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}



        <div class="row mt-3">
            <div class="col-xl-3 col-md-6">
                <div class="widget widget-stats">
                    <div class="stats-content">
                        <div class="stats-title">Registered Users</div>
                        <div class="stats-number">
                            {{ $totalUsers }}
                            {{-- <span class="increase"><i class="fa fa-caret-up"></i> 31.55%</span> --}}
                        </div>
                        <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                        <div class="stats-desc">Total registered users</div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="widget widget-stats">
                    <div class="stats-content">
                        <div class="stats-title">Active Users</div>
                        <div class="stats-number">
                            {{ $totalActiveUsers }}
                            {{-- <span class="increase"><i class="fa fa-caret-up"></i> 31.55%</span> --}}
                        </div>
                        <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                        <div class="stats-desc">Total active users</div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="widget widget-stats">
                    <div class="stats-content">
                        <div class="stats-title">Inactive Users</div>
                        <div class="stats-number">
                            {{ $totalInactiveUsers }}
                            {{-- <span class="increase"><i class="fa fa-caret-up"></i> 31.55%</span> --}}
                        </div>
                        <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                        <div class="stats-desc">Total inactive users</div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="widget widget-stats">
                    <div class="stats-content">
                        <div class="stats-title">Suspended Users</div>
                        <div class="stats-number">
                            {{ $totalSuspendedUsers }}
                            {{-- <span class="increase"><i class="fa fa-caret-up"></i> 31.55%</span> --}}
                        </div>
                        <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                        <div class="stats-desc">Total suspended users</div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.portal.alerts_block')

        <div class="panel">

            <div class="panel-heading bg-blue-700 text-white">
                <h4 class="panel-title"><i class="fa fa-universal-access"></i> System Users</h4>
                <div class="panel-heading-btn">

                    <a href="{{ route('admin.createSystemUser') }}"
                        class="btn btn-outline-warning text-white btn-rounded px-4 rounded-pill"><i
                            class="fa fa-plus fa-lg me-2 ms-n2 text-white"></i> Add System User</a>

                    {{-- <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i
                            class="fa fa-redo"></i></a> --}}


                </div>
            </div>


            <div class="panel-body">
                <table id="data-table-default" class="table table-striped table-bordered align-middle">
                    <thead>
                        <tr>
                            {{-- <th width="1%" data-orderable="false"></th> --}}
                            <th class="text-nowrap">Username</th>
                            <th class="text-nowrap">Full Name</th>
                            <th class="text-nowrap">Position</th>
                            <th class="text-nowrap">Email</th>
                            <th class="text-nowrap">Mobile</th>
                            <th class="text-nowrap">Status</th>
                            <th class="text-nowrap">Date Joined</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($system_users as $user)
                            <tr class="odd gradeX">

                                <td><a
                                        href="{{ route('admin.viewuser', $user->id) }}">{{ $user->username }}</a>
                                </td>
                                <td>{{ $user->first_name . ' ' . $user->last_name }}
                                </td>
                                <td>{{ $user->getRoleNames()->first()}}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->mobile }}</td>
                                <td>
                                    <?php if ($user->status == 'activated') : ?>
                                    <span
                                        class="badge border border-success text-success px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i
                                            class="fa fa-circle fs-9px fa-fw me-5px"></i> Active</span>
                                    <?php endif ?>
                                    <?php if ($user->status == 'inactive') : ?>
                                    <span
                                        class="badge border border-warning text-warning px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i
                                            class="fa fa-circle fs-9px fa-fw me-5px"></i> Deactivated</span>
                                    <?php endif ?>
                                    <?php if ($user->status == 'suspended') : ?>
                                    <span
                                        class="badge border border-danger text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i
                                            class="fa fa-circle fs-9px fa-fw me-5px"></i> Suspended</span>
                                    <?php endif ?>
                                    <?php if ($user->status == 'locked') : ?>
                                    <span
                                        class="badge border border-primary text-primary px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i
                                            class="fa fa-circle fs-9px fa-fw me-5px"></i> System Locked</span>
                                    <?php endif ?>

                                </td>
                                <td>{{ date('d, M Y', strtotime($user->created_at)) }}</td>

                            </tr>
                        @endforeach




                    </tbody>
                </table>
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

                if ($('#data-table-default').length !== 0) {
                    $('#data-table-default').DataTable({
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
