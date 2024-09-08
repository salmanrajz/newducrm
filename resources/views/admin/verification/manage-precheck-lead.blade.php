@extends('layouts.simple.master')
@section('title', 'View Lead')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>View Lead Forms</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Home Wifi</li>
<li class="breadcrumb-item active">View Lead</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-xl-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Lead form</h5>
                        </div>
                        <div class="card-body"

                        >
                            <form class="theme-form mega-form"
                             id="MyRoleForm" onsubmit="return false"
                        autocomplete="off"
                            >
                            {{-- <input type="hidden" name="LeadId" value="{{$data->id}}"> --}}
                                <h6>Data Information</h6>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="col-form-label">Short Code</label>
                                        <input class="form-control" type="text" placeholder="Short Code"
                                            {{-- onchange="CheckSystemLog('{{route('CheckLogInfo')}}')" id="logsystemid" --}}
                                            name="logsystemid"
                                            value="{{$data->short_code}}"
                                            >
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="col-form-label">Customer Name</label>
                                        <input class="form-control" type="text" placeholder="Customer Name"
                                            id="full_name" name="full_name"
                                            value="{{$data->customer_name}}"

                                            >
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="col-form-label">Contact Number</label>
                                        <input class="form-control" type="text" placeholder="Enter contact number"
                                            id="contact_number" name="contact_number" readonly
                                            value="{{\App\Http\Controllers\FunctionController::MaskMyNum($data->customer_number)}}"

                                            >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="col-form-label">Language</label>
                                        <select name="language" id="language" class="is_mnp form-control" required>
                                            <option value="English" {{$data->language == 'English' ? 'selected' : ''}}>English</option>
                                            <option value="Arabic" {{$data->language == 'Arabic' ? 'selected' : ''}}>Arabic</option>
                                            <option value="Urdu/Hindi" {{$data->language == 'Urdu/Hindi' ? 'selected' : ''}}>Urdu/Hindi</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="col-form-label">Customer Type</label>
                                        <select name="customer_type" id="customer_type" class="is_mnp form-control" required>
                                            <option value="New" {{$data->id_type == 'New' ? 'selected' : ''}}>New Alternative ID</option>
                                            <option value="same_id" {{$data->id_type == 'same_id' ? 'selected' : ''}}>Same Emirate ID</option>
                                            {{-- <option value="Urdu">Urdu/Hindi</option> --}}
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="col-form-label">Emirate</label>
                                        <select name="emirate" id="emirate" class="is_mnp form-control" required>
                                             @foreach($emirate as $item)
                                                <option value="{{ $item->name }}" {{$data->emirate == $item->name ? 'selected' : ''}}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Address:</label>
                                    <input class="form-control" type="text" placeholder="Address" id="address" name="address" value="{{$data->address}}">
                                </div>
                                <div class="row">

                                 <div class="row">

                                    <div class="col-4">
                                        <div class="mb-1">
                                            <label class="form-label" for="first-name-icon">Product Type</label>
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"><i data-feather="user"></i></span>
                                                <select name="CategoryType" id="CategoryType"
                                                    class="is_mnp form-control" required>
                                                    <option value="">Select Plan</option>

                                                    <option value="P2P" {{$data->lead_type == 'P2P' ? 'selected' : ''}}>P2P</option>
                                                    <option value="MNP" {{$data->lead_type == 'MNP' ? 'selected' : ''}}>MNP</option>
                                                    <option value="HomeWifi" {{$data->lead_type == 'HomeWifi' ? 'selected' : ''}}>HW</option>
                                                    <option value="FNE" {{$data->lead_type == 'FNE' ? 'selected' : ''}}>FNE</option>
                                                </select>
                                            </div>
                                        </div>
                                        <input type="hidden" id="PlanChangeUrl"
                                            value="{{ route('PlanCheck') }}">
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
                                <div class="col-6">
                                    <div class="mb-1">
                                        <label class="form-label" for="first-name-icon">Lead Status</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i data-feather="user"></i></span>
                                           <input type="text" name="status" id="status" class="form-control" value="{{\App\Http\Controllers\FunctionController::LeadStatus($data->status)}}">
                                        </div>
                                    </div>

                                </div>
                                </div>

                                <div class="col-12">

                            </div>
                            <hr>
                            <h3 class="text-center center">Only for Backoffice</h3>
                            <hr>
                            <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="col-form-label">Emirate ID</label>
                                        <input type="text" id="emirate_id" class="form-control" name="emirate_id"
                                            placeholder="Emirate ID" required
                                            data-inputmask="'mask': '999-9999-9999999-9'"
                                            placeholder="XXXXX-XXXXXXX-X" />
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="col-form-label">Gender</label>
                                        <select name="gender" id="gender" class="is_mnp form-control" required>
                                            <option value="">-- Select Gender --</option>

                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="col-form-label">Nationality</label>
                                        <select name="nationality" id="nationality" class="is_mnp form-control"
                                            required>
                                            <option value="">-- Select Nationality --</option>
                                            @foreach($countries as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="col-form-label">Expiry ID</label>
<input type="date" name="emirate_expiry" id="emirate_expiry"
                                            class="form-control" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="col-form-label">DOB</label>
                                        <input class="form-control" type="date" placeholder="Customer Name"
                                            id="dob" name="dob"
                                            value="{{$data->customer_name}}"

                                            >
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>
                            </div>

                                <div class="">
                                    <input type="button" value="Accept" class="btn btn-success" name="upload" onclick="VerifyLead('{{route('okprechecklead')}}','MyRoleForm','{{route('home')}}')">

                {{-- <input type="button" value="Pending For Approval" class="btn btn-success" name="upload" onclick="VerifyLead('{{route('pendingforapproval')}}','pre-verification-form','{{route('home')}}')"> --}}

                <input type="button" value="Reject" class="btn btn-danger" name="reject" onclick="VerifyLead('{{route('RejectLeads')}}','pre-verification-form','{{route('home')}}')">
                            </div>
<input type="hidden" name="leadid" id="leadid" value="{{$data->id}}">

                        </div>
                    </form>
                </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@include('admin.chat.chat')

@section('script')
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script>
    $(":input").inputmask();

</script>
<script>
setTimeout(() => {
    LoadPlanViewLead();
}, 3000);
</script>
@endsection
