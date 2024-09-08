@extends('layouts/contentLayoutMaster')

@section('title', 'Fixed Lead')

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
                    <form class="form form-vertical" id="MyRoleForm" onsubmit="return false"
                    autocomplete="off"
                    >
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                            <input type="hidden" name="generic_id"
                                value="{{ $getfirst = empty($last)? 1 : $last->id }}">
                            <input class="form-control " id="leadno"
                                value="{{ auth()->user()->agent_code .'-'. $getfirst .'-'. Carbon\Carbon::now()->format('M') .'-'.now()->year }}"
                                placeholder="Lead Number" type="text" readonly>
                            <input class="form-control " id="inputSuccess3" name="leadnumber"
                                value="{{ auth()->user()->agent_code .'-'. $getfirst .'-'. Carbon\Carbon::now()->format('M') .'-'.now()->year }}"
                                placeholder="Lead Number" type="hidden">
                            <input type="hidden" name="channel_type" id="type" value="{{ $type }}">
                            <input type="hidden" name="lead_type" id="type" value="{{ $ptype }}">
                            {{-- <input type="hidden" name="loadinfo" id="loadinfo" value="{{route('CheckLogInfo')}}"> --}}
                            <!-- <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span> -->
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Log System ID</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                           {{-- @if ($message = Session::get('systemid')) --}}
                                           <input type="text" id="logsystemid" class="form-control" name="logsystemid"
                                           onchange="CheckSystemLog('{{route('CheckLogInfo')}}')"
                                           onkeypress="return isNumberKey(event) "
                                           autocomplete="off"
                                           {{-- readonly --}}
                                           />
                                           {{-- @endif --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 col-sm-6 col-xs-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Full Name</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="full_name" class="form-control" name="full_name"
                                            placeholder="Full Name (Exactly as Per Emirate ID)" required
                                            autocomplete="off"
                                           {{-- readonly --}}
                                            />
                                    </div>
                                </div>
                            </div>

                            <div class="col-3 col-sm-6 col-xs-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Users Contact #</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input
                                        type="tel" maxlength="12"
                                        id="contact_number"
                                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                            onkeypress="return isNumberKey(event) " id="first-name-icon"
                                            class="form-control" name="contact_number" placeholder="052XXXXXX"
                                            autocomplete="off"
                                            required
                                           {{-- readonly --}}

                                            />
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 col-sm-6 col-xs-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Users Alternative Contact #</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="tel" maxlength="10"
                                        id="alt_contact_number"
autocomplete="off"
                                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                            onkeypress="return isNumberKey(event) "
                                            id="first-name-icon"
                                            class="form-control" name="alternative_number" placeholder="052XXXXXX"
                                            required />
                                    </div>
                                </div>
                            </div>
                             <div class="col-3 col-sm-6 col-xs-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Email</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="first-name-icon" class="form-control" name="email"
                                            placeholder="Email" required
                                            autocomplete="off"
                                            />
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h6>FILLABLE IF FNE LEAD</h6>
                            <div class="col-4 col-sm-6 col-xs-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Account ID</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="account_id" class="form-control" name="account_id"
                                            placeholder="Emirate ID" required
                                            autocomplete="off"
                                        onkeypress="return isNumberKeyDot(event) "
                                           {{-- readonly --}}

                                            {{-- data-inputmask="'mask': '999-9999-9999999-9'" --}}
                                            {{-- placeholder="XXXXX-XXXXXXX-X"  --}}
                                            />
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 col-sm-6 col-xs-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Customer 5G Number:</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input
                                        type="tel" maxlength="12"
                                        class="form-control" name="fiveg_number" placeholder="052XXXXXX"
                                            required
                                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                            onkeypress="return isNumberKey(event) "
                                            autocomplete="off"
                                            id="fiveg_number"
                                           {{-- readonly --}}



                                            />
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 col-sm-6 col-xs-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Customer 5G Expiry:</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="date"  id="expiry"
                                            class="form-control" name="expiry" placeholder="052XXXXXX"
                                            autocomplete="off"
                                           {{-- readonly --}}
                                            />
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 hidden d-none">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Lead Type</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="box"></i></span>
                                        <select name="leadtype" id="leadtype" class="form-control"
                                            required
                                            onchange="CheckFNEType()"
                                            >
                                            <option value="FNE" selected>FNE</option>
                                            <option value="HomeWifi">HomeWifi</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                             <div class="col-2 hidden d-none">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">FNE Reff/Base</label>
                                    <div class="input-group input-group-merge"  style="border: 2px solid red;border-radius: 8px;">
                                        <span class="input-group-text"><i data-feather="box"></i></span>
                                        <select name="reff_base" id="reff_base" class="form-control"

                                            >
                                            <option value="Refferal">Refferal</option>
                                            <option value="Base">Base</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>


                            <div class="container row" id="jamgae" style="display: none">

                            <div class="col-3 col-sm-6 col-xs-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Emirate ID</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="emirate_id" class="form-control" name="emirate_id"
                                            placeholder="Emirate ID"
                                            data-inputmask="'mask': '999-9999-9999999-9'"
                                            placeholder="XXXXX-XXXXXXX-X"
                                            autocomplete="off"/>
                                    </div>
                                </div>
                            </div>
                        <div class="col-3 col-sm-6 col-xs-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Date of Birth</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="date" name="dob" id="dob" class="form-control"
                                        autocomplete="off"
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 col-sm-6 col-xs-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Emirate Expiry</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="date" name="emirate_expiry" id="emirate_expiry"
                                            class="form-control"
                                            autocomplete="off"
                                            >
                                    </div>
                                </div>
                            </div>

                            <div class="col-3 col-sm-6 col-xs-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Nationality/Citizen</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="box"></i></span>
                                        <select name="nationality" id="nationality" class="is_mnp form-control"
                                            >
                                            @foreach($country as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            </div>



                            <div class="col-3 col-sm-6 col-xs-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Gender</label>
                                    <div class="input-group input-group-merge"  >
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <select name="gender" id="gender" class="is_mnp form-control" required>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 col-sm-6 col-xs-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Language</label>
                                    <div class="input-group input-group-merge"  >
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <select name="language" id="language" class="is_mnp form-control" required>
                                            <option value="English">English</option>
                                            <option value="Arabic" selected>Arabic</option>
                                            <option value="Urdu/Hindi">Urdu/Hindi</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <h2>Full Address</h2>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Google Location Url:</label>
                                    <div class="input-group input-group-merge"  style="border: 2px solid red;border-radius: 8px;">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text"
                                            class="form-control" name="google_location" placeholder="https://maps.google.com"
                                            required
                                            onkeyup="check_location_url()"
                                            autocomplete="off"
                                            id="add_location"
                                            />
                                    </div>
                                </div>
                            </div>
                                    <div id="location_error"></div>

                            <div class="col-6">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Location Latitude:</label>
                                    <div class="input-group input-group-merge" >
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text"
                                            class="form-control" name="lat" placeholder="https://maps.google.com"
                                            required
                                            id="lat"
                                            readonly

                                            />
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Location Langitude:</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text"
                                            class="form-control" name="lng" placeholder="https://maps.google.com"
                                            required
                                            id="lng"
                                            readonly
                                            />
                                    </div>
                                    <input type="hidden" id="lat_final" name="lat_final">
                                    <input type="hidden" id="lng_final" name="lng_final">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Building Name:</label>
                                    <div class="input-group input-group-merge"  style="border: 2px solid red;border-radius: 8px;">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="full_name" class="form-control" name="building"
                                            placeholder="Building Name" required
                                            autocomplete="off"
                                            />
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Unit Name:</label>
                                    <div class="input-group input-group-merge"  style="border: 2px solid red;border-radius: 8px;">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="full_name" class="form-control" name="unit"
                                            placeholder="Unit Name" required
                                            autocomplete="off"
                                            />
                                    </div>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Delivery Address</label>
                                    <div class="input-group input-group-merge"  style="border: 2px solid red;border-radius: 8px;">
                                        <span class="input-group-text"><i data-feather="map"></i></span>
                                        <input type="text" name="address" id="address" class="form-control" required
                                        autocomplete="off"
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="col-4 col-sm-6 col-xs-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Emirates</label>
                                    <div class="input-group input-group-merge"  style="border: 2px solid red;border-radius: 8px;">
                                        <span class="input-group-text"><i data-feather="map"></i></span>
                                        <select name="emirate" id="emirate" class="is_mnp form-control" required>
                                                @foreach($emirate as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                                @endforeach
                                        </select> </div>
                                </div>
                            </div>
                            <div class="col-6 hidden d-none">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Nearest Landmark (Optional)</label>
                                    <div class="input-group input-group-merge"  style="border: 2px solid red;border-radius: 8px;">
                                        <span class="input-group-text"><i data-feather="map"></i></span>
                                        <input type="text" name="nearest_landmark" id="nearest_landmark"
                                            class="form-control"
                                            autocomplete="off"
                                            >
                                    </div>
                                </div>
                            </div>
                            {{-- IMO --}}
                            {{-- {{Session::get('status')}} --}}
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">FIXED Plans</label>
                                    <div class="input-group input-group-merge"  style="border: 2px solid red;border-radius: 8px;">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <select name="plans" id="plans" class="is_mnp form-control" required >
                                            {{-- <optgroup label="HomeWifi">
                                            @foreach($plan as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </optgroup> --}}
                                            <optgroup label="FIXED FNE">
                                                <option value="6"
                                                {{Session::get('status') == 'NewFNELead' ? 'selected' : ''}}
                                                >
                                                DU 389 Triple Play - (Du Home starter 389 with 6 months discount 30 % +5% VAT monthly for 24 months)
                                                </option>
                                                <option value="7"
                                                {{Session::get('status') == 'UpgradeFNELead' ? 'selected' : ''}}
                                                >
                                                DU 409 Upgrade - (Du Home starter 389 with 6 months discount 30 % +5% VAT monthly for 24 months)
                                                </option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 hidden d-none" id="is_old" >
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">is old??</label>
                                    <div class="input-group input-group-merge"  style="border: 2px solid red;border-radius: 8px;">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <select name="is_old" id="is_old" class=" form-control" >
                                            <option value="">Select</option>
                                           <option value="0">New</option>
                                           <option value="1">Old</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 hidden d-none">
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
                                <button type="submit" class="btn btn-success me-1"
                                    onclick="SavingActivationLeadFNE('{{ route('FixedSubmitRFS') }}', 'MyRoleForm','{{ route('FNEdashboardEcommerce') }}','Check RFS Only')">Check RFS Only</button>
                                <button type="submit" class="btn btn-primary me-1"
                                    onclick="SavingActivationLeadFNE('{{ route('FixedSubmitRFS') }}', 'MyRoleForm','{{ route('FNEdashboardEcommerce') }}','Check RFS & Verify')">Check RFS & Verify</button>
                            {{-- </div> --}}
                            {{-- <div class="col-12"> --}}
                                <button type="submit" class="btn btn-danger me-1"
                                    onclick="SavingActivationLeadFNE('{{ route('FixedSubmitRFS') }}', 'MyRoleForm','{{ route('FNEdashboardEcommerce') }}','Check RFS & Close')">Check RFS & Close</button>
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
       function isNumberKeyDot(evt)
       {
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
       }
    //    setTimeout(() => {

    //        var load = $("#loadinfo").val();
    //        CheckSystemLog(load);
    //    }, 1000);
</script>
@endsection
