@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="fa fa-bell"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></span>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></span>
    </div>
@endif

{{-- @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show">

            @foreach ($errors->all() as $error)
                {{ $error }} <br>
            @endforeach

        <button type="button" class="btn-close" data-bs-dismiss="alert"></span>
    </div>
@endif --}}
