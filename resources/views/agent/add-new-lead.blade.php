@extends('layouts.simple.master')
@section('title', 'Data Forms')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Data Forms</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Home Wifi</li>
<li class="breadcrumb-item active">Data Forms</li>
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
                            <form class="theme-form mega-form" id="MyRoleForm" onsubmit="return false"
                                autocomplete="off">
                                <h6>Data Information</h6>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="col-form-label">Short Code</label>
                                        <input class="form-control" type="text" placeholder="Short Code"
                                            onchange="CheckSystemLog('{{ route('CheckLogInfo') }}')"
                                            id="logsystemid" name="logsystemid">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="col-form-label">Customer Name</label>
                                        <input class="form-control" type="text" placeholder="Customer Name"
                                            id="full_name" name="full_name">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="col-form-label">Contact Number</label>
                                        <input class="form-control" type="text" placeholder="Enter contact number"
                                            id="contact_number" name="contact_number" readonly>
                                        <a href="#" id="UpdateNum">Update Number</a>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="col-form-label">Language</label>
                                        <select name="language" id="language" class="is_mnp form-control" required>
                                            <option value="English">English</option>
                                            <option value="Arabic" selected>Arabic</option>
                                            <option value="Urdu/Hindi">Urdu/Hindi</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="col-form-label">Customer Type</label>
                                        <select name="customer_type" id="customer_type" class="is_mnp form-control"
                                            required>
                                            <option value="New">New Alternative ID</option>
                                            <option value="same_id" selected>Same Emirate ID</option>
                                            {{-- <option value="Urdu">Urdu/Hindi</option> --}}
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="col-form-label">Emirate</label>
                                        <select name="emirate" id="emirate" class="is_mnp form-control" required>
                                            @foreach($emirate as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Address:</label>
                                    <input class="form-control" type="text" placeholder="Address" id="address"
                                        name="address">
                                </div>
                                <div class="row">

                                    <div class="col-4">
                                        <div class="mb-1">
                                            <label class="form-label" for="first-name-icon">Product Type</label>
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"><i data-feather="user"></i></span>
                                                <select name="CategoryType" id="CategoryType"
                                                    class="is_mnp form-control" required>
                                                    <option value="">Select Plan</option>

                                                    <option value="P2P">P2P</option>
                                                    <option value="MNP">MNP</option>
                                                    <option value="HomeWifi">HW</option>
                                                    <option value="FNE">FNE</option>
                                                </select>
                                            </div>
                                        </div>
                                        <input type="hidden" id="PlanChangeUrl"
                                            value="{{ route('PlanChange') }}">
                                    </div>

                                    <div class="col-8">
                                        <div class="mb-1">
                                            <label class="form-label" for="first-name-icon">Plans</label>
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"><i data-feather="user"></i></span>
                                                <select name="plans" id="plans" class="is_mnp form-control" required>
                                                    <option value="">Select Plan</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-1">
                                        <label class="form-label" for="first-comment-icon">Remarks</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i data-feather="file-text"></i></span>
                                            <input type="text" name="remarks" id="remarks" class="form-control"
                                                value="Please Verify">
                                        </div>
                                    </div>
                                </div>
                                {{--  --}}
                                <div class="row" id="DocsList" style="display:none">
                                    <div class="col-md-4 mb-3">
                                        <label class="col-form-label">Front Docs</label>
                                        <input type="file" name="front_docs" id="front_docs" class="form-control">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="col-form-label">Back Docs</label>
                                        <input type="file" name="back_docs" id="back_docs" class="form-control">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="col-form-label">Documents</label>
                                        <input type="file" name="additional_documents" id="additional_documents" class="form-control">
                                    </div>
                                </div>
                                {{--  --}}
                                <div class="col-12 mt-2">
                                    <div class="alert alert-danger print-error-msg" style="display:none">
                                        <ul></ul>
                                    </div>
                                </div>

                                <div class="card-footer text-end">
                                    <button class="btn btn-primary"
                                        onclick="SavingActivationLead('{{ route('HomeWifiSubmit') }}', 'MyRoleForm','{{ route('index') }}')">Submit</button>
                                    <button class="btn btn-success"
                                        onclick="SavingActivationLead('{{ route('HomeWifiSubmitWhatsApp') }}', 'MyRoleForm','{{ route('index') }}')">Verify
                                        On WhatsApp
                                        <i class="fa fa-whatsapp"></i>
                                    </button>
                                </div>

                        </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection
