@extends('layouts/contentLayoutMaster')

@section('title', 'New FNE Request')

@section('content')
<!-- Basic Horizontal form layout section start -->

<!-- Basic Horizontal form layout section end -->

<!-- Basic Vertical form layout section start -->
<section id="basic-vertical-layouts">
    <div class="row">

        <div class="col-md-12 col-12">
            <div class="card">

                <div class="card-header">
                    <h4 class="card-title">FNE Request</h4>
                </div>
                <div class="card-body">
                    <form class="form form-vertical" id="MyRoleForm" onsubmit="return false">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Agent Name:</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="full_name" class="form-control" name="building"
                                            placeholder="Building Name"
                                            value="{{$data->name}}"
                                            />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Agent Email:</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="full_name" class="form-control" name="building"
                                            placeholder="Building Name"
                                            value="{{$data->email}}"
                                            />
                                    </div>
                                </div>
                            </div>
                            {{--  --}}
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Customer Name:</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text"  id="first-name-icon"
                                            class="form-control" name="customer_name" placeholder="Salman"
                                            value="{{$data->customer_name}}"
                                            />
                                    </div>
                                </div>
                            </div>
                           <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">FNE Plan - {{$data->plan}}</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <select name="plans" id="plans" class="is_mnp form-control" required>
                                            <option value="">Select Plan</option>
                                            @foreach($planwifi as $item)
                                                <option value="{{ $item->id }}" {{$data->plan == $item->id ? 'selected' : ''}}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Customer Number:</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text"  id="first-name-icon"
                                            class="form-control" name="customer_number" placeholder="052XXXXXX"
                                            value="{{$data->customer_number}}"
                                            />
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Customer 5G Number (Required if Upgrade):</label>
                                    <div class="input-group input-group-merge" style="border: 2px solid blue;border-radius: 8px;">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text"  id="first-name-icon"
                                            class="form-control" name="fiveg_number" placeholder="052XXXXXX"
                                            value="{{$data->fnumber}}"
                                            />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Customer Account ID:</label>
                                    <div class="input-group input-group-merge" style="border: 2px solid blue;border-radius: 8px;">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text"  id="first-name-icon"
                                            class="form-control" name="account_id" placeholder="052XXXXXX"
                                            value="{{$data->account_id}}"
                                            />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12" >
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Customer 5G Expiry  (Required if Upgrade):</label>
                                    <div class="input-group input-group-merge" style="border: 2px solid blue;border-radius: 8px;">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="date"  id="first-name-icon"
                                            class="form-control" name="expiry" placeholder="052XXXXXX"
                                            value="{{$data->expiry}}"
                                            />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12" id="fullemirateid" style="display: block">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Emirate ID</label>
                                    <div class="input-group input-group-merge" style="border: 2px solid red;border-radius: 8px;">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="emirate_id" class="form-control" name="emirate_id"
                                            placeholder="Full Emirate ID" required data-inputmask="'mask': '999-9999-9999999-9'"
                                            placeholder="XXXXX-XXXXXXX-X" value="{{$data->emirate_id}}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">DOB:</label>
                                    <div class="input-group input-group-merge" style="border: 2px solid red;border-radius: 8px;">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="date"  id="first-name-icon"
                                            class="form-control" name="dob" placeholder="052XXXXXX"
                                            value="{{$data->dob}}"
                                            />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Nationality/Citizen</label>
                                    <div class="input-group input-group-merge" style="border: 2px solid red;border-radius: 8px;">
                                        <span class="input-group-text"><i data-feather="box"></i></span>
                                        <select name="nationality" id="nationality" class="is_mnp form-control"
                                            required>
                                            <option value="">Select Nationality</option>
                                            @foreach($country as $item)
                                                <option value="{{ $item->name }}" {{$data->nationality == $item->name ? 'selected' : ''}}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                             <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">GIAD</label>
                                    <div class="input-group input-group-merge" style="border: 2px solid red;border-radius: 8px;">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" name="giad" id="giad" class="form-control" value="{{$data->giad}}">
                                    </div>
                                </div>
                            </div>

                            {{--  --}}
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Building Name:</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="full_name" class="form-control" name="building"
                                            placeholder="Building Name"
                                            value="{{$data->building}}"
                                            />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Unit Name:</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="full_name" class="form-control" name="unit"
                                            placeholder="Unit Name"                                             value="{{$data->unit}}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Full Address: </label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="first-name-icon" class="form-control" name="address"
                                            placeholder="Full Address"
                                            value="{{$data->address}}"

                                            />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Google Location Url:</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text"  id="first-name-icon"
                                            class="form-control" name="google_location" placeholder="https://maps.google.com"
                                            value="{{$data->google_location}}"

                                            />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Lat:</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text"  id="first-name-icon"
                                            class="form-control" name="google_location" placeholder="https://maps.google.com"
                                            value="{{$data->lat}}"

                                            />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Lang:</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text"  id="first-name-icon"
                                            class="form-control" name="google_location" placeholder="https://maps.google.com"
                                            value="{{$data->lng}}"

                                            />
                                    </div>
                                </div>
                            </div>
                             <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Project Type</label>
                                    <div class="input-group input-group-merge" style="border: 2px solid red;border-radius: 8px;">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" name="project_type" id="project_type" class="form-control"
                                         value="{{$data->project_type}}"
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Status:</label>
                                    <div class="input-group input-group-merge" style="border: 2px solid red;border-radius: 8px;">
                                        <select name="is_status" id="is_status" class="form-control"
                                            onchange="CheckRemarkZone()"

                                        >
                                            <option value="">Select Status</option>
                                            {{-- <option value=""></option> --}}
                                            {{-- <optgroup label="Optional"> --}}
                                                {{-- <option value="Pending" {{$data->is_status == 'Pending' ? 'selected' : ''}}>Pending</option> --}}
                                            {{-- </optgroup> --}}
                                            <option value="RFS" {{$data->is_status == 'RFS' ? 'selected' : ''}}>RFS</option>
                                            <option value="ShortFall" {{$data->is_status == 'ShortFall' ? 'selected' : ''}}>ShortFall</option>
                                            <option value="OutZone" {{$data->is_status == 'OutZone' ? 'selected' : ''}}>OutZone</option>
                                            <option value="Invalid" {{$data->is_status == 'Invalid' ? 'selected' : ''}}>Invalid Location</option>
                                            <option value="Commercial" {{$data->is_status == 'Commercial' ? 'selected' : ''}}>Commercial</option>
                                            <option value="not_eligible" {{$data->is_status == 'not_eligible' ? 'selected' : ''}}>Not Eligbile</option>
                                            {{-- <option value="Closed" {{$data->is_status == 'Closed' ? 'selected' : ''}}>Closed</option> --}}
                                            {{-- <option value="Invalid Google pin" {{$data->is_status == 'Invalid Google pin' ? 'selected' : ''}}>Invalid Google pin</option> --}}
                                            {{-- <option value="No Google Pin" {{$data->is_status == 'No Google Pin' ? 'selected' : ''}}>No Google Pin</option> --}}
                                            {{-- <option value="TT_GENERATED" {{$data->is_status == 'TT_GENERATED' ? 'selected' : ''}}>TT Generated</option> --}}
                                            {{-- <option value="Lead" {{$data->is_status == 'Lead' ? 'selected' : ''}}>Lead</option> --}}
                                            {{-- <option value="New 5G" {{$data->is_status == 'New 5G' ? 'selected' : ''}}>New 5G</option> --}}
                                            {{-- <option value="Already FNE" {{$data->is_status == 'Already FNE' ? 'selected' : ''}}>Already FNE</option> --}}
                                            {{-- <option value="Follow Up" {{$data->is_status == 'Follow Up' ? 'selected' : ''}}>Follow Up</option> --}}
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 hidden d-none">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Zone:</label>
                                    <div class="input-group input-group-merge" style="border: 2px solid red;border-radius: 8px;">
                                        <select name="zone" id="zone" class="form-control"
                                        >
                                            <option value="">Select Status - {{$data->zone}}</option>
                                            <option value="Pending" {{$data->zone == 'Pending' ? 'selected' : ''}}>Pending</option>
                                            <option value="OutZone" {{$data->zone == 'OutZone' ? 'selected' : ''}}>OutZone</option>
                                            <option value="RFS" {{$data->zone == 'RFS' ? 'selected' : ''}}>RFS</option>
                                            <option value="Invalid" {{$data->zone == 'Invalid' ? 'selected' : ''}}>Invalid</option>
                                            <option value="Pending" {{$data->zone == 'Pending' ? 'selected' : ''}}>Pending</option>
                                            <option value="Commercial" {{$data->zone == 'Commercial' ? 'selected' : ''}}>Commercial</option>
                                            <option value="TT_GENERATED" {{$data->zone == 'TT_GENERATED' ? 'selected' : ''}}>TT Generated</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 " >
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">TT NUMBER #: </label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="first-name-icon" class="form-control" name="tt_number"
                                            placeholder="TT NUMBER"
                                            value="{{$data->tt_number}}"

                                            />
                                    </div>
                                </div>
                            </div>
                             <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Not Elibible Remarks</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                       <input type="text" name="important_remarks" id="important_remarks" class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{$data->id}}">
                            <input type="hidden" name="uniquestatus" id="remarks" class="form-control" value="">




                            {{-- IMO END --}}
                            <div class="col-12">
                                <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-success me-1"
                                    onclick="SavingActivationLeadFNE('{{ route('request.fne.update') }}', 'MyRoleForm','{{ route('allfne') }}','1.17')">Submit (Send to Agent)</button>
                                <button type="submit" class="btn btn-primary me-1"
                                id="DuResource"
                                    onclick="SavingActivationLeadFNE('{{ route('request.fne.update') }}', 'MyRoleForm','{{ route('allfne') }}','1.16')">Send to DU Resources</button>

                                @if($data->is_status == 'RFS' || $data->is_status == 'Closed')
                                                                <button type="submit" class="btn btn-primary me-1"
                                id="DuResource"
                                    onclick="SavingActivationLead('{{ route('SendForApproval') }}', 'MyRoleForm','{{ route('home') }}')">Send for Approval</button>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                                onclick="window.location.href='{{route('add.work.order',$data->id)}}'"
                                >
                                        Add Activity & WO
                                </button>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                                onclick="window.location.href='{{route('return.fne.order',$data->id)}}'"
                                >
                                        Return FNE
                                </button>
                                @endif


                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- Basic Vertical form layout section end -->

<!-- Basic multiple Column Form section start -->

<input type="hidden" name="leadid" id="leadid" value="{{$data->id}}">

@include('admin.chat.chat-fne')

@endsection<!-- Basic Floating Label Form section end -->
@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/custom.js')) }}"></script>
<!-- Page js files -->
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script>
    $(":input").inputmask();

</script>
@endsection
