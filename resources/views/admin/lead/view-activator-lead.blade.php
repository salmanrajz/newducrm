@extends('layouts/contentLayoutMaster')

@section('title', 'MNP | P2P Leads')

@section('content')
<!-- Basic Horizontal form layout section start -->

<!-- Basic Horizontal form layout section end -->

<!-- Basic Vertical form layout section start -->
<section id="basic-vertical-layouts">
    <div class="row">

        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Upload Front ID for Data Fetching</h4>
                </div>
                <div class="form-container container">
                    <div class="row">
                        {{-- <div class="col-12">
                            <form onsubmit="return false" method="post" enctype="multipart/form-data"
                                id="FetchApiForm3">
@csrf
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Emirate Front ID:</label>
                                    <div class="input-group input-group-merge">
                                        <input type="file" name="front_img" id="front_img"
                                            onchange="NameApi('{{ route('ocr-name.submit') }}','FetchApiForm3')">
                        <h3 class="text-center" id="loading_num1" style="display:none">
                            <img src="{{ asset('assets/images/loader.gif') }}" alt="Loading"
                                class="img-fluid text-center offset-md-6" style="width:35px;">
                        </h3>
                        <div class="form-group hidden d-none">
                            <label for="dob">Name:</label>
                            <input type="text" name="dob" id="name">
                        </div>
                        <div class="form-group  hidden d-none ">
                            <label for="dob">Emirate ID:</label>
                            <input type="text" name="dob" id="emirate_id_l">
                        </div>
                    </div>
                </div>

                </form>
            </div> --}}

        </div>
    </div>
    <div class="card-header">
        <h4 class="card-title">Lead Information</h4>
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
                <div class="col-12">
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
                <div class="col-12">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Email</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <input type="text" id="first-name-icon" class="form-control" name="email"
                                placeholder="Email" required value="{{ $data->email }}" disabled />
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Users Contact #</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <input type="tel" maxlength="13"
                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                onkeypress="return isNumberKey(event) " id="first-name-icon" class="form-control"
                                name="contact_number" placeholder="052XXXXXX" value="{{ $data->customer_number }}"
                                 required />
                        </div>
                    </div>
                </div>
                <div class="col-12">
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

                <div class="col-12">
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
                <div class="col-12">
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

                <div class="col-12">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Date of Birth</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <input type="text" name="dob" id="dob" class="form-control" required
                                value="{{ $data->dob }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Emirate Expiry</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <input type="text" name="emirate_expiry" id="emirate_expiry" class="form-control"
                                value="{{ $data->dob }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="col-12">
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

                <div class="col-12">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Additional Documents</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="map"></i></span>
                            <select name="additional_docs_name" id="additional_docs_name" class="form-control" disabled>
                                <option value="Ejari"
                                    {{ $data->additional_docs_name == 'Ejari' ? 'selected' : '' }}>
                                    Ejari</option>
                                <option value="Tenancy contract"
                                    {{ $data->additional_docs_name == 'Tenancy contract' ? 'selected' : '' }}>
                                    Tenancy contract</option>
                                <option value="Title deed (front side)"
                                    {{ $data->additional_docs_name == 'Title deed (front side)' ? 'selected' : '' }}>
                                    Title deed (front side)</option>
                                <option value="Salary Certificate"
                                    {{ $data->additional_docs_name == 'Salary Certificate' ? 'selected' : '' }}>
                                    Salary Certificate (latest 3 months (min. salary of AED 2,500 with UAE based company
                                    name. Contact details, original company stamp on letterhead is required))</option>
                                <option value="Utility Bill"
                                    {{ $data->additional_docs_name == 'Utility Bill' ? 'selected' : '' }}>
                                    Utility Bill - latest 3 months (Electricity / Water / Internet or TV / landline /
                                    broadband bill)</option>
                                <option value="Labour Contract"
                                    {{ $data->additional_docs_name == 'Labour Contract' ? 'selected' : '' }}>
                                    Labour contract (pages with Name, nationality, Passport numbers)</option>
                            </select> </div>
                    </div>
                </div>
