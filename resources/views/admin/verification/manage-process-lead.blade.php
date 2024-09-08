@extends('layouts/contentLayoutMaster')

@section('title', 'Lead')

@section('content')
<!-- Basic Horizontal form layout section start -->

<!-- Basic Horizontal form layout section end -->
@section('page-style')
{{-- Page Css files --}}
<style>
  div.blueTable {
    border: 1px solid #1C6EA4;
    background-color: #EEEEEE;
    width: 100%;
    text-align: left;
    border-collapse: collapse;
  }

  .divTable.blueTable .divTableCell,
  .divTable.blueTable .divTableHead {
    border: 1px solid #AAAAAA;
    padding: 3px 2px;
  }

  .divTable.blueTable .divTableBody .divTableCell {
    font-size: 13px;
  }

  .divTable.blueTable .divTableHeading {
    background: #34495E;
    border-bottom: 1px solid #444444;
  }

  .divTable.blueTable .divTableHeading .divTableHead {
    font-size: 15px;
    font-weight: bold;
    color: #FFFFFF;
    border-left: 1px solid #D0E4F5;
  }

  .divTable.blueTable .divTableHeading .divTableHead:first-child {
    border-left: none;
  }

  .blueTable .tableFootStyle {
    font-size: 14px;
  }

  .blueTable .tableFootStyle .links {
    text-align: right;
  }

  .blueTable .tableFootStyle .links a {
    display: inline-block;
    background: #1C6EA4;
    color: #FFFFFF;
    padding: 2px 8px;
    border-radius: 5px;
  }

  .blueTable.outerTableFooter {
    border-top: none;
  }

  .blueTable.outerTableFooter .tableFootStyle {
    padding: 3px 5px;
  }

  /* DivTable.com */
  .divTable {
    display: table;
  }

  .divTableRow {
    display: table-row;
  }

  .divTableHeading {
    display: table-header-group;
  }

  .divTableCell,
  .divTableHead {
    display: table-cell;
  }

  .divTableHeading {
    display: table-header-group;
  }

  .divTableFoot {
    display: table-footer-group;
  }

  .divTableBody {
    display: table-row-group;
  }
</style>
{{-- @include('dashboard.include.chat') --}}


