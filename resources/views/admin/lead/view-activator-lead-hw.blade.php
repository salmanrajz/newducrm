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
        <form class="form form-vertical" id="MyRoleForm" onsubmit="return false">
            <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                <input class="form-control " id="leadno" value="{{ $data->lead_no }}" placeholder="Lead Number"
                    type="text" disabled>
                {{-- <input type="hidden" name="lead_type" id="type" value="{{ $ptype }}">
                --}}
                <!-- <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span> -->
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Full Name</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <input type="text" id="full_name" class="form-control" name="full_name"
                                placeholder="Full Name (Exactly as Per Emirate ID)" required
                                value="{{ $data->customer_name }}" disabled />
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Users Contact #</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <input type="tel" maxlength="10"
                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                onkeypress="return isNumberKey(event) " id="first-name-icon" class="form-control"
                                name="contact_number" placeholder="052XXXXXX" value="{{ $data->customer_number }}"
                                disabled required />
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Emirate ID</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <input type="text" id="emirate_id" class="form-control" name="emirate_id"
                                {{-- placeholder="Emirate ID" required --}}
                                {{-- data-inputmask="'mask': '999-999-9999999-9'" --}}
                                {{-- placeholder="XXXXX-XXXXXXX-X" --}}
                                value="{{ $data->emirate_id }}" disabled />
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Nationality/Citizen</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="box"></i></span>
                            <select name="nationality" id="nationality" class="is_mnp form-control" disabled required>
                                @foreach($country as $item)
                                    <option value="{{ $item->name }}"
                                        {{ $data->nationality == $item->name ? 'selected' : '' }}>
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Gender</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <select name="gender" id="gender" class="is_mnp form-control" disabled>
                                <option value="Male"
                                    {{ $data->gender == 'Male' ? 'selected' : '' }}>
                                    Male</option>
                                <option value="Female"
                                    {{ $data->gender == 'Female' ? 'selected' : '' }}>
                                    Female</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Date of Birth</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <input type="text" name="dob" id="dob" class="form-control" required
                                value="{{ $data->dob }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Emirate Expiry</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <input type="text" name="emirate_expiry" id="emirate_expiry" class="form-control"
                                value="{{ $data->dob }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Emirates</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="map"></i></span>
                            <select name="emirate" id="emirate" class="is_mnp form-control" required disabled>
                                @foreach($emirate as $item)
                                    <option value="{{ $item->name }}"
                                        {{ $data->emirate == $item->name ? 'selected' : '' }}>
                                        {{ $item->name }}</option>
                                @endforeach
                            </select> </div>
                    </div>
                </div>


                <div class="col-4">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Lead Type</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <input type="text" name="emirate_expiry" id="emirate_expiry" class="form-control"
                                value="{{ $data->lead_type }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Tracking ID</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <input type="text" name="remarks" id="remarks" class="form-control"
                                value="{{ $data->work_order_num }}" autocomplete="false">
                        </div>
                    </div>
                </div>
               <div class="col-md-4 mb-3">
                                        <label class="col-form-label">Customer Type</label>
                                        <select name="customer_type" id="customer_type" class="is_mnp form-control"
                                            required>
                                            <option value="New"
                                                {{ $data->id_type == 'New' ? 'selected' : '' }}>
                                                New Alternative ID</option>
                                            <option value="same_id"
                                                {{ $data->id_type == 'same_id' ? 'selected' : '' }}>
                                                Same Emirate ID</option>
                                            {{-- <option value="Urdu">Urdu/Hindi</option> --}}
                                        </select>
                                    </div>


                @if($data->lead_type == 'P2P')
                    <div class="col-12">
                        <div class="mb-1">
                            <label class="form-label" for="first-name-icon">OMID ID#</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i data-feather="user"></i></span>
                                <input type="text" name="omid" id="omid" class="form-control" value=""
                                    autocomplete="false">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-1">
                            <label class="form-label" for="first-name-icon">Activation Screenshot:</label>
                            <div class="input-group input-group-merge">
                                <input type="file" name="activation_screenshot" id="additional_documents"
                                    class="form-control" accept="image/*">

                                </h3>
                            </div>
                            <img id="myImg3"
                                src="{{ env('CDN_URL') }}/documents/{{ $data->additional_docs }}"
                                alt="your image" style="width:25%" onerror="this.style.display='none'" />
                        </div>
                    </div>
                @elseif($data->lead_type == 'HomeWifi')
                <hr>
                <h6 class="text-center">Current Activation Details</h6>
                <hr>
                <div class="row">
                    <div class="col-3">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">5G Number</label>
                        <div class="input-group input-group-merge">
                            {{-- <span class="input-group-text"><i data-feather="user"></i></span> --}}
                            <input type="text" name="reff_id" id="reff_id" class="form-control"
                                value="{{ $data->reff_id }}" autocomplete="false">
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Contract ID</label>
                        <div class="input-group input-group-merge">
                            {{-- <span class="input-group-text"><i data-feather="user"></i></span> --}}
                            <input type="text" name="contract_id" id="contract_id" class="form-control"
                                value="{{ $data->contract_id }}" autocomplete="false">
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Account ID</label>
                        <div class="input-group input-group-merge">
                            {{-- <span class="input-group-text"><i data-feather="user"></i></span> --}}
                            <input type="text" name="account_id" id="account_id" class="form-control"
                                value="{{ $data->account_id }}" autocomplete="false">
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Billing Cycle</label>
                        <div class="input-group input-group-merge">
                            {{-- <span class="input-group-text"><i data-feather="user"></i></span> --}}
                            <select name="billing_cycle" id="billing_cycle" class="form-control">
                                <option value="1">1</option>
                                <option value="7">7</option>
                                <option value="17">17</option>
                            </select>
                        </div>
                    </div>
                </div>


                </div>
                <hr>
                <h6 class="text-center">Old HW Activation Details</h6>
                <hr>
                <div class="row mb-5">
                    <div class="col-3">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Old 5G Number</label>
                        <div class="input-group input-group-merge">
                            <input type="text" name="old_fivejee_number" id="old_fivejee_number" class="form-control"
                                value="{{ $data->old_fivejee_number }}" autocomplete="false">
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Account ID</label>
                        <div class="input-group input-group-merge">
                            <input type="text" name="old_account_id" id="old_account_id" class="form-control"
                                value="{{ $data->old_account_id }}" autocomplete="false">
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Billing Cycle</label>
                        <div class="input-group input-group-merge">
                            <select name="old_billing_cycle" id="old_billing_cycle" class="form-control">
                                <option value="1">1</option>
                                <option value="7">7</option>
                                <option value="17">17</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Old Emirate ID</label>
                        <div class="input-group input-group-merge">
                            <input type="text" id="old_account_emirate_id" class="form-control" name="old_account_emirate_id"
                                            placeholder="Emirate ID" required
                                            data-inputmask="'mask': '999-9999-9999999-9'"
                                            placeholder="XXXXX-XXXXXXX-X" />
                            {{-- <input type="text" name="old_emirate_id" id="old_emirate_id"  class="form-control"> --}}
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Old Reg Number</label>
                        <input type="text" name="old_registered_number" id="old_registered_number"  class="form-control">
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Old Reg Email</label>
                        <div class="input-group input-group-merge">
                            <input type="text" name="old_registered_email" id="old_registered_email"  class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Old Expiry Date</label>
                        <div class="input-group input-group-merge">
                            <input type="date" name="old_expiry_date" id="old_expiry_date"  class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">OLD Date Of Birth</label>
                        <div class="input-group input-group-merge">
                            <input type="date" name="old_dob" id="old_dob"  class="form-control">
                        </div>
                    </div>
                </div>

                </div>



                @else
                    <div class="col-12">
                        <div class="mb-1">
                            <label class="form-label" for="first-name-icon">OMID ID#</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i data-feather="user"></i></span>
                                <input type="text" name="omid" id="omid" class="form-control" value=""
                                    autocomplete="false">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-1">
                            <label class="form-label" for="first-name-icon">Shipment ID #</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i data-feather="user"></i></span>
                                <input type="text" name="shipment" id="shipment" class="form-control" value=""
                                    autocomplete="false">
                            </div>
                        </div>
                    </div>
                     <div class="col-12">
                        <div class="mb-1">
                            <label class="form-label" for="first-name-icon">Process Screenshot:</label>
                            <div class="input-group input-group-merge">
                                <input type="file" name="process_screenshot" id="additional_documents"
                                    class="form-control" accept="image/*">

                                </h3>
                            </div>
                            <img id="myImg3"
                                src=""
                                alt="your image" style="width:25%" onerror="this.style.display='none'" />
                        </div>
                    </div>
                    @endif

                        <input type="hidden" name="leadid" id="leadid" value="{{ $data->id }}">
                        <input type="hidden" name="id" id="id" value="{{ $data->id }}">

                {{-- IMO END --}}
                <div class="col-12">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                </div>
                <h3 class="text-center" id="loading_num3" style="display:none">
                            Please wait while system loading leads...
                            <img src="{{asset('images/loader/loader.gif')}}" alt="Loading"
                                class="img-fluid text-center offset-md-6" style="width:35px;">
                        </h3>
                <div class="col-12">
                    @if($data->lead_type == 'P2P')
                    <button type="submit" class="btn btn-primary me-1"
                    onclick="SavingActivationLead('{{ route('proceed.p2p') }}', 'MyRoleForm','{{ route('home') }}')">Submit
                    For Activation</button>
                    @elseif($data->lead_type == 'HomeWifi')
                    <button type="submit" class="btn btn-primary me-1"
                    onclick="SavingActivationLead('{{ route('proceed.hw') }}', 'MyRoleForm','{{ route('home') }}')">Submit
                    For Activation</button>
                    @else
                    <button type="submit" class="btn btn-primary me-1"
                    onclick="SavingActivationLead('{{ route('proceed.mnp') }}', 'MyRoleForm','{{ route('home') }}')">Submit
                    For Pre Process</button>
                    @endif
                    <button type="button" class="btn btn-danger me-1"
                        {{-- onclick="SavingActivationLead('{{ route('RejectLeads') }}', 'MyRoleForm'
                        ,'{{ route('home') }}')" --}}
                        data-bs-toggle="modal" data-bs-target="#exampleModal">Reject</button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Reject Reason</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <select name="reject_comment_new" id="reject_comment" class="form-control">
                                        <option value="">Select Reject Reason</option>
                                        <option value="Cancelled By DU" selected>Cancelled By DU</option>
                                        <option value="Duplicate Lead">Duplicate Lead</option>
                                        <option value="Active By Another Partner">Active By Another Partner</option>
                                        <option value="NO 5G">No 5G</option>
                                        <option value="Already Active">Already Active</option>
                                        <option value="Less Age">Less Age</option>
                                        <option value="Already Postpaid">Already Postpaid</option>
                                        <option value="No Need">No Need</option>
                                        <option value="Not Interested">Not Interested</option>
                                        <option value="Emriate ID Expired">Emriate ID Expired</option>
                                        <option value="Cap Limit">Cap Limit</option>
                                        <option value="Less Salary">Less Salary</option>
                                        <option value="Bill Pending" >Bill Pending</option>
                                        <option value="dont have valid docs">dont have valid docs</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary"
                                    onclick="SavingActivationLead('{{ route('RejectLeadsPre') }}', 'MyRoleForm','{{ route('home') }}')"
                                    >Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- </div> --}}
                    {{-- <div class="col-12"> --}}
                    {{-- <button type="submit" class="btn btn-primary me-1"
                                    onclick="SavingActivationLead('{{ route('submit.proceed') }}',
                    'MyRoleForm','{{ route('home') }}')">Submit For Proceed</button> --}}
                </div>
            </div>
        </form>
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
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script>
    $(":input").inputmask();

</script>
@endsection