<div class="col-12">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Lead Type</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <input type="text" name="emirate_expiry" id="emirate_expiry" class="form-control"
                                value="{{ $data->lead_type }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Remarks</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <input type="text" name="remarks" id="remarks" class="form-control"
                                value="{{ $data->remarks }}" autocomplete="false">
                        </div>
                    </div>

                </div>
                @if($data->lead_type == 'P2P')
                <div class="col-12">
                        <div class="mb-1">
                            <label class="form-label" for="first-name-icon">Postpaid Plan</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i data-feather="user"></i></span>
                                <select name="plans" id="plans" class="is_mnp form-control" required>
                                    @foreach($plan as $item)
                                        <option value="{{ $item->id }}" {{$data->plans == $item->id ? 'selected' : ''}} >{{ $item->plan_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
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
                    {{--  --}}

                    {{--  --}}
                    <div class="col-12">
                        <div class="mb-1">
                            <label class="form-label" for="first-name-icon">Channel Partner</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i data-feather="user"></i></span>
                                <select name="channel_partner" id="channel_partner" class="form-control">
                                    <option value="Vocus">Vocus</option>
                                    <option value="Smart Tune">Smart Tune</option>
                                </select>
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

                    <div class="row">

                        <div class="col-4">
                            <label for="front_id">Front ID</label>
                            <img src="{{env('CDN_URL')}}/documents/{{$data->front_id}}" alt="Front ID" width="250px" id="myImg1">
                            <input type="hidden" name="old_front_id" value="{{$data->front_id}}" id="old_front_id" >
                            {{-- <div class="input-group input-group-merge mt-2">
                                <input type="file" name="front_id" id="front_img" class="form-control" accept="image/*" >
                            </div> --}}
                        </div>
                        <div class="col-4">
                            <label for="front_id">Back ID</label>
                            <img src="{{env('CDN_URL')}}/documents/{{$data->back_id}}" alt="Back ID"  width="250px" id="myImg2">
                            <input type="hidden" name="old_back_id" value="{{$data->back_id}}" id="old_front_id">
                            {{-- <div class="input-group input-group-merge mt-2">
                                <input type="file" name="back_id" id="back_img" class="form-control" accept="image/*">
                            </div> --}}
                        </div>
                        <div class="col-4">
                            <label for="front_id">Additional Docs</label>
                            <img src="{{env('CDN_URL')}}/documents/{{$data->additional_docs_photo}}" alt="{{$data->additional_docs_name}}"  width="250px" id="myImg3">
                            <input type="hidden" name="old_additional_docs_name" value="{{$data->additional_docs_photo}}" id="old_front_id">
                            {{-- <div class="input-group input-group-merge mt-2">
                                <input type="file" name="additional_docs_photo" id="additional_documents" class="form-control" accept="image/*">
                            </div> --}}
                        </div>
                    </div>
                    @elseif($data->lead_type == 'New')
                    <div class="col-12">
                        <div class="mb-1">
                            <label class="form-label" for="first-name-icon">Postpaid Plan</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i data-feather="user"></i></span>
                                <select name="plans" id="plans" class="is_mnp form-control" required>
                                    @foreach($plan as $item)
                                        <option value="{{ $item->id }}" {{$data->plans == $item->id ? 'selected' : ''}} >{{ $item->plan_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                         <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Tracking ID</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <input type="text" name="remarks" id="remarks" class="form-control"
                                value="{{ $data->work_order_num }}" autocomplete="false">
                        </div>
                    </div>
                    <div class="col-12">
                         <div class="mb-1">
                        <label class="form-label" for="first-name-icon">New Number</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <input type="text" name="remarks" id="remarks" class="form-control"
                                value="{{ $data->reff_id }}" autocomplete="false">
                        </div>
                    </div>
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

                     <div class="col-8">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Contract ID</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <input type="text" name="contract_id" id="contract_id" class="form-control"
                                value="{{ $data->contract_id }}" autocomplete="false">
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Account ID</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <input type="text" name="account_id" id="account_id" class="form-control"
                                value="{{ $data->account_id }}" autocomplete="false">
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Billing Cycle</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <select name="billing_cycle" id="billing_cycle" class="form-control">
                                <option value="1">1</option>
                                <option value="7">7</option>
                                <option value="17">17</option>
                            </select>
                            {{-- <input type="date" name="billing_cycle" id="billing_cycle" class="form-control" --}}
                                {{-- value="{{ $data->bi }}" autocomplete="false" --}}
                                {{-- > --}}
                        </div>
                    </div>
                </div>
                 <div class="col-8">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Billing Date</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <input type="date" name="billing_date" id="billing_date" class="form-control">
                        </div>
                    </div>
                </div>
                        <input type="hidden" name="leadid" value="{{ $data->id }}">

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
                    @elseif($data->lead_type == 'New')
                    <button type="submit" class="btn btn-primary me-1"
                    onclick="SavingActivationLead('{{ route('proceed.new') }}', 'MyRoleForm','{{ route('home') }}')">Submit
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
                                        <option value="Already Active">Already Active</option>
                                        <option value="Less Age">Less Age</option>
                                        <option value="Already Postpaid">Already Postpaid</option>
                                        <option value="No Need">No Need</option>
                                        <option value="Not Interested">Not Interested</option>
                                        <option value="Emriate ID Expired">Emriate ID Expired</option>
                                        <option value="Cap Limit">Cap Limit</option>
                                        <option value="Less Salary">Less Salary</option>
                                        <option value="Bill Pending" selected>Bill Pending</option>
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
    </div>
    </div>

    </div>
    @include('admin.chat.chat')

</section>
<!-- Basic Vertical form layout section end -->

<!-- Basic multiple Column Form section start -->


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
