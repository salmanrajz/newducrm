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
@inject('provider', 'App\Http\Controllers\FunctionController')
@inject('NumAs', 'App\Http\Controllers\NumberAssigner')
        <div class="row items-push mb-4">

            <div class="col-xl-4 col-sm-2 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-primary me-2">
                    {{-- <img src="{{asset('images/du-icons/pending.png')}}" alt="Pending" style="height:50px"> --}}
                  {{-- <div class="avatar-content">
                    <i data-feather="trending-up" class="avatar-icon"></i>
                  </div> --}}
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">
                                {{$NumAs::MyCount4g('5G_EXPIRED')}}

                  </h4>
                  <p class="card-text font-small-3 mb-0">
                                {{ __('Data Assigned (Today)') }}</dd>

                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-sm-2 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-primary me-2">
                    {{-- <img src="{{asset('images/du-icons/pending.png')}}" alt="Pending" style="height:50px"> --}}
                  {{-- <div class="avatar-content">
                    <i data-feather="trending-up" class="avatar-icon"></i>
                  </div> --}}
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">
                    {{-- 0 --}}
                                {{$provider::MyWhatsAppCount('Daily',auth()->user()->id,'5G_EXPIRED')}}

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
                    {{-- <img src="{{asset('images/du-icons/pending.png')}}" alt="Pending" style="height:50px"> --}}
                  {{-- <div class="avatar-content">
                    <i data-feather="trending-up" class="avatar-icon"></i>
                  </div> --}}
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">
                    {{-- 0 --}}
                                {{$provider::MyWhatsAppCount('Weekly',auth()->user()->id,'5G_EXPIRED')}}

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
                    {{-- <img src="{{asset('images/du-icons/pending.png')}}" alt="Pending" style="height:50px"> --}}
                  {{-- <div class="avatar-content">
                    <i data-feather="trending-up" class="avatar-icon"></i>
                  </div> --}}
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">
                    {{-- 0 --}}
                                {{-- {{$provider::MyWhatsAppCount('Follow up')}} --}}
                                {{$provider::MyWhatsAppCount('Monthly',auth()->user()->id,'5G_EXPIRED')}}

                  </h4>
                  <p class="card-text font-small-3 mb-0">
                                {{ __('Connected Calls (Monthly)') }}</dd>

                  </p>
                </div>
              </div>
            </div>

</div>
<div class="card">
                    <table class="table table-responsive">
    <thead>
        <tr>
            <td>S#</td>
            <td>SystemID</td>
            <td>Name</td>
            <td>CustomerNum</td>
            <td>Act Date:</td>
            <td>Nationality</td>
            <td>Remarks</td>

        </tr>
    </thead>
    <tbody>

        @foreach ($k as $i => $item)
        <form class="form-horizontal form-label-left input_mask" method="post"
        autocomplete="off" id="call_log_{{$i}}" onsubmit="return false">
        @csrf
        <tr>
            <td>
                {{++$i}}
            </td>
            <td>
                {{$item->num_id}}
            </td>
            <td>
                {{$item->cname}}
            </td>
            <td>
                {{$item->number}}
            </td>

            <td>
                {{$item->activation_date}}
            </td>
            <td>
                {{$item->nationality}}
            </td>

            <td>
                {{$item->status}}
            </td>

        </tr>
    </form>
        @endforeach
    {{ $k->links() }}

    </tbody>
</table>

<div class="col-lg-12 hidden d-none">
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
                                        {{-- {{$item->number}} --}}
                                        @php
                                                $str_to_replace = '0';

        // $input_str = '9715088880Z9714088880Z8088880Z';

        echo $l =  $output_str = $str_to_replace . substr(
                $item->number,
                3
            );
                                        @endphp
                                            <i class="fab fa-whatsapp" style="margin-left:20px" data-bs-toggle="modal" data-bs-target="#exampleModal{{$item->id}}"></i>
                                    </p>
                                    <input class="form-control hidden d-none" placeholder="Customer Number i.e 0551234567" name="number"
                                            maxlength="10" required type="tel"
                                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                            onkeypress="return isNumberKey(event)" id="number"
                                            {{-- value="{{substr_replace($item->number,"0",0,3)}}"  --}}
                                            value="{{$item->number}}"
                                            />
                                            {{-- <small style="color:red">
                                                Age: {{$item->account_id}} |
                                            </small> --}}
                                            <p>

                                            <small style="color:red">
                                               Cname: {{$item->cname}}
                                            </small>
                                            <small style="color:red">
                                                   Act Date: {{$item->activation_date}} -


                                            </small>
                                            </p>
                                            <p>

                                            <small style="color:red">
                                               5G ACCOUNT: {{$item->account_id}} -
                                            </small>
                                            <small style="color:red">
                                               Nationality: {{$item->nationality}} -
                                            </small>
                                        </p>
                                            <p>

                                            <small style="color:red">
                                            Plan Name: {{$item->plan_name}} -
                                            </small>
                                            </p>

                                            {{-- <small style="color:orange">
                                               Nation: {{$item->nationality}}
                                            </small> --}}

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
                                                {{-- <button class="btn btn-success" onclick="MyWhatsApp('{{$item->number}}','199','{{route('my.whatsapp.message')}}')">199 Wifi Plus WhatsApp Message</button> --}}
                                                {{-- <button class="btn btn-danger" onclick="MyWhatsApp('{{$item->number}}','299','{{route('my.whatsapp.message')}}')">299 Wifi Entertainment WhatsApp Message</button> --}}
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
                                                <option value="Hang Up">Hang Up</option>
                                                <option value="Not Interested">Not Interested</option>
                                                <option value="Switch Off">Switch Off</option>
                                                <option value="Call Later">Call Later</option>
                                                <option value="Follow up">Follow up</option>
                                                <option value="Lead">Lead</option>
                                                <option value="Already Using DU 5G HW">Already Using DU 5G HW</option>
                                                <option value="Already Using Etisalat 5G HW">Already Using Etisalat 5G HW</option>
                                                <option value="Invalid">Invalid</option>
                                                <option value="Already Postpaid">Already Postpaid</option>
                                                <option value="Arabic">Arabic</option>
                                                <option value="DNC">Hard DNC</option>
                                                <option value="Soft DNC">Soft DNC</option>
                                                <option value="Call Drop By Customer">Call Drop By Customer</option>
                                                <option value="Line Busy">Line Busy</option>
                                                <option value="Customer Disconnecting the Call">Customer Disconnecting the Call</option>
                                                <option value="Happy with Prepaid">Happy with Prepaid</option>
                                                <option value="Bad Experience with Du">Bad Experience with Du</option>
                                                <option value="Not the Owner">Not the Owner</option>
                                                <option value="Going on Vacation">Going on Vacation</option>
                                                <option value="Low Usage">Low Usage</option>
                                                <option value="Leaving Country">Leaving Country</option>
                                                <option value="Using Etisalat Prepaid">Using Etisalat Prepaid</option>
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
    </div>
</div>
@endsection

@section('script')

@endsection