{{-- <link rel="stylesheet" type="text/css" href="{{asset('css/base/plugins/forms/pickers/form-flat-pickr.css')}}"> --}}
@endsection
<!-- Basic Vertical form layout section start -->
<section id="basic-vertical-layouts">
    <div class="row">

        <div class="col-md-12 col-12">
            <div class="card">

                <div class="form-container container">
                    <div class="row">
                        {{-- <div class="col-6">
                            <form onsubmit="return false" method="post" enctype="multipart/form-data"
                                id="FetchApiForm3">
                                @csrf
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Emirate Front ID:</label>
                                    <div class="input-group input-group-merge">
                                        <input type="file" name="front_img" id="front_img"
                                            onchange="NameApi('{{ route('ocr-name.submit') }}','FetchApiForm3')">
                                        <h3 class="text-center" id="loading_num1" style="display:none">
                                            <img src="{{ asset('assets/images/loader.gif') }}"
                                                alt="Loading" class="img-fluid text-center offset-md-6"
                                                style="width:35px;">
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
                <form method="post" id="pre-verification-form">
            <input type="hidden" name="cust_id" value="">
            <input class="form-control " id="leadid" value="{{$operation->id}}" placeholder="Lead Number" type="hidden" disabled>
            <input type="hidden" name="lead_id" id="lead_id" value="{{$operation->id}}">
            <input type="hidden" name="lead_no" id="lead_no" value="{{$operation->lead_no}}">
                <div class="card-header">
                    <h4 class="card-title">Lead Information</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

              <!-- kettly -->
              <div class="divTable blueTable">
                <div class="divTableHeading">
                  <div class="divTableRow">
                    <div class="divTableHead">Data Field</div>
                    <div class="divTableHead">Customer Data Field</div>
                    <div class="divTableHead">To be Edit</div>
                    <div class="divTableHead">Verified</div>
                  </div>
                </div>


                <?php


                ?>
                <div class="divTableBody">
                  <!-- 1 -->
                  <div class="divTableRow">
                    <div class="divTableCell" style="width:20%;">
                      <!-- <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12" >Device Name</label> -->
                      <p> <strong>Customer Name:</strong> </p>
                    </div>
                    <div class="divTableCell" style="width:20%;">
                      <input class="form-control " id="inputSuccess3" placeholder="Customer Name" name="old_cname" placeholder="Customer Number" type="text" disabled value="{{$operation->customer_name}}">
                    </div>
                    <div class="divTableCell" style="width:20%;">
                      <!-- <input type="checkbox"   id="state"> -->
                      <select name="Select Option" id="state" class="form-control" style="width:100px;">
                        <option value="other1">No </option>
                        <option value="other" id="other2">Yes</option>
                      </select>

                    </div>
                    <div class="divTableCell" style="width:20%;">
                    <input class="form-control " id="province" type="text" value="{{$operation->customer_name}}">
                      <input class="form-control " id="province1" name="cname" type="hidden" value="{{$operation->customer_name}}">
                      <input class="form-control " id="" name="cust_id" type="hidden" value="{{$operation->lead_no}}">
                      <script>
                        var myInput = document.getElementById('province');
                        myInput.disabled = true;
                      </script>
                    </div>
                  </div>
                  <!-- 1 -->
                  <!-- 2 -->
                  <div class="divTableRow">
                    <div class="divTableCell" style="width:20%;">
                      <!-- <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12" >Device Name</label> -->
                      <p> <strong>Customer Number:</strong> </p>
                    </div>
                    <div class="divTableCell">
                      <input class="form-control " disabled id="inputSuccess3" placeholder="Customer Name" name="old_cname" placeholder="Customer Number" type="tel" value="{{$operation->customer_number}}" maxlength="12">
                    </div>
                    <div class="divTableCell">
                      <select name="Select Option" id="state2" class="form-control" style="width:100px;">
                        <option value="other1">No </option>
                        <option value="other" id="other2">Yes</option>
                        <!-- <option value="other" id="other1">Yes</option> -->
                      </select>
                    </div>
                    <div class="divTableCell">
                      <input class="form-control " id="province2" type="text" value="{{$operation->customer_number}}">
                      <input class="form-control " id="province22" name="cnumber" type="hidden" value="{{$operation->customer_number}}">
                      <script>
                        var myInput = document.getElementById('province2');
                        myInput.disabled = true;
                      </script>
                    </div>
                  </div>
                  <!-- 2 -->
                  <!-- 3 -->
                  <div class="divTableRow">
                    <div class="divTableCell" style="width:20%;">
                      <!-- <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12" >Device Name</label> -->
                      <p> <strong>Email:</strong> </p>
                    </div>
                    <div class="divTableCell">
                      <input class="form-control " disabled id="inputSuccess3" placeholder="Email" name="old_email" placeholder="Customer Number" type="text" value="{{$operation->email}}">
                    </div>
                    <div class=" divTableCell">
                      <select name="Select Option" id="state3" class="form-control" style="width:100px;">
                        <option value="other1">No </option>
                        <option value="other" id="other2">Yes</option>
                        <!-- <option value="other" id="other1">Yes</option> -->
                      </select>
                    </div>
                    <div class="divTableCell">
                      <input class="form-control " id="province3" type="text" value="{{$operation->email}}">
                      <input class="form-control " id="province33" name="email" type="hidden" value="{{$operation->email}}">
                      <script>
                        var myInput = document.getElementById('province3');
                        myInput.disabled = true;
                      </script>
                    </div>
                  </div>
                  <div class="divTableRow">
                    <div class="divTableCell" style="width:20%;">
                      <!-- <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12" >Device Name</label> -->
                      <p> <strong>Gender:</strong> </p>
                    </div>
                    <div class="divTableCell">
                      <input class="form-control " disabled id="inputSuccess3" placeholder="Age" name="" placeholder="Customer Number" type="text" value="{{$operation->gender}}">
                    </div>
                    <div class=" divTableCell">
                      <select name="Select Option" id="state_gender" class="form-control" style="width:100px;">
                        <option value="other1">No </option>
                        <option value="other" id="other2">Yes</option>
                        <!-- <option value="other" id="other1">Yes</option> -->
                      </select>
                    </div>
                    <div class="divTableCell">
                    <select name="" id="p_gender3" class="gender form-control" required>
                    <option value="">-- Select Gender --</option>
                        <option value="Male" @if ($operation->gender== "Male") {{ 'selected' }} @endif>Male</option>
                        <option value="Female" @if ($operation->gender == "Female") {{ 'selected' }} @endif>Female</option>
                        <option value="Other" @if ($operation->gender == "Other") {{ 'selected' }} @endif>Other</option>
                    </select>
                      {{-- <input class="form-control " id="province3" type="text" value="{{$operation->age}}"> --}}
                      <input class="form-control " id="p_gender" name="gender" type="hidden" value="{{$operation->gender}}">
                      <script>
                        var myInput = document.getElementById('p_gender3');
                        myInput.disabled = true;
                      </script>
                    </div>
                  </div>
                  <div class="divTableRow">
                    <div class="divTableCell" style="width:20%;">
                      <!-- <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12" >Device Name</label> -->
                      <p> <strong>Emirates:</strong> </p>
                    </div>
                    <div class="divTableCell">
                      <input class="form-control " disabled id="inputSuccess3" placeholder="Age" name="old_age" placeholder="Customer Number" type="text" value="{{$operation->emirate}}">
                    </div>
                    <div class=" divTableCell">
                      <select name="Select Option" id="state_emirates" class="form-control" style="width:100px;">
                        <option value="other1">No </option>
                        <option value="other" id="other2">Yes</option>
                        <!-- <option value="other" id="other1">Yes</option> -->
                      </select>
                    </div>
                    <div class="divTableCell">
                      <select name="emirate" id="province_emirates" class="emirates form-control" required>
                        <option value="{{$operation->emirate}}">
                            {{$operation->emirate}}
                          </option>
                        @foreach($emirates as $emirate)
                        <option value="{{ $emirate->name }}">{{ $emirate->name }}</option>
                    @endforeach
                      </select>
                      <input class="form-control " id="province__emirates" name="emirate" type="hidden" value="{{$operation->emirate}}">
                      <script>
                        var myInput = document.getElementById('province_emirates');
                        myInput.disabled = true;
                      </script>
                    </div>
                  </div>
                  <div class="divTableRow">
                    <div class="divTableCell" style="width:20%;">
                      <!-- <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12" >Device Name</label> -->
                      <p> <strong>Area:</strong> </p>
                    </div>
                    <div class="divTableCell">
                      <input class="form-control " disabled id="inputSuccess3" placeholder="Age" name="old_age" placeholder="Customer Number" type="text" value="{{$operation->address}}">
                    </div>
                    <div class=" divTableCell">
                      <select name="Select Option" id="state_area" class="form-control" style="width:100px;">
                        <option value="other1">No </option>
                        <option value="other" id="other2">Yes</option>
                        <!-- <option value="other" id="other1">Yes</option> -->
                      </select>
                    </div>
                    <div class="divTableCell">
                        <input class="form-control " id="state__area"  type="text" value="{{$operation->address}}">

                      <input class="form-control " id="state_area_hidden" name="address" type="hidden" value="{{$operation->address}}">
                      <script>
                        var myInput = document.getElementById('state__area');
                        myInput.disabled = true;
                      </script>
                    </div>
                  </div>
                  <div class="divTableRow">
                    <div class="divTableCell" style="width:20%;">
                      <!-- <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12" >Device Name</label> -->
                      <p> <strong>Language:</strong> </p>
                    </div>
                    <div class="divTableCell">
                      <input class="form-control " disabled id="inputSuccess3" placeholder="Age" name="old_age" placeholder="Customer Number" type="text" value="{{ $operation->language }}">
                    </div>
                    <div class=" divTableCell">
                      <select name="Select Option" id="state_language" class="form-control" style="width:100px;">
                        <option value="other1">No </option>
                        <option value="other" id="other2">Yes</option>
                        <!-- <option value="other" id="other1">Yes</option> -->
                      </select>
                    </div>
                    <div class="divTableCell">
                      <select name="language" class="form-control " id="province_language">
                        <option value="{{ $operation->language }}">{{ $operation->language }}</option>
                        <option value="">Select Language</option>
                        <option value="English">English</option>
                        <option value="Arabic">Arabic</option>
                        <option value="Urdu/Hindi">Urdu/Hindi</option>
                      </select>
                      <input class="form-control " id="province__language" name="language" type="hidden" value="{{ $operation->language }}">
                      <script>
                        var myInput = document.getElementById('province_language');
                        myInput.disabled = true;
                      </script>
                    </div>
                  </div>
                  <!-- 3 -->
                  <!-- 4 -->
                  <div class="divTableRow">
                    <div class="divTableCell" style="width:20%;">
                      <!-- <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12" >Device Name</label> -->
                      <p> <strong>Nationality:</strong> </p>
                    </div>
                    <div class="divTableCell">
                      <input class="form-control " disabled id="inputSuccess3" placeholder="Nationality" name="old_nation" placeholder="Nationality" type="text" value="{{ $operation->nationality }}" >
                            </div>
                            <div class=" divTableCell">
                      <select name="Select Option" id="state4" class="form-control" style="width:100px;">
                        <option value="other1">No </option>
                        <option value="other" id="other2">Yes</option>
                        <!-- <option value="other" id="other1">Yes</option> -->
                      </select>
                    </div>
                    <div class="divTableCell">
                      <select name="nation" id="province4" class="form-control has-feedback-left">

                        <option value="{{ $operation->nationality }}">{{ $operation->nationality }}</option>
                        @foreach($countries as $country)
                        <option value="{{ $country->name }}">{{ $country->name }}</option>
                    @endforeach
                        <!-- <input class="form-control " id="province4"  type="text" value=""  > -->
                      <input class="form-control " id="province44" name="nationality" type="hidden" value="{{$operation->nationality}}">
                        <script>
                          var myInput = document.getElementById('province4');
                          myInput.disabled = true;
                        </script>
                    </div>
                  </div>
                  <!-- 4 -->
                  <!-- 5 -->
                  <div class="divTableRow" >
                    <div class="divTableCell" style="width:20%;">
                      <!-- <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12" >Device Name</label> -->
                      <p> <strong>Emirate Id Expiry:</strong> </p>
                    </div>
                    <div class="divTableCell">
                      <input class="form-control " id="inputSuccess3" disabled name="old_expiry" value="{{ $operation->emirate_expiry }}" type="text" >
                            </div>
                            <div class=" divTableCell">
                      <select name="Select Option" id="state5" class="form-control" style="width:100px;">
                        <option value="other1">No </option>
                        <option value="other" id="other2">Yes</option>
                        <!-- <option value="other" id="other1">Yes</option> -->
                      </select>
                    </div>
                    <div class="divTableCell">
                      <input type="date" name="emirate_expiry" value="{{$operation->emirate_expiry}}" class="form-control" id="province5">
                      <!-- <input class="form-control " id="province5"  type="text" value=""> -->
                      <input class="form-control " id="province55" name="emirate_expiry" type="hidden" value="{{ $operation->emirate_expiry }}">
                      <script>
                        var myInput = document.getElementById('province5');
                        myInput.disabled = true;
                      </script>
                    </div>
                  </div>
                  <!-- 5 -->
                  <!-- original Emirate number -->
                  <div class="divTableRow">
                    <div class="divTableCell" style="width:20%;">
                      <!-- <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12" >Device Name</label> -->
                      <p> <strong>Emirate ID #:</strong> </p>
                    </div>
                    <div class="divTableCell">
                      <input class="form-control " id="inputSuccess3" disabled name="old_emirate_id" value="{{ $operation->emirate_id }}" type="text">
                    </div>
                    <div class=" divTableCell">
                      <select name="Select Option" id="state_emirate_num" class="form-control" style="width:100px;">
                        <option value="other1">No </option>
                        <option value="other" id="other2">Yes</option>
                        <!-- <option value="other" id="other1">Yes</option> -->
                      </select>
                    </div>
                    <div class="divTableCell">
                      @if($operation->lead_type == 'P2P')
                        @if($operation->emirate_id_count  == 0)
                        <input class="form-control " id="province_original_id1" data-inputmask="'mask': '9999-9'"
                        data-validate-length-range="6" data-validate-words="2" name="emirate_number" placeholder="Emirate ID" type="num" value="{{ $operation->emirate_id }}">
                        @else
                        <input class="form-control " id="province_original_id1" data-inputmask="'mask': '999-9999-9999999-9'"
                        data-validate-length-range="6" data-validate-words="2" name="emirate_number" placeholder="Emirate ID" type="num" value="{{ $operation->emirate_id }}">
                        @endif
                      @else
                      <input class="form-control " id="province_original_id1" data-inputmask="'mask': '999-9999-9999999-9'"
                        data-validate-length-range="6" data-validate-words="2" name="emirate_number" placeholder="Emirate ID" type="num" value="{{ $operation->emirate_id }}">
                      @endif

                      <input class="form-control " id="province_original_id11" name="emirate_id" type="hidden" value="{{ $operation->emirate_id }}">
                      <script>
                        var myInput = document.getElementById('province_original_id1');
                        myInput.disabled = true;
                      </script>
                    </div>
                  </div>
                  <!-- original Emirate number end -->
                  <!-- 6 -->
                  <div class="divTableRow">
                    <div class="divTableCell" style="width:20%;">
                      <!-- <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12" >Device Name</label> -->
                      <p> <strong>Additional Documents:</strong> </p>
                    </div>
                    <div class="divTableCell">
                      <input class="form-control " id="inputSuccess3" disabled value="{{ $operation->additional_docs_name }}" name="" type="text">
                    </div>
                    <div class="divTableCell">
                      <select name="Select Option" id="state6" class="form-control" style="width:100px;">
                        <option value="other1">No </option>
                        <option value="other" id="other2">Yes</option>
                        <!-- <option value="other" id="other1">Yes</option> -->
                      </select>
                    </div>
                    <div class="divTableCell">
                      <select name="" id="province6" class="form-control">
                        <option value="No Additional Document Required" id="" class="hideonelife" {{$operation->additional_docs_name == 'No Additional Document Required' ? 'selected' : ''}}>No Additional Document Required</option>
                        <option value="Ejari" {{$operation->additional_docs_name == 'Ejari' ? 'selected' : ''}}>Ejari</option>
                        <option value="Tenancy contract" {{$operation->additional_docs_name == 'Tenancy contract' ? 'selected' : ''}}>Tenancy contract</option>
                        <option value="Title deed (front side)" {{$operation->additional_docs_name == 'Title deed (front side)' ? 'selected' : ''}}>Title deed (front side)</option>
                        <option value="Salary Certificate" {{$operation->additional_docs_name == 'Salary Certificate' ? 'selected' : ''}}>Salary Certificate (latest 3 months (min. salary of AED 2,500 with UAE based company name. Contact details, original company stamp on letterhead is required))</option>
                        <option value="Utility Bill" {{$operation->additional_docs_name == 'Utility Bill' ? 'selected' : ''}}>Utility Bill - latest 3 months (Electricity / Water / Internet or TV / landline / broadband bill)</option>
                        <option value="Labour Contract" {{$operation->additional_docs_name == 'Labour Contract' ? 'selected' : ''}}>Labour contract (pages with Name, nationality, Passport numbers)</option>
                      </select>
                      <!-- <input class="form-control " id="province6"  type="file" value=""  > -->
                      <input class="form-control " id="province66" name="additional_documents" type="hidden" value="{{$operation->additional_docs_name}}">
                      <script>
                        var myInput = document.getElementById('province6');
                        myInput.disabled = true;
                      </script>
                    </div>
                  </div>
                </div>
                <!-- kettly -->
                <div class="divTableRow">
                  <div class="divTableCell" style="width:20%;">
                    <!-- <label for="localminutes" class="control-label col-md-12 col-sm-12 col-xs-12" >Device Name</label> -->
                    <p> <strong>Product Type:</strong> </p>
                  </div>
                  <div class="divTableCell">
                  <input class="form-control " id="inputSuccess3" disabled placeholder="Sim Type" name="sim_type" type="text" value="{{$operation->lead_type}}">
                  </div>
                  <div class="divTableCell">
                    <select name="Select Option" id="state7" class="form-control" style="width:100px;">
                      <option value="other1">No </option>
                      <option value="other" id="other2">Yes</option>
                      <!-- <option value="other" id="other1">Yes</option> -->
                    </select>
                  </div>
                  <div class="divTableCell">

                    <input type="hidden" name="call_back_ajax">
                    <select name="simtype" id="province7" class="sim_type form-control" required>
                      <option value="">-- Product Type  --</option>
                      <option value="New" @if ($operation->lead_type == "HomeWifi") {{ 'selected' }} @endif>HomeWifi</option>
                      <option value="MNP" @if ($operation->lead_type == "MNP") {{ 'selected' }} @endif>MNP</option>
                      <option value="P2P" @if ($operation->lead_type == "P2P") {{ 'selected' }} @endif>P2P</option>
                      {{-- <option value="Elife" @if ($operation->sim_type == "Elife") {{ 'selected' }} @endif>Elife</option> --}}
                      {{-- <option value="HomeWifi" @if ($operation->sim_type == "HomeWifi") {{ 'selected' }} @endif>Home Wifi</option> --}}
                    </select>
                    {{-- <input type="hidden" name="total" value=">"> --}}
                    <input type="hidden" name="monthly_payment" value="">
                    <!-- <input class="form-control " id="province7"  type="text" value="  > -->
                    <input class="form-control " id="province77" name="sim_type" type="hidden" value="{{$operation->lead_type}}">
                    <script>
                      var myInput = document.getElementById('province7');
                      myInput.disabled = true;
                    </script>
                  </div>
                </div>
                <!-- call_back_ajax -->

              </div>
              <div class="col-md-12 col-sm-12 col-xs-12 form-group ">
                <input type="hidden" name="saler_id" id="saler_id" value="{{$operation->saler_id}}">
                <input type="hidden" name="call_back_ajax" class="call_back_ajax">
              {{-- <input type="hidden" name="gender" value="{{$operation->gender}}" class="gender"> --}}

              <div class="container hidden" style="background:#EEEEEE;border:1px solid #1C6EA4">
                <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                  <h4 class="">Pre Check Status</h4>
                  <h3 class="details red">
                    {{$operation->pre_check_status}}
                  </h3>
                </div>
                <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                  <h4 class="">Pre Check Remarks</h4>
                  <h3 class="details red">
                    {{$operation->pre_check_remarks}}
                  </h3>
                </div>
              </div>
               @if($operation->lead_type == 'Elife' || $operation->lead_type == 'HomeWifi')
                <div class="container row" style="background:#EEEEEE;border:1px solid #1C6EA4">
                <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                  <h4 class="">DOB</h4>
                </div>
                <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                  <h4 class="">
                    <input type="date" name="dob" id="dob" value="{{$operation->dob}}">
                  </h4>
                  <h3 class="details red">
                  </h3>
                </div>
              </div>
              @endif



              </div>

               @if($operation->lead_type == 'HomeWifi')
                <div class="col-12">
                        <div class="mb-1">
                            <label class="form-label" for="first-name-icon">Home Wifi Plans</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i data-feather="user"></i></span>
                                <select name="plans" id="plans" class="is_mnp form-control" required>
                                    @foreach($plan as $item)
                                        <option value="{{ $item->id }}" {{$item->id == $operation->plans ? 'selected' : ''}} id="{{$item->id}}" >{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
               @elseif($operation->lead_type == 'MNP' || $operation->lead_type == 'P2P')
               <div class="col-12">
                        <div class="mb-1">
                            <label class="form-label" for="first-name-icon">Postpaid Plan</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i data-feather="user"></i></span>
                                <select name="plans" id="plans" class="is_mnp form-control" required>
                                    @foreach($mnpplan as $item)
                                        <option value="{{ $item->id }}" {{$operation->plans == $item->id ? 'selected' : ''}} >{{ $item->plan_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-4">
                            <label for="front_id">Front ID</label>
                            <img src="{{env('CDN_URL')}}/documents/{{$operation->front_id}}" alt="Front ID" width="250px" id="myImg1">
                            <input type="hidden" name="old_front_id" value="{{$operation->front_id}}" id="old_front_id" >
                            <div class="input-group input-group-merge mt-2">
                                <input type="file" name="front_id" id="front_img" class="form-control" accept="image/*" >
                            </div>
                        </div>
                        <div class="col-4">
                            <label for="front_id">Back ID</label>
                            <img src="{{env('CDN_URL')}}/documents/{{$operation->back_id}}" alt="Back ID"  width="250px" id="myImg2">
                            <input type="hidden" name="old_back_id" value="{{$operation->back_id}}" id="old_front_id">
                            <div class="input-group input-group-merge mt-2">
                                <input type="file" name="back_id" id="back_img" class="form-control" accept="image/*">
                            </div>
                        </div>
                        <div class="col-4">
                            <label for="front_id">Additional Docs</label>
                            <img src="{{env('CDN_URL')}}/documents/{{$operation->additional_docs_photo}}" alt="{{$operation->additional_docs_name}}"  width="250px" id="myImg3">
                            <input type="hidden" name="old_additional_docs_name" value="{{$operation->additional_docs_photo}}" id="old_front_id">
                            <div class="input-group input-group-merge mt-2">
                                <input type="file" name="additional_docs_photo" id="additional_documents" class="form-control" accept="image/*">
                            </div>
                        </div>
                    </div>
               {{-- @include('dashboard.include.verify-mnp') --}}
               {{-- @elseif($operation->sim_type == 'New') --}}
               {{-- @include('dashboard.include.verify-new') --}}
               @endif

              <div class="container">
                <div class="row">
                  {{-- <div class="col-md-12">
                      <div class="form-group audio_action row" >
                        <div class="col-sm-4 col-xs-12 col-md-4 mt-5 mb-5">
                          <label for="audio1" data-toggle="tooltip" title="Audio 1 is Mandatory">Audio 1</label>
                          <input type="file" name="audio" id="audio1" class="form-control"  accept="audio/*">
                          </div>
                      </div>
                  </div> --}}
                  @if($operation->lead_type == 'MNP')
                  <div class="col-8">
                               <div class="mb-1">
                                   <label class="form-label" for="first-name-icon">Refference ID By DU</label>
                                   <div class="input-group input-group-merge">
                                       <span class="input-group-text"><i data-feather="user"></i></span>

                                       <input type="text" name="refference_id" id="refference_id" class="form-control">
                                   </div>
                               </div>
                           </div>
                @elseif($operation->lead_type == 'HomeWifi')
                <div class="col-8">
                               <div class="mb-1">
                                   <label class="form-label" for="first-name-icon">Refference ID By DU</label>
                                   <div class="input-group input-group-merge">
                                       <span class="input-group-text"><i data-feather="user"></i></span>

                                       <input type="text" name="refference_id" id="refference_id" class="form-control">
                                   </div>
                               </div>
                           </div>
                           <div class="col-8">
                                            <div class="mb-1">
                                                <label class="form-label" for="first-name-icon">4G/5G Number By DU (Work Order Number)</label>
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text"><i data-feather="user"></i></span>

                                                    <input type="text" name="work_order_num" id="work_order_num" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                        @endif

                @if($operation->plans == 3)
                   <div class="col-8">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">4G Account ID</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" name="fourjee_id" id="4g_id" class="form-control" >
                                    </div>
                                </div>
                            </div>
                   <div class="col-8">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">4G Account Number</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" name="fourjee_account" id="4g_account" class="form-control" >
                                    </div>
                                </div>
                            </div>

                    @elseif($operation->plans == 5 || $operation->plans == 6 || $operation->plans == 7)

                    <div class="col-8">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">5G Create Date:</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="date" name="create_date" id="create_date" class="form-control" >
                                    </div>
                                </div>
                            </div>

                   <div class="col-8">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">5G Expiry Date:</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="date" name="expiry_date" id="5g_account" class="form-control" >
                                    </div>
                                </div>
                            </div>
                   <div class="col-8">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">FNE Account ID:</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" name="fne_account_id" id="fne_account_id" class="form-control" >
                                    </div>
                                </div>
                            </div>
                        {{-- <input type="hidden" name="fourjee_id" id="4g_id" class="form-control" value="N/A"> --}}
                        {{-- <input type="hidden" name="fourjee_account" id="4g_account" class="form-control" value="N/A"> --}}
                                                        @else
                                        <input type="hidden" name="fourjee_id" id="4g_id" class="form-control" value="N/A">
                                        <input type="hidden" name="fourjee_account" id="4g_account" class="form-control" value="N/A">


                            @endif
                            {{-- FRONT IMAGE --}}

                            {{-- FRONT IMAGE END --}}
                            {{-- BACK IMAGE --}}
                            {{-- BACK IMAGE END --}}
                            {{-- ADD DOCS IMAGE --}}
                             <div class="col-8">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Remarks</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" name="remarks" id="remarks" class="form-control" value="{{$operation->remarks}}">
                                    </div>
                                </div>
                            </div>
                            {{-- ADD DOCS IMAGE END --}}
                            <div class="col-8">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Appointment Date:</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="date" name="appointment_date" id="appointment_date" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            {{--  --}}
                            <div class="col-8">
                                <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>
                            </div>
                            <h3 class="text-center" id="loading_num3" style="display:none">
                            Please wait while system loading leads...
                            <img src="{{asset('images/loader/loader.gif')}}" alt="Loading"
                                class="img-fluid text-center offset-md-6" style="width:35px;">
                        </h3>
                </div>
              </div>
              <br>
              <br>
              <br>
              <!-- end of table -->
              <!-- pika booo -->
              <div class="form-group row col-12">
                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                  <!-- <button type="button" class="btn btn-primary">Cancel</button> -->
                  <!-- <button class="btn btn-primary" type="reset">Reset</button> -->
                  @if($operation->status == '1.11')
                  <input type="button" value="Verify and Active" class="btn btn-success" name="upload" onclick="VerifyLead('{{route('verification.active.store')}}','pre-verification-form','{{route('home')}}')">
                  @else
                  {{-- <button type="button" class="btn btn-info" onclick="VerifyLead('{{route('verified.at.location')}}','pre-verification-form','{{route('verification.index')}}')">Verify At Location</button> --}}
                  {{-- <button type="button" class="btn btn-info" onclick="VerifyLead('{{route('verified.at.whatsapp')}}','pre-verification-form','{{route('verification.index')}}')">Verified Via WhatsApp</button> --}}
                  {{-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Verified Need Today</button> --}}
                  {{-- <button type="button" class="btn btn-info" onclick="VerifyLead('{{route('verified.today')}}','pre-verification-form','{{route('verification.index')}}')">Verified Need Today</button> --}}
                  {{-- <button type="button" class="btn btn-danger" onclick="VerifyLead('{{route('not.answer')}}','pre-verification-form','{{route('verification.index')}}')">Not Answer</button> --}}
                  @if($operation->lead_type == 'P2P' || $operation->lead_type == 'MNP')
                  <input type="button" value="Verified" class="btn btn-success" name="upload" onclick="VerifyLead('{{route('VerifyPostPaidLeadsProcess')}}','pre-verification-form','{{route('home')}}')">
                  <input type="button" value="Follow Up" class="btn btn-primary" name="reject" onclick="VerifyLead('{{route('followupleads')}}','pre-verification-form','{{route('home')}}')">
                  @else
                <input type="button" value="Proceed" class="btn btn-success" name="upload" onclick="VerifyLead('{{route('proceedlead')}}','pre-verification-form','{{route('home')}}')">

                <input type="button" value="Pending For Approval" class="btn btn-success" name="upload" onclick="VerifyLead('{{route('pendingforapproval')}}','pre-verification-form','{{route('home')}}')">

                <input type="button" value="Reject" class="btn btn-danger" name="reject" onclick="VerifyLead('{{route('RejectLeads')}}','pre-verification-form','{{route('home')}}')">
                  @endif
                {{-- <input type="button" value="Non Verified" class="btn btn-danger" name="follow_up" id="follow_up" data-toggle="modal" data-target="#myModalF"> --}}
                {{-- <div class="btn btn-group"> --}}
                    {{-- <input type="button" value="Save Changes" class="btn btn-success" name="upload" onclick="VerifyLead('{{route('SaveChanges')}}','pre-verification-form','{{route('verification.index')}}')"> --}}
                {{-- </div> --}}
                    {{-- <input type="button" value="Pending" class="btn btn-danger" name="back" id="back" onclick="javascript:location.href='{{route('verification.index')}}'"> --}}
                  @endif

                  {{-- <button type="button" class="btn btn-success hidden" data-toggle="modal" data-target="#myModal">Later</button> --}}
                  {{-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#RejectModalNew">Reject</button> --}}
                  <!-- <input type="submit" value="Reject" class="btn btn-success" name="reject"> -->
                  <!-- <button type="submit" class="btn btn-success" name="upload">Submit</button> -->
                </div>
              </div>
            </div>
                </div>
            </div>
        </div>

    </div>
@include('admin.chat.chat')

</section>
<!-- Basic Vertical form layout section end -->

<!-- Basic multiple Column Form section start -->


@endsection
<!-- Basic Floating Label Form section end -->
@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/custom.js')) }}"></script>
<!-- Page js files -->
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script>
    $(":input").inputmask();

</script>
@endsection
