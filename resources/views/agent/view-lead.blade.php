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
                                <div class="mb-1">
                                    <label class="form-label" for="first-comment-icon">Remarks</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="file-text"></i></span>
                                       <input type="text" name="remarks" id="remarks" class="form-control" value="{{$data->remarks}}">
                                    </div>
                                </div>
                            </div>
                                <div class="col-12 mt-2">
                                <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>
                            </div>

                                <div class="card-footer text-start">
                                    <button class="btn btn-primary"
                                    onclick="SavingActivationLead('{{ route('HomeWifiSubmit') }}', 'MyRoleForm','{{ route('index') }}')"
                                    >Submit</button>
                                    <button class="btn btn-success"
                                    onclick="SavingActivationLead('{{ route('HomeWifiSubmitWhatsApp') }}', 'MyRoleForm','{{ route('index') }}')"
                                    >Verify On WhatsApp
                                    <i class="fa fa-whatsapp"></i>
                                </button>
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
<script>
setTimeout(() => {
    LoadPlanViewLead();
}, 3000);
</script>
@endsection
