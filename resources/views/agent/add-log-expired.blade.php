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
                    <table class="table table-responsive">
    <thead>
        <tr>
            <td>S#</td>
            <td>SystemID</td>
            <td>Name</td>
            <td>Act Date:</td>
            <td>Nationality</td>
            <td>Remarks</td>
            <td>
                Action
            </td>
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
                {{$item->activation_date}}
            </td>
            <td>
                {{$item->nationality}}
            </td>

            <td>
                <input type="hidden" id="systemid{{$i}}" name="systemid" value="{{$item->system_id}}">
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
                            {{-- <option value="Already Using DU 5G HW">Already Using DU 5G HW</option> --}}
                            {{-- <option value="Already Using Etisalat 5G HW">Already Using Etisalat 5G HW</option> --}}
                            <option value="Invalid">Invalid</option>
                            {{-- <option value="Already Postpaid">Already Postpaid</option> --}}
                            <option value="Arabic">Arabic</option>
                            {{-- <option value="Call Drop By Customer">Call Drop By Customer</option> --}}
                            <option value="Line Busy">Line Busy</option>
                    </optgroup>
                    {{-- <optgroup label="HW Option">
                        <option value="NewPlus">NEW HW PLUS</option>
                        <option value="NewHWEnt">NEW HW ENT 299</option>
                        <option value="UpgradeHWEnt">UPGRADE HW ENT 299</option>
                    </optgroup> --}}
                    <optgroup label="FNE Option">
                        <option value="NewFNELead">NEW FNE</option>
                        <option value="UpgradeFNELead">Upgrade FNE</option>
                    </optgroup>
                    <optgroup label="DNCR OPTION">
                        <option value="DNC">Hard DNC</option>
                        <option value="DNC">Soft DNC</option>
                    </optgroup>
                    {{-- <option value="Lead"></option> --}}
                    {{-- <option value="Hang Up">Hang Up</option>
                    <option value="Not Interested">Not Interested</option>
                    <option value="Switch Off">Switch Off</option>
                    <option value="Call Later">Call Later</option>
                    <option value="Follow up">Follow up</option>
                    <option value="Already Using DU 5G HW">Already Using DU 5G HW</option>
                    <option value="Already Using Etisalat 5G HW">Already Using Etisalat 5G HW</option>
                    <option value="Invalid">Invalid</option>
                    <option value="Already Postpaid">Already Postpaid</option>
                    <option value="Arabic">Arabic</option>
                    <option value="Call Drop By Customer">Call Drop By Customer</option>
                    <option value="Line Busy">Line Busy</option>
                    <option value="Customer Disconnecting the Call">Customer Disconnecting the Call</option>
                    <option value="Happy with Prepaid">Happy with Prepaid</option>
                    <option value="Bad Experience with Du">Bad Experience with Du</option>
                    <option value="Not the Owner">Not the Owner</option>
                    <option value="Going on Vacation">Going on Vacation</option>
                    <option value="Low Usage">Low Usage</option>
                    <option value="Leaving Country">Leaving Country</option>
                    <option value="Using Etisalat Prepaid">Using Etisalat Prepaid</option> --}}
                                            </select>
            </td>
            <td>
                                <input type="hidden" id="number_id_{{$i}}" value="{{$item->number_id}}">
                                <input type="hidden" id="userid_{{$i}}" value="{{auth()->user()->id}}">
                @if ($item->status != '')
                                    <input type="button" class="btn btn-info" name="Updated" id="btn_{{$item->id}}"  value="Updated">
                                    @else
<input type="submit" class="btn btn-success" name="upload" id="btn_{{$i}}"
onclick="CallLogFormFNE('{{$i}}','{{route('number.feedback.submit')}}','{{route('my_call_log_expired')}}')"
value="Update">

                                    @endif
            </td>
        </tr>
    </form>
        @endforeach
    {{ $k->links() }}

    </tbody>
</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection
