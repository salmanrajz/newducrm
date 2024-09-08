@extends('layouts/contentLayoutMaster')

@section('title', 'Home Wifi Lead')

@section('content')
<!-- Basic Horizontal form layout section start -->

<!-- Basic Horizontal form layout section end -->

<!-- Basic Vertical form layout section start -->
<section id="basic-vertical-layouts">
    <div class="row">

        <div class="col-md-12 col-12">
            <div class="card">

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
                            <input type="hidden" name="lead_type" id="type" value="{{ $ptype }}">
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
                                        <input type="tel" maxlength="10"
                                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                            onkeypress="return isNumberKey(event) " id="first-name-icon"
                                            class="form-control" name="contact_number" placeholder="052XXXXXX"
                                            required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Customer Alternative Contact #</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="tel" maxlength="10"
                                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                            onkeypress="return isNumberKey(event) " id="first-name-icon"
                                            class="form-control" name="alternative_number" placeholder="052XXXXXX"
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
                                            placeholder="Emirate ID" required
                                            data-inputmask="'mask': '999-9999-9999999-9'"
                                            placeholder="XXXXX-XXXXXXX-X" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Nationality/Citizen</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="box"></i></span>
                                        <select name="nationality" id="nationality" class="is_mnp form-control"
                                            required>
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
                                        <input type="date" name="emirate_expiry" id="emirate_expiry"
                                            class="form-control" required>
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
                            <div class="col-6">
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
                            <div class="col-6">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Nearest Landmark (Optional)</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="map"></i></span>
                                        <input type="text" name="nearest_landmark" id="nearest_landmark"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            {{-- IMO --}}
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Home Wifi Plans</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <select name="plans" id="plans" class="is_mnp form-control" required onchange="MyPlanFNE()">
                                            @foreach($plan as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12" id="is_old" >
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">is old??</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <select name="is_old" id="is_old" class=" form-control" >
                                            <option value="">Select</option>
                                           <option value="0">New</option>
                                           <option value="1">Old</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12" id="fne_req_box" style="display: none">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">FNE Request #</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <select name="fne_req" id="fne_req" class="is_mnp form-control" >
                                            <option value="">Select</option>
                                            @foreach($fne_data as $item)
                                                <option value="{{ $item->id }}">{{ $item->id }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Closed By</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <select name="shared_with" id="shared_with" class="is_mnp form-control" >
                                            <option value="">Select Team Leader</option>
                                            @foreach($tl as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Remarks</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                       <input type="text" name="remarks" id="remarks" class="form-control" value="Please Verify">
                                    </div>
                                </div>
                            </div>

                            {{-- IMO END --}}
                            <div class="col-12">
                                <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary me-1"
                                    onclick="SavingActivationLead('{{ route('HomeWifiSubmit') }}', 'MyRoleForm','{{ route('wifi.leads') }}')">Submit</button>
                                <button type="submit" class="btn btn-success me-1"
                                    onclick="SavingActivationLead('{{ route('HomeWifiSubmitWhatsApp') }}', 'MyRoleForm','{{ route('wifi.leads') }}')">Verify On WhatsApp</button>
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
@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/custom.js')) }}"></script>
<!-- Page js files -->
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script>
    $(":input").inputmask();

</script>
@endsection
