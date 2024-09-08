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
    <button class="btn-success btn mb-3"
        onclick="GetNewNumber({{auth()->user()->id}},'{{route('GiveMeNewNumber')}}')">Assign New Numbers</button>
    <button class="btn-success btn mb-3"
        onclick="ClearDuplicate({{auth()->user()->id}},'{{route('ClearDuplicate')}}')">Clear Duplicate</button>
    <div class="row">
        <div class="col-sm-12 col-xl-12">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">


                        <!-- Plan name -->
                        <div class="row">

                            <label for="localminutes" class="control-label col-md-3 col-sm-12 col-xs-12">
                                Call Log Number
                            @php


                            @endphp

                            </label>

                            <label for="localminutes" class="control-label col-md-3 col-sm-12 col-xs-12">
                                Language</label>
                            <label for="localminutes" class="control-label col-md-2 col-sm-12 col-xs-12">
                                Status</label>
                            <label for="localminutes" class="control-label col-md-2 col-sm-12 col-xs-12"
                                id="RemarksLabel" style="display:none;">
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
                        <form class="form-horizontal form-label-left input_mask" method="post" autocomplete="off"
                            id="call_log_{{$i}}" onsubmit="return false">
                            @csrf
                            <div class="form-group row mb-2">
                                <div class="col-md-3 col-sm-4 col-xs-12 form-group has-feedback">
                                    <p>
                                        {{-- {{substr_replace($item->number,"0",0,3)}} --}}
                                        {{-- {{substr_replace($item->,"0",0,3)}} --}}
                                        {{$item->num_id}}
                                            {{-- <i class="fab fa-whatsapp" style="margin-left:20px" data-bs-toggle="modal" data-bs-target="#exampleModal{{$item->id}}"></i> --}}
                                    </p>
                                    <input class="form-control hidden d-none" placeholder="Customer Number i.e 0551234567" name="number"
                                            maxlength="10" required type="tel"
                                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                            onkeypress="return isNumberKey(event)" id="number"
                                            {{-- value="{{substr_replace($item->number,"0",0,3)}}"  --}}
                                            value="{{$item->num_id}}"
                                            />

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
                    <optgroup label="Usefull Disp">
                        <option value="TTS">Transfer to Sir Salman</option>
                        <option value="No Answer">No Answer</option>
                            <option value="Hang Up">Hang Up</option>
                            <option value="Not Interested">Not Interested</option>
                            <option value="Switch Off">Switch Off</option>
                            <option value="Call Later">Call Later</option>
                            <option value="Follow up">Follow up</option>
                            <option value="Follow up 5G">Follow 5G</option>
                            <option value="Invalid">Invalid</option>
                            <option value="Arabic">Arabic</option>
                            <option value="Line Busy">Line Busy</option>
                    </optgroup>
                    <optgroup label="HW Option">
                        <option value="HWPlus">HW PLUS</option>
                        <option value="HWEnt">HW ENT</option>
                        <option value="HWGaming">HW Gaming</option>
                    </optgroup>
                    <optgroup label="DNCR OPTION">
                        <option value="DNC">Hard DNC</option>
                        <option value="DNC">Soft DNC</option>
                    </optgroup>
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
                            </div>
                        </form>
                        @endforeach



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection
