@extends('layouts/contentLayoutMaster')
{{-- <meta http-equiv="refresh" content="2000"> --}}

@section('title', 'Call Log')

@section('content')
@section('vendor-style')
  <link rel="stylesheet" href="{{ asset(mix('fonts/font-awesome/css/font-awesome.min.css')) }}">
@endsection
<!-- Basic Horizontal form layout section start -->

<!-- Basic Horizontal form layout section end -->
@inject('provider', 'App\Http\Controllers\FunctionController')

<!-- Basic Vertical form layout section start -->
<section id="basic-vertical-layouts">
    <button class="btn-success btn mb-3" onclick="GetNewNumber({{auth()->user()->id}},'{{route('GiveMeNewNumber')}}')">Assign New Numbers</button>
    <button class="btn-success btn mb-3" onclick="ClearDuplicate({{auth()->user()->id}},'{{route('ClearDuplicate')}}')">Clear Duplicate</button>
    <div class="row">

        <div class="row items-push mb-4">

            <div class="col-xl-4 col-sm-2 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-primary me-2">
                    <img src="{{asset('images/du-icons/pending.png')}}" alt="Pending" style="height:50px">
                  {{-- <div class="avatar-content">
                    <i data-feather="trending-up" class="avatar-icon"></i>
                  </div> --}}
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">
                    {{-- 0 --}}
                                {{$provider::MyWhatsAppCount('Daily',auth()->user()->id)}}

                  </h4>
                  <p class="card-text font-small-3 mb-0">
                                {{ __('Connect Calls (Today)') }}</dd>

                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-sm-2 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-primary me-2">
                    <img src="{{asset('images/du-icons/pending.png')}}" alt="Pending" style="height:50px">
                  {{-- <div class="avatar-content">
                    <i data-feather="trending-up" class="avatar-icon"></i>
                  </div> --}}
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">
                    {{-- 0 --}}
                                {{$provider::MyWhatsAppCount('Weekly',auth()->user()->id)}}

                                {{-- {{$provider::MyWhatsAppCount('Follow up')}} --}}

                  </h4>
                  <p class="card-text font-small-3 mb-0">
                                {{ __('Connected Calls (Weekly)') }}</dd>

                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-sm-2 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-primary me-2">
                    <img src="{{asset('images/du-icons/pending.png')}}" alt="Pending" style="height:50px">
                  {{-- <div class="avatar-content">
                    <i data-feather="trending-up" class="avatar-icon"></i>
                  </div> --}}
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">
                    {{-- 0 --}}
                                {{-- {{$provider::MyWhatsAppCount('Follow up')}} --}}
                                {{$provider::MyWhatsAppCount('Monthly',auth()->user()->id)}}

                  </h4>
                  <p class="card-text font-small-3 mb-0">
                                {{ __('Connected Calls (Monthly)') }}</dd>

                  </p>
                </div>
              </div>
            </div>

</div>

