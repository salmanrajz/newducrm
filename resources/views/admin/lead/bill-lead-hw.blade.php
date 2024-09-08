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
                            <input type="tel" maxlength="10"
                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                onkeypress="return isNumberKey(event) " id="first-name-icon" class="form-control"
                                name="contact_number" placeholder="052XXXXXX" value="{{ $data->customer_number }}"
                                disabled required />
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">5G Contact #</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <input type="tel" maxlength="10"
                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                onkeypress="return isNumberKey(event) " id="first-name-icon" class="form-control"
                                name="contact_number" placeholder="052XXXXXX" value="{{ $data->reff_id }}"
                                disabled required />
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
                                        {{ $data->nationality == $item->name ? 'selected' : '' }}
                                        >
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
                                    {{ $data->gender == 'Male' ? 'selected' : '' }}
                                    >
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
                        <label class="form-label" for="first-name-icon">Tracking ID</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <input type="text" name="remarks" id="remarks" class="form-control"
                                value="{{ $data->work_order_num }}" autocomplete="false">
                        </div>
                    </div>
                </div>
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
                        <label class="form-label" for="first-name-icon">Billing Cycle - {{$data->billing_cycle}}</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <select name="billing_cycle" id="billing_cycle" class="form-control">
                                <option value="1"
                                        {{ $data->billing_cycle == 1 ? 'selected' : '' }}

                                >1</option>
                                <option value="7"
                                        {{ $data->billing_cycle == 7 ? 'selected' : '' }}

                                >7</option>
                                <option value="17"
                                        {{ $data->billing_cycle == 17 ? 'selected' : '' }}

                                >17</option>
                                <option value="18"
                                        {{ $data->billing_cycle == 18 ? 'selected' : '' }}

                                >18</option>
                            </select>
                            {{-- <input type="date" name="billing_cycle" id="billing_cycle" class="form-control" --}}
                                {{-- value="{{ $data->bi }}" autocomplete="false" --}}
                                {{-- > --}}
                        </div>
                    </div>
                </div>

                <div class="col-8">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">5G Number</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <input type="text" name="reff_id" id="reff_id" class="form-control"
                                value="{{ $data->reff_id }}" autocomplete="false">
                        </div>
                    </div>
                </div>
                 <div class="col-12">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Account Status</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <select name="account_status" id="account_status" class="is_mnp form-control" >
                                <option value="Active" selected>Active</option>
                                <option value="Invalid">
                                    Invalid</option>
                                <option value="Cancel">Cancel</option>
                                <option value="Suspend">Suspend</option>
                                <option value="Prepaid">Prepaid</option>
                            </select>
                        </div>
                    </div>
                </div>
                 <div class="col-8">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Open Amount</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <input type="text" name="open_amount" id="open_amount" class="form-control"
                                 autocomplete="false">
                        </div>
                    </div>
                </div>
                {{-- <div class="col-8">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Remarks</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <input type="text" name="remarks" id="remarks" class="form-control"
                                value="{{ $data->remarks }}" autocomplete="false">
                        </div>
                    </div>

                </div> --}}
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
                    {{-- <div class="col-12">
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
                    </div> --}}
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
                    onclick="SavingActivationLead('{{ route('contract_id.hw') }}', 'MyRoleForm','{{ route('home') }}')">Submit</button>
                    @else
                    <button type="submit" class="btn btn-primary me-1"
                    onclick="SavingActivationLead('{{ route('proceed.mnp') }}', 'MyRoleForm','{{ route('home') }}')">Submit
                    For Pre Process</button>
                    @endif

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
