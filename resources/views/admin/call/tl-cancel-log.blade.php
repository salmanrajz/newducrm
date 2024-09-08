@extends('layouts/contentLayoutMaster')

@section('title', 'Call Log')

@section('content')
@section('vendor-style')
  <link rel="stylesheet" href="{{ asset(mix('fonts/font-awesome/css/font-awesome.min.css')) }}">
@endsection
<!-- Basic Horizontal form layout section start -->

<!-- Basic Horizontal form layout section end -->

<!-- Basic Vertical form layout section start -->
<section id="basic-vertical-layouts">
    <div class="row">


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
                                    TL OLD Remarks</label>
                                <label for="localminutes" class="control-label col-md-2 col-sm-12 col-xs-12">
                                    TL NEW Remarks</label>
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
                                        {{$item->number}} - {{$item->name}}
                                            <i class="fab fa-whatsapp" style="margin-left:20px" data-bs-toggle="modal" data-bs-target="#exampleModal{{$item->id}}"></i>
                                    </p>
                                    <input class="form-control hidden d-none" placeholder="Customer Number i.e 0551234567" name="number"
                                            maxlength="10" required type="tel"
                                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                            onkeypress="return isNumberKey(event)" id="number"
                                            value="{{substr_replace($item->number,"0",0,3)}}" />
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
                                                <option value="{{$item->remarks_by_tl}}">{{$item->remarks_by_tl}}</option>
                                                {{-- <option value="Arabic">Arabic</option> --}}
                                                {{-- <option value="Urdu/Hindi">Urdu - Hindi</option> --}}
                                            </select>
                                        </div>

                                    </div>
                                    <div class=" col-md-2" >
                                        <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                                            <select name="status" class="form-control" id="remarks_call_log_{{$i}}" onchange="change_feedback({{$i}})">
                                                <option value="No Answer">No Answer</option>
                                                <option value="No Need">No Need</option>
                                                <option value="Not Interested">Not Interested</option>
                                                <option value="Switch Off">Switch Off</option>
                                                <option value="Call Later">Call Later</option>
                                                <option value="Follow up">Follow up</option>
                                                <option value="Lead">Lead</option>
                                                <option value="Already Postpaid">Already Postpaid</option>
                                                <option value="DNC">DNC</option>
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
                                    {{-- @if ($item->status != '') --}}
                                    {{-- <input type="button" class="btn btn-info" name="Updated" id="btn_{{$item->id}}"  value="Updated"> --}}
                                    {{-- @else --}}
                                <input type="submit" class="btn btn-success" name="upload" id="btn_{{$item->id}}" onclick="CallLogForm('{{$item->id}}','call_log_{{$i}}','{{route('number.feedback.submit.tl')}}')" value="Update">

                                    {{-- @endif --}}
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
