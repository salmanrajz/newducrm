@extends('layouts.simple.master')
@section('title', 'Data Forms')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>User Forms</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Home Wifi</li>
<li class="breadcrumb-item active">Add New Users</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-xl-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Data form</h5>
                        </div>
                        <div class="card-body">
                            <form class="form form-vertical" id="MyRoleForm">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Call Center Name</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="first-name-icon" class="form-control" name="name"
                                            placeholder="Role Name" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Call Center Short Code</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="first-name-icon" class="form-control"
                                            name="call_center_short_code" placeholder="Role Name" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Notification Numbers</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="first-name-icon" class="form-control" name="numbers"
                                            placeholder="Role Name" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Guest Number</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="first-name-icon" class="form-control" name="guest_number"
                                            placeholder="Role Name" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Call Center Status</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="box"></i></span>
                                        <select name="status" id="status" class="status form-control">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">

                                <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary me-1"
                                    onclick="SavingActivationLead('{{ route('cc.add') }}', 'MyRoleForm','{{ route('call.center') }}')">Submit</button>
                                {{-- <button type="reset" class="btn btn-outline-secondary">Reset</button> --}}
                            </div>
                </div>
                </form>
                    </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection
