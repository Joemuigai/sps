@extends('layouts.portal.index')

@section('css_scripts')

@endsection

@section('content')
    <div id="content" class="app-content">

        <ol class="breadcrumb float-xl-end" style="--bs-breadcrumb-divider: '::';" aria-label="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.systemUsers') }}">System Users</a></li>
            <li class="breadcrumb-item active">{{ $user->first_name .' ' . $user->last_name }}</li>
        </ol>

        <h1 class="page-header text-uppercase">
            View System User
        </h1>

        <div class="row mb-3">
            <div class="col-md-8">

                <div class="panel mt-5">

                    <div class="panel-heading text-white">
                        <h4 class="panel-title"><i class="fa fa-universal-access"></i> System User Details</h4>

                    </div>


                    <div class="panel-body">



                        <form id='user-form' method="POST" action="{{ route('systemuser.updateUser', ['user' => $user->id]) }}">

                            @csrf
                            @method('PATCH')

                            {{-- <h5 class="text-uppercase"> Personal Details</h5> --}}

                            <div class="row mb-15px">
                                <div class="col-sm-6">
                                    <label class="form-label col-form-label" for="first_name">First Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg mb-5px @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ $user->first_name }}" placeholder="Enter First Name" autocomplete="off" />
                                    @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label col-form-label" for="last_name">Last Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg mb-5px @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ $user->last_name }}" placeholder="Enter Last Name" autocomplete="off" />
                                    @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label col-form-label" for="student_id">Username <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg mb-5px @error('username') is-invalid @enderror" id="username" name="username" value="{{ $user->username }}" placeholder="Enter Username" autocomplete="off" />
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label col-form-label" for="email">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control form-control-lg mb-5px @error('email') is-invalid @enderror" id="email" name="email" value="{{ $user->email }}" placeholder="Enter Email Address" autocomplete="off" readonly />
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>



                                <div class="col-sm-6">
                                    <label class="form-label col-form-label" for="mobile">Phone Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-lg mb-5px @error('mobile') is-invalid @enderror" id="mobile" name="mobile" value="{{ $user->mobile }}" placeholder="Enter Phone Number" autocomplete="off" />
                                    @error('mobile')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label col-form-label" for="position">Position</label>
                                    <select class="form-select form-select-lg mb-5px @error('role_id') is-invalid @enderror"
                                            name="role_id" id="role_id">
                                        <option value="">--- Select User Position ---</option>
                                        <option value="2" {{ $user->role_id === 2 ? 'selected' : '' }}>Administrator</option>
                                        <option value="3" {{ $user->role_id === 3 ? 'selected' : '' }}>Club Head</option>
                                        <option value="4" {{ $user->role_id === 4 ? 'selected' : '' }}>Club Patron</option>
                                        <option value="5" {{ $user->role_id === 5 ? 'selected' : '' }}>PR Student Council</option>
                                        <option value="6" {{ $user->role_id === 6 ? 'selected' : '' }}>VP Student Council</option>

                                    </select>
                                    @error('role_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label col-form-label" for="status">Account Status <span class="text-danger">*</span></label>
                                    <select class="form-select form-select-lg mb-5px @error('status') is-invalid @enderror" name="status" id="status">
                                        <option value="">--- Select Account Status ---</option>
                                        <option value="activated" {{ $user->status === 'activated' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ $user->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        <option value="suspended" {{ $user->status === 'suspended' ? 'selected' : '' }}>Suspended</option>
                                        <option value="locked" {{ $user->status === 'locked' ? 'selected' : '' }}>Locked</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label col-form-label" for="created_at">Date Registered</label>
                                    <input type="text" class="form-control form-control-lg mb-5px @error('created_at') is-invalid @enderror" id="created_at" name="created_at" value="{{ date('d, M Y', strtotime($user->created_at)) }}" readonly autocomplete="off" />
                                    @error('created_at')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>



                            </div>




                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <button type="submit" class="btn btn-success waves-effect waves-light"><i class="fas fa-plus-circle"></i> Update System User Details</button>
                                {{-- <button type="button" class="btn btn-danger waves-effect waves-light" onclick="document.getElementById('user-form').reset();"> <i class="fas fa-times-circle"></i> Cancel</button> --}}
                            </div>

                        </form>




                    </div>


                </div>

            </div>
            <div class="col-md-4">

                <div class="panel mt-5">

                    <div class="panel-heading text-white">
                        <h4 class="panel-title"><i class="fa fa-universal-access"></i> Update Account Password</h4>

                    </div>


                    <div class="panel-body">





                        <form id='user-password-form' method="POST" action="{{ route('systemuser.updateUserPassword', ['user' => $user->id]) }}">

                            @csrf
                            @method('PATCH')


                            <div class="row mb-15px">
                                <div class="col-sm-12">
                                    <label class="form-label col-form-label" for="password">New Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control form-control-lg mb-5px @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}" placeholder="New Password" autocomplete="off" />
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-12">
                                    <label class="form-label col-form-label" for="confirm_password">Confirm New Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control form-control-lg mb-5px @error('confirm_password') is-invalid @enderror" id="confirm_password" name="confirm_password" value="{{ old('confirm_password') }}" placeholder="Confirm New Password" autocomplete="off" />
                                    @error('confirm_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>





                            </div>




                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <button type="submit" class="btn btn-success waves-effect waves-light"><i class="fas fa-plus-circle"></i> Update account Password</button>
                            </div>

                        </form>


                    </div>


                </div>

            </div>
        </div>

        <div class="d-flex flex-wrap gap-2 mb-3">
            <button type="submit" class="btn btn-lg btn-danger waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#deleteModal" title="Delete" data-user-id="{{ $user->id }}"><i class="fas fa-trash"></i> Remove User Account Permanently</button>
            {{-- <button type="button" class="btn btn-danger waves-effect waves-light" onclick="document.getElementById('user-form').reset();"> <i class="fas fa-times-circle"></i> Cancel</button> --}}
        </div>

        <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger">
                            <h5><i class="fa fa-exclamation-triangle"></i> This action is irreversible </h5>
                            <p class="message"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-md btn-outline-primary" title="Cancel" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Cancel</button>
                        <form action="" class="delete-form" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-md btn-outline-danger" title="Delete"><i class="fa fa-trash"></i> Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>



@endsection

@section('js_scripts')
<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var userId = button.data('user-id'); // Extract info from data-* attributes
        var modal = $(this);

        // Make an AJAX request to get the category name
        $.get('{{ route('systemuser.showUser', ':id') }}'.replace(':id', userId), function (data) {
            modal.find('.modal-title').text('Delete Account for: ' + data.first_name + data.last_name);
            modal.find('.message').html('This will remove this users account permanently. Are you sure you want to delete the account?');
        });

        modal.find('.delete-form').attr('action', '{{ route('remove.systemuser', ':id') }}'.replace(':id', userId));

    });

</script>
@endsection