<div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>

                            @foreach($errors->all() as $error)
                            {{ $error }}<br />
                            @endforeach
                        </div>
                        @endif

                            {{-- foreach --}}
                            <!-- Plan name -->
                            <div class="row">

                                <label for="localminutes" class="control-label col-md-3 col-sm-12 col-xs-12">
                                    Call Log Number</label>

                                <label for="localminutes" class="control-label col-md-3 col-sm-12 col-xs-12">
                                    Language</label>
                                <label for="localminutes" class="control-label col-md-2 col-sm-12 col-xs-12">
                                    Status</label>
                                <label for="localminutes" class="control-label col-md-2 col-sm-12 col-xs-12" id="RemarksLabel" style="display:none;">
                                    Remarks</label>
                                <label for="localminutes" class="control-label col-md-2 col-sm-12 col-xs-12">
                                    Submit Btn</label>
                                    {{-- <label for="localminutes" class="control-label col-md-6 col-sm-12 col-xs-12">
                                        Remarks</label> --}}
                                    {{-- <label for="localminutes" class="control-label col-md-6 col-sm-12 col-xs-12">
                                        Language</label> --}}
                                    </div>
                            {{-- @for($i = 0; $i<=300 ; $i++) --}}
                            @foreach ($k as $i => $item)
                                    {{-- {{$item->number}} --}}
                             <form class="form-horizontal form-label-left input_mask" method="post"
                                autocomplete="off" id="call_log_{{$i}}" onsubmit="return false">
                            @csrf
                            <div class="form-group row mb-2">


                                <div class="col-md-3 col-sm-4 col-xs-12 form-group has-feedback">
                                    <p>
                                        {{-- {{substr_replace($item->number,"0",0,3)}} --}}
                                        {{-- {{substr_replace($item->,"0",0,3)}} --}}
                                        {{$item->number}}
                                            <i class="fab fa-whatsapp" style="margin-left:20px" data-bs-toggle="modal" data-bs-target="#exampleModal{{$item->id}}"></i>
                                    </p>
                                    <input class="form-control hidden d-none" placeholder="Customer Number i.e 0551234567" name="number"
                                            maxlength="10" required type="tel"
                                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                            onkeypress="return isNumberKey(event)" id="number"
                                            {{-- value="{{substr_replace($item->number,"0",0,3)}}"  --}}
                                            value="{{$item->number}}"
                                            />
                                            <small>
                                                {{$item->account_id}}
                                            </small>
                                </div>
                                <div class="modal fade " id="exampleModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content text-center">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">WhatsApp Message</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <button class="btn btn-success" onclick="MyWhatsApp('{{$item->number}}','199','{{route('my.whatsapp.message')}}')">199 Wifi Plus WhatsApp Message</button>
                                                <button class="btn btn-danger" onclick="MyWhatsApp('{{$item->number}}','299','{{route('my.whatsapp.message')}}')">299 Wifi Entertainment WhatsApp Message</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="number_id" value="{{$item->number_id}}">
                                <input type="hidden" name="userid" value="{{auth()->user()->id}}">
                                    <div class="col-md-3"  id="language">


                                    <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback" >
                                    <select name="language_" id="language_{{$i}}" class="form-control" required>
                                                <option value="English">English</option>
                                                <option value="Arabic">Arabic</option>
                                                <option value="Urdu/Hindi">Urdu - Hindi</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class=" col-md-2" >
                                        <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                            <select name="status" class="form-control" id="remarks_call_log_{{$i}}" onchange="change_feedback({{$i}})">
                                                <option value="No Answer">No Answer</option>
                                                <option value="Switched Off">Switched Off</option>
                                                <option value="Line Busy">Line Busy</option>
                                                <option value="Invalid Number / Not a working Number / Number not available">Invalid Number / Not a working Number / Number not available</option>
                                                <option value="Call Drop">Call Drop</option>
                                                <option value="Customer Disconnecting the Call">Customer Disconnecting the Call</option>
                                                <option value="Not Interested in Postpaid">Not Interested in Postpaid</option>
                                                <option value="Not Interested in 5G">Not Interested in 5G</option>
                                                <option value="Interested Follow-up">Interested Follow-up</option>
                                                <option value="DND">DND</option>
                                                <option value="Migrated">Migrated</option>
                                                <option value="Sale Closed">Sale Closed</option>
                                                <option value="Low Usage">Low Usage</option>
                                                <option value="Happy with Prepaid">Happy with Prepaid</option>
                                                <option value="Using Recharge Bundle Offer">Using Recharge Bundle Offer</option>
                                                <option value="Benefits not good">Benefits not good</option>
                                                <option value="Leaving UAE">Leaving UAE</option>
                                                <option value="Bad Experience with Du">Bad Experience with Du</option>
                                                <option value="Network Issue">Network Issue</option>
                                                <option value="Call Back - Customer Busy">Call Back - Customer Busy</option>
                                                <option value="Not the Owner">Not the Owner</option>
                                                <option value="Not Eligible">Not Eligible</option>
                                                <option value="Out of Country">Out of Country</option>
                                                <option value="Vacation">Vacation</option>
                                                <option value="Already using ETC Postpaid Plan">Already using ETC Postpaid Plan</option>
                                                <option value="Already using Du Postpaid Plan">Already using Du Postpaid Plan</option>
                                                <option value="Using Corporate / Company Plan">Using Corporate / Company Plan</option>
                                                <option value="Others">Others</option>
                                                <option value="No Good Offers in Du">No Good Offers in Du</option>
                                                <option value="Happy with ETC / Virgin">Happy with ETC / Virgin</option>
                                                <option value="Already Have 5G">Already Have 5G</option>
                                                <option value="Wrong Contact Number">Wrong Contact Number</option>
                                                <option value="Using Etisalat Home Wifi">Using Etisalat Home Wifi</option>
                                                <option value="Already Cancelled 4G ">Already Cancelled 4G </option>
                                                <option value="Arabic">Arabic</option>
                                                <option value="Wants Cancel 4G">Wants Cancel 4G</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class=" col-md-2" id="other_{{$i}}" style="display:none;">
                                        <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                            <input type="text" name="other_remarks" id="other_remarks_{{$i}}" class="form-control" placeholder="Other Remarks">
                                            {{-- <textarea name="other_remarks_{{$i}}" id="other_remarks" cols="30" rows="10" class="form-control"></textarea> --}}
                                        </div>
                                    </div>

                                    <!--  #7-->
                                    {{-- <div class="ln_solid"></div> --}}
                                    {{-- <div class="form-group"> --}}
                                    <div class="col-md-2 col-sm-12 col-xs-12 col-md-offset-3">
                                    <!-- <button type="button" class="btn btn-primary">Can cel</button> -->
                                    {{-- <button class="btn btn-primary" type="reset">Reset</button> --}}
                                    @if ($item->status != '')
                                    <input type="button" class="btn btn-info" name="Updated" id="btn_{{$item->id}}"  value="Updated">
                                    @else
                                <input type="submit" class="btn btn-success" name="upload" id="btn_{{$item->id}}" onclick="CallLogForm('{{$item->id}}','call_log_{{$i}}','{{route('number.feedback.submit')}}')" value="Update">

                                    @endif
                                </div>
                            {{-- </div> --}}
                            </div>
                        </form>
                            @endforeach
                            {{ $k->links() }}
{{-- <script>
    $('.pagination a').on('click', function (event) {
    event.preventDefault();
    if ($(this).attr('href') != '#') {
        $('#ajaxContent').load($(this).attr('href'));
    }
});
</script> --}}

                            {{-- @endfor --}}


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
@endsection
