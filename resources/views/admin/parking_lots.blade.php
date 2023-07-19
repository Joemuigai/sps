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
            <li class="breadcrumb-item active">Parking Lots</li>
        </ol>

        <h1 class="page-header text-uppercase">
            Parking Lots
        </h1>

        @include('layouts.portal.alerts_block')

        <div class="row">
            <div class="col-md-4">
                <div class="panel mt-4">
                    <div class="panel-heading text-white">
                        <h4 class="panel-title"><i class="fa fa-cubes-stacked"></i> Add Parking Lot</h4>
                        <div class="panel-heading-btn"></div>
                    </div>
                    <div class="panel-body">
                        <form id="parking-lot-form" method="POST" action="{{ route('admin.addParkingLot') }}">
                            @csrf
                            <div class="row mb-15px">
                                <div class="col-sm-12">
                                    <label class="form-label col-form-label" for="tag">Parking Lot Tag<span
                                            class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control form-control-lg mb-5px @error('tag') is-invalid @enderror"
                                        id="tag" name="tag" value="{{ old('tag') }}"
                                        placeholder="Enter Parking Lot Tag" required />
                                    @error('tag')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <button type="submit" class="btn btn-success waves-effect waves-light"><i
                                        class="fas fa-plus-circle"></i> Create Parking Lot</button>
                                <button type="button" class="btn btn-danger waves-effect waves-light"
                                    onclick="document.getElementById('parking-lot-form').reset();"> <i
                                        class="fas fa-times-circle"></i> Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel mt-4">
                    <div class="panel-heading text-white">
                        <h4 class="panel-title"><i class="fa fa-cubes-stacked"></i> Parking Lots</h4>
                        <div class="panel-heading-btn"></div>
                    </div>
                    <div class="panel-body">
                        <table id="parking-lot-table" class="table table-striped table-bordered align-middle">
                            <thead>
                                <tr>
                                    <th class="text-nowrap">Parking Lot Tag</th>
                                    <th class="text-nowrap">Status</th>
                                    <th class="text-nowrap">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($parkingLots as $parkingLot)
                                    <tr class="odd gradeX">
                                        <td>{{ $parkingLot->tag }}</td>
                                        <td>
                                            <?php if ($parkingLot->status == 'available') : ?>
                                            <span
                                                class="badge border border-success text-success px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i
                                                    class="fa fa-circle fs-9px fa-fw me-5px"></i> Available</span>
                                            <?php endif ?>
                                            <?php if ($parkingLot->status == 'occupied') : ?>
                                            <span
                                                class="badge border border-primary text-primary px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i
                                                    class="fa fa-circle fs-9px fa-fw me-5px"></i> Occupied</span>
                                            <?php endif ?>
                                            <?php if ($parkingLot->status == 'under maintenance') : ?>
                                            <span
                                                class="badge border border-danger text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i
                                                    class="fa fa-circle fs-9px fa-fw me-5px"></i> Maintenance</span>
                                            <?php endif ?>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-outline-primary text-warning"
                                                data-bs-toggle="modal" data-bs-target="#editModal" title="Edit"
                                                data-parking-lot-id="{{ $parkingLot->id }}"><i class="fa fa-pen"></i></a>
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal" title="Delete"
                                                data-parking-lot-id="{{ $parkingLot->id }}"><i
                                                    class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="edit-parking-lot-form" method="POST" action="">
                            @csrf
                            @method('PATCH')
                            <div class="row mb-15px">
                                <div class="row mb-15">
                                    <div class="col-sm-12">
                                        <label class="form-label col-form-label" for="tag">Parking Lot Tag</label>
                                        <input type="text"
                                            class="form-control form-control-lg mb-5px @error('tag') is-invalid @enderror"
                                            id="tag" name="tag" value="{{ old('tag') }}"
                                            placeholder="Parking Lot Tag" autocomplete="off" autofocus="on" required />
                                        @error('tag')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12">
                                        <label class="form-label col-form-label" for="status">Parking Lot Status <span
                                                class="text-danger">*</span></label>
                                        <select
                                            class="form-select form-select-lg mb-5px @error('status') is-invalid @enderror"
                                            name="status" id="status">
                                            <option value="">--- Select Parking Lot Status ---</option>
                                            <option value="available"
                                                >Available
                                            </option>
                                            <option value="occupied"
                                                >Occupied
                                            </option>
                                            <option value="under maintenance"
                                                >Under
                                                Maintenance</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <button type="submit" class="btn btn-success waves-effect waves-light"><i
                                        class="fas fa-plus-circle"></i> Update Parking Lot</button>
                                <button type="button" class="btn btn-md btn-outline-primary" title="Cancel"
                                    data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger">
                            <h5><i class="fa fa-exclamation-triangle"></i> This action is irreversible</h5>
                            <p class="message"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-md btn-outline-primary" title="Cancel"
                            data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Cancel</button>
                        <form action="" class="delete-form" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-md btn-outline-danger" title="Delete"><i
                                    class="fa fa-trash"></i> Delete</button>
                        </form>
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
            if ($('#parking-lot-table').length !== 0) {
                $('#parking-lot-table').DataTable({
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

    <script>
        $('#editModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var parkingLotId = button.data('parking-lot-id'); // Extract info from data-* attributes
            var modal = $(this);

            // Make an AJAX request to get the parking lot details
            $.get('parking_lots/' + parkingLotId, function(data) {
                modal.find('.modal-title').text('Edit Parking Lot: ' + data.tag);
                modal.find('#tag').val(data.tag);
                modal.find('#status').val(data.status); // Update the parking lot status field
            });


            modal.find('#edit-parking-lot-form').attr('action', '/admin/parking_lots/update/' + parkingLotId);
        });
    </script>

    <script>
        $('#deleteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var parkingLotId = button.data('parking-lot-id'); // Extract info from data-* attributes
            var modal = $(this);

            // Make an AJAX request to get the parking lot details
            $.get('parking_lots/' + parkingLotId, function(data) {
                modal.find('.modal-title').text('Delete Parking Lot: ' + data.tag);
                modal.find('.message').html('Are you sure you want to delete the parking lot with tag ' +
                    data.tag + '?');
            });

            modal.find('.delete-form').attr('action', '/admin/parking_lots/remove/' + parkingLotId);
        });
    </script>
@endsection
