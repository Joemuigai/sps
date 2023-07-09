@extends('layouts.portal.index')

@section('css_scripts')

@endsection

@section('content')
    <div id="content" class="app-content">

        <ol class="breadcrumb float-xl-end" style="--bs-breadcrumb-divider: '::';" aria-label="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('member.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>

        <h1 class="page-header">
            Dashboard
        </h1>

        @include('layouts.portal.alerts_block')

@endsection


@section('js_scripts')

@endsection
