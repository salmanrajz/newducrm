@extends('layouts/contentLayoutMaster')

@section('title', 'MNP | P2P Leads')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection
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
                <input type="hidden" name="generic_id"
                    value="{{ $getfirst = empty($last)? 1 : $last->id }}">
                <input class="form-control " id="leadno"
                    value="{{ auth()->user()->agent_code .'-'. $getfirst .'-'. Carbon\Carbon::now()->format('M') .'-'.now()->year }}"
                    placeholder="Lead Number" type="text" disabled>
                <input class="form-control " id="inputSuccess3" name="leadnumber"
                    value="{{ auth()->user()->agent_code .'-'. $getfirst .'-'. Carbon\Carbon::now()->format('M') .'-'.now()->year }}"
                    placeholder="Lead Number" type="hidden">
                <input type="hidden" name="channel_type" id="type" value="{{ $type }}">
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
                                placeholder="Full Name (Exactly as Per Emirate ID)" required />
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Email</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <input type="text" id="first-name-icon" class="form-control" name="email"
                                placeholder="Email" required />
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Customer Contact #</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <input type="tel" maxlength="12"
                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                onkeypress="return isNumberKey(event) " id="first-name-icon" class="form-control"
                                name="contact_number" placeholder="9715XXXXXXXX" required />
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Product Type</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="map"></i></span>
                            <select name="lead_type" id="lead_type" class="is_mnp form-control" required >
                                <option value="MNP">MNP</option>
                                <option value="P2P">P2P</option>
                            </select> </div>
                    </div>
                </div>
                <div class="demo-inline-spacing" id="InlineRadioCheck" style="display: none;">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                            value="option1" checked />
                        <label class="form-check-label" for="inlineRadio1">Full Emirate ID #</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                            value="option2" />
                        <label class="form-check-label" for="inlineRadio2">Last 5 Digit #</label>
                    </div>
                </div>
                <div class="col-12" id="fullemirateid">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Emirate ID</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <input type="text" id="emirate_id" class="form-control" name="emirate_id"
                                placeholder="Full Emirate ID" required data-inputmask="'mask': '999-9999-9999999-9'"
                                placeholder="XXXXX-XXXXXXX-X" />
                        </div>
                    </div>
                </div>
                <div class="col-12" id="lastfive" style="display: none;">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Emirate ID</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <input type="text" id="emirate_id_last_five" class="form-control" name="emirate_id_last_five"
                                placeholder="Last 5 Emirate ID Digit" required data-inputmask="'mask': '9999-9'"
                                placeholder="XXXXX-XXXXXXX-X" />
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Nationality/Citizen</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="box"></i></span>
                            <select name="nationality" id="nationality" class="is_mnp form-control" required>
                                @foreach($country as $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
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
                            <select name="gender" id="gender" class="is_mnp form-control" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Language</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <select name="language" id="language" class="is_mnp form-control" required>
                                <option value="English">English</option>
                                <option value="Arabic" selected>Arabic</option>
                                <option value="Urdu/Hindi">Urdu/Hindi</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Date of Birth</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <input type="date" name="dob" id="dob" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Emirate Expiry</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <input type="date" name="emirate_expiry" id="emirate_expiry" class="form-control" required>
                        </div>
                    </div>
                </div>
                <h2>Delivery Address</h2>
                <div class="col-12">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Delivery Address</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="map"></i></span>
                            <input type="text" name="address" id="address" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Emirates</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="map"></i></span>
                            <select name="emirate" id="emirate" class="is_mnp form-control" required>
                                @foreach($emirate as $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select> </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Additional Documents</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="map"></i></span>
                            <select name="additional_docs_name" id="additional_docs_name" class="form-control" required>
                                <option value="Ejari">Ejari</option>
                                <option value="Tenancy contract">Tenancy contract</option>
                                <option value="Title deed (front side)">Title deed (front side)</option>
                                <option value="Salary Certificate">Salary Certificate (latest 3 months (min. salary of
                                    AED 2,500 with UAE based company name. Contact details, original company stamp on
                                    letterhead is required))</option>
                                <option value="Utility Bill">Utility Bill - latest 3 months (Electricity / Water /
                                    Internet or TV / landline / broadband bill)</option>
                                <option value="Labour Contract">Labour contract (pages with Name, nationality, Passport
                                    numbers)</option>
                            </select> </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Nearest Landmark (Optional)</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="map"></i></span>
                            <input type="text" name="nearest_landmark" id="nearest_landmark" class="form-control">
                        </div>
                    </div>
                </div>
                {{-- IMO --}}
                <div class="col-md-12 mb-1">
              <label class="form-label" for="select2-basic">Plans</label>
              <select name="plans" id="select2-basic2" class="is_mnp form-control select2 " required>
                                @foreach($plan as $item)
                                    <option value="{{ $item->id }}">{{ $item->plan_name }}</option>
                                @endforeach
                            </select>
            </div>
                {{-- <div class="col-12 col-md-12 row">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Plans</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>

                        </div>
                    </div>
                </div> --}}
                <div class="col-12">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Remarks</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <input type="text" name="remarks" id="remarks" class="form-control" value="Please Verify">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Emirate Front ID:</label>
                        <div class="input-group input-group-merge">
                            <input type="file" name="front_id" id="front_img" class="form-control" accept="image/*">
                            </h3>

                        </div>
                        <img id="myImg1" src="#" alt="your image" style="width:25%"
                            onerror="this.style.display='none'" />
                    </div>

                </div>
                <div class="col-12">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Emirate Back ID:</label>
                        <div class="input-group input-group-merge">
                            <input type="file" name="back_id" id="back_img" class="form-control" accept="image/*">

                            </h3>
                        </div>
                        <img id="myImg2" src="#" alt="your image" style="width:25%"
                            onerror="this.style.display='none'" />
                    </div>

                </div>
                <div class="col-12">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Additional Documents:</label>
                        <div class="input-group input-group-merge">
                            <input type="file" name="additional_docs_photo" id="additional_documents"
                                class="form-control" accept="image/*">

                            </h3>
                        </div>
                        <img id="myImg3" src="#" alt="your image" style="width:25%"
                            onerror="this.style.display='none'" />
                    </div>

                </div>

                {{-- IMO END --}}
                <div class="col-12">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                </div>
                <h3 class="text-center" id="loading_num3" style="display:none">
                    {{-- Please wait while system loading leads... --}}
                    <img src="{{ asset('images/loader/loader.gif') }}" alt="Loading"
                        class="img-fluid text-center offset-md-6" style="width:35px;">
                </h3>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary me-1"
                        onclick="SavingActivationLead('{{ route('submit.verification') }}', 'MyRoleForm','{{ route('home') }}')">Submit
                        For Verification</button>
                    {{-- </div> --}}
                    {{-- <div class="col-12"> --}}
                    {{-- <button type="submit" class="btn btn-primary me-1"
                        onclick="SavingActivationLead('{{ route('submit.proceed') }}', 'MyRoleForm','{{ route('home') }}')">Submit
                        For Proceed</button> --}}
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


@endsection<!-- Basic Floating Label Form section end -->
@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection
@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/custom.js')) }}"></script>
<!-- Page js files -->
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>

<script>
    $(":input").inputmask();

</script>
@endsection



