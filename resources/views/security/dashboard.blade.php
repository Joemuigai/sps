@extends('layouts.portal.index')

@section('css_scripts')
    <style>
        .search-form {
            background-color: #f7f7f7;
            border: 1px solid #e6e6e6;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .search-form input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .search-form button {
            padding: 10px 20px;
            border: none;
            background-color: #4caf50;
            color: white;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .search-form button:hover {
            background-color: #45a049;
        }
    </style>
@endsection

@section('content')
    <div id="content" class="app-content">

        <ol class="breadcrumb float-xl-end" style="--bs-breadcrumb-divider: '::';" aria-label="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('security.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>

        <h1 class="page-header">
            Dashboard
        </h1>

        @include('layouts.portal.alerts_block')

        <div class="row mt-5">
            <div class="col-md-6 offset-md-3">
                <div class="search-form">
                    <form action="{{ route('security.dashboard') }}" method="GET">
                        <input type="text" name="number_plate" placeholder="Enter car number plate number"
                            pattern="[A-Za-z]{3}\s\d{3}[A-Za-z]"
                            title="Please enter the car number plate in the format 'KCD 229J'" required>
                        <hr>
                        <button type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>

        @if (!$carProfile)
            This car is currently not registered.
        @else
            <div class="row">
                <div class="col-md-8 mt-4">
                    <div class="panel">
                        <div class="panel-heading text-white">
                            <h4 class="panel-title"><i class="fa fa-user-shield"></i> Member Profile -
                                {{ $carProfile->first_name . ' ' . $carProfile->last_name }}</h4>
                            <a href="javascript:;" class="btn btn-sm btn-icon btn-warning" data-toggle="panel-collapse"><i
                                    class="fa fa-minus"></i></a>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="widget-card">
                                        @if ($carProfile->student_photo)
                                            <img id="player-image"
                                                src="{{ asset('storage/' . $carProfile->student_photo->file_path) }}"
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
                                                        class="detail-value">{{ $carProfile->first_name . ' ' . $carProfile->middle_name . ' ' . $carProfile->last_name }}</span>
                                                </div>
                                                <hr>
                                                <div class="user-detail">
                                                    <span class="detail-label">Student ID:</span>
                                                    <span class="detail-value">{{ $carProfile->student_id }}</span>
                                                </div>
                                                <hr>
                                                <div class="user-detail">
                                                    <span class="detail-label">Email:</span>
                                                    <span class="detail-value">{{ $carProfile->email }}</span>
                                                </div>
                                                <hr>
                                                <div class="user-detail">
                                                    <span class="detail-label">Mobile:</span>
                                                    <span class="detail-value">{{ $carProfile->mobile }}</span>
                                                </div>
                                                <hr>
                                                <div class="user-detail">
                                                    <span class="detail-label">Address:</span>
                                                    <span class="detail-value">{{ $carProfile->address }}</span>
                                                </div>
                                                <hr>
                                                <div class="user-detail">
                                                    <span class="detail-label">Mode of Study:</span>
                                                    <span class="detail-value">{{ $carProfile->mode_of_study }}</span>
                                                </div>
                                                <hr>
                                                <div class="user-detail">
                                                    <span class="detail-label">National ID:</span>
                                                    <span class="detail-value">{{ $carProfile->national_id }}</span>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-1">
                                            <div class="user-details">
                                                <div class="user-detail">
                                                    <span class="detail-label">Passport No.:</span>
                                                    <span class="detail-value">{{ $carProfile->passport_no }}</span>
                                                </div>
                                                <hr>
                                                <div class="user-detail">
                                                    <span class="detail-label">Student ID Expiry Date:</span>
                                                    <span
                                                        class="detail-value">{{ date('d, M Y', strtotime($carProfile->expiry_date)) }}</span>
                                                </div>
                                                <hr>
                                                <div class="user-detail">
                                                    <span class="detail-label">Course Faculty:</span>
                                                    <span class="detail-value">{{ $carProfile->course_faculty }}</span>
                                                </div>
                                                <hr>
                                                <div class="user-detail">
                                                    <span class="detail-label">Disabled:</span>
                                                    <span class="detail-value">{{ $carProfile->disabled }}</span>
                                                </div>
                                                <hr>
                                                <div class="user-detail">
                                                    <span class="detail-label">Student ID Copy:</span>
                                                    <span class="detail-value">
                                                        @if ($carProfile->student_id_copy)
                                                            <a
                                                                href="{{ route('admin.downloadNationalId', ['document' => $carProfile->student_id_copy->id]) }}"><i
                                                                    class="fa fa-cloud-download"></i>
                                                                {{ $carProfile->student_id_copy->file_name }}</a>
                                                        @else
                                                            No file uploaded
                                                        @endif
                                                    </span>
                                                </div>
                                                <hr>
                                                <div class="user-detail">
                                                    <span class="detail-label">National ID Copy: </span>
                                                    <span class="detail-value">
                                                        @if ($carProfile->student_id_copy)
                                                            <a
                                                                href="{{ route('admin.downloadNationalId', ['document' => $carProfile->student_id_copy->id]) }}"><i
                                                                    class="fa fa-cloud-download"></i>
                                                                {{ $carProfile->student_id_copy->file_name }}</a>
                                                        @else
                                                            No file uploaded
                                                        @endif
                                                    </span>
                                                </div>
                                                <hr>
                                                <div class="user-detail">
                                                    <span class="detail-label">Account Status:</span>
                                                    <?php if ($carProfile->status == 'approved') : ?>
                                                    <span
                                                        class="text-success px-2 pt-5px rounded fs-12px d-inline-flex align-items-center"><i
                                                            class="fa fa-circle fs-9px fa-fw me-5px"></i> Approved</span>
                                                    <?php endif ?>
                                                    <?php if ($carProfile->status == 'pending') : ?>
                                                    <span
                                                        class="text-primary px-2 pt-5px rounded fs-12px d-inline-flex align-items-center"><i
                                                            class="fa fa-circle fs-9px fa-fw me-5px"></i> Pending</span>
                                                    <?php endif ?>
                                                    <?php if ($carProfile->status == 'declined') : ?>
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

                <div class="col-md-4">
                    <div class="panel mt-4">
                        <div class="panel-heading text-white">
                            <h4 class="panel-title"><i class="fa fa-cubes-stacked"></i> Allocate Parking Lot</h4>
                            <div class="panel-heading-btn"></div>
                        </div>
                        <div class="panel-body">
                            @if ($parkingLot->tag !== null)
                                <form id="parking-lot-form" method="POST" action="{{ route('security.addParkingLog') }}">
                                    @csrf
                                    <input type="hidden"
                                                class="form-control form-control-lg mb-5px @error('student_member_id') is-invalid @enderror"
                                                id="student_member_id" name="student_member_id" value="{{ $carProfile->id }}"
                                                placeholder="Enter Parking Lot Tag" required />
                                    <div class="row mb-15px">
                                        <div class="col-sm-12">
                                            <label class="form-label col-form-label" for="tag">Available Parking Lot
                                                Tag<span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control form-control-lg mb-5px @error('tag') is-invalid @enderror"
                                                id="tag" name="tag" value="{{ $parkingLot->tag }}"
                                                placeholder="Enter Parking Lot Tag" required />
                                            @error('tag')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="d-flex flex-wrap gap-2 mb-3">
                                        <button type="submit" class="btn btn-success waves-effect waves-light"><i
                                                class="fas fa-plus-circle"></i> Allocate Parking Lot</button>
                                    </div>
                                </form>
                            @else
                                No Parking spots available
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection


@section('js_scripts')
@endsection
