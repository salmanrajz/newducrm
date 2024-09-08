@extends('layouts/contentLayoutMaster')

@section('title', 'ClawBack')

@section('content')
<!-- Basic Horizontal form layout section start -->

<!-- Basic Horizontal form layout section end -->

<!-- Basic Vertical form layout section start -->
<section id="basic-vertical-layouts">
    <div class="row">

        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Data</h4>
                </div>
                <div class="card-body">
                    <form class="form form-vertical" id="MyRoleForm" onsubmit="return false">
                        <div class="row">
                             <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Activation Date:</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="date" id="activation_date" class="form-control" name="activation_date"
                                            value="{{$data->activation_date}}" />
                                    </div>
                                </div>
                            </div>

                             <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Lead Source</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="first-name-icon" class="form-control" name="lead_source"
                                            value="{{$data->lead_source}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Mobile Number</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="first-name-icon" class="form-control" name="customer_number"
                                            value="{{$data->mobile_number}}" />
                                    </div>
                                </div>
                            </div>


                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Account #</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="first-name-icon" class="form-control" name="account_number"
                                            value="{{$data->account_number}}" />
                                    </div>
                                </div>
                            </div>



                            {{-- IMO --}}
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Sim Serial #</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="sim_serial_number" class="form-control" name="sim_serial_number"
                                            value="{{$data->sim_serial_number}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Contract ID</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="password" class="form-control" name="contract_id"
                                            value="{{$data->contract_id}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Status</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        {{-- <input type="text" id="status" class="form-control" name="status" --}}
                                            {{-- placeholder="Status" /> --}}
                                            <select name="status" id="status" class="form-control">
                                                <option value="Active" @if ($data->status == 'Active') {{ 'selected' }} @endif>Active</option>
                                                <option value="Suspend" @if ($data->status == 'Suspend') {{ 'selected' }} @endif>Suspend</option>
                                                <option value="InActive" @if ($data->status == 'InActive') {{ 'selected' }} @endif>InActive</option>
                                                <option value="Prepaid" @if ($data->status == 'Prepaid') {{ 'selected' }} @endif>Prepaid</option>
                                            </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Billing Cycle</label>
                                    <select name="billing_cycle" id="billing_cycle" class="form-control">
                                        <option value="1" @if ($data->billing_cycle == '1') {{ 'selected' }} @endif
                                        >1</option>
                                        <option value="7"
                                        @if ($data->billing_cycle == '7') {{ 'selected' }} @endif
                                        >7</option>
                                        <option value="17"
                                        @if ($data->billing_cycle == '17') {{ 'selected' }} @endif
                                        >17</option>
                                    </select>
                                </div>
                            </div>
                             <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">FBD Amount</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="status" class="form-control" name="fbd_amount"
                                            value="{{$data->fbd_amount}}" />
                                    </div>
                                </div>
                            </div>
                             <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">FBD Billing Date</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="date" id="status" class="form-control" name="fbd_billing_date"
                                            value="{{$data->fbd_billing_date}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">FBD 21</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="date" id="status" class="form-control" name="fbd_21"
                                            value="{{$data->fbd_21}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">FBD 90</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="date" id="status" class="form-control" name="fbd_90"
                                            value="{{$data->fbd_90}}" />
                                    </div>
                                </div>
                            </div>
                             <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">SBD Amount</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="status" class="form-control" name="sbd_amount"
                                            value="{{$data->sbd_amount}}" />
                                    </div>
                                </div>
                            </div>
                             <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">SBD Billing Date</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="date" id="status" class="form-control" name="sbd_billing_date"
                                            value="{{$data->sbd_billing_date}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">SBD 21</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="date" id="status" class="form-control" name="sbd_21"
                                            value="{{$data->sbd_21}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">SBD 90</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="date" id="status" class="form-control" name="sbd_90"
                                            value="{{$data->sbd_90}}" />
                                    </div>
                                </div>
                            </div>
                             <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">TBD Amount</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="status" class="form-control" name="tbd_amount"
                                            value="{{$data->tbd_amount}}" />
                                    </div>
                                </div>
                            </div>
                             <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">TBD Billing Date</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="date" id="status" class="form-control" name="tbd_billing_date"
                                            value="{{$data->tbd_billing_date}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">TBD 21</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="date" id="status" class="form-control" name="tbd_21"
                                            value="{{$data->tbd_21}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">TBD 90</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="date" id="status" class="form-control" name="tbd_90"
                                            value="{{$data->tbd_90}}" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Total Pending</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="status" class="form-control" name="total_pending"
                                            value="{{$data->total_pending}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Clawback</label>
                                    <div class="input-group input-group-merge">
                                        <select name="clawback" id="clawback" class="form-control">
                                            <option value="Yes" @if ($data->status == 'Yes') {{ 'selected' }} @endif >Yes</option>
                                            <option value="No" @if ($data->status == 'No') {{ 'selected' }} @endif>NO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Category</label>
                                    <div class="input-group input-group-merge">
                                        <select name="clawback" id="clawback" class="form-control">
                                            <option value="P2P" @if ($data->status == 'P2P') {{ 'selected' }} @endif>P2P</option>
                                            <option value="MNP" @if ($data->status == 'MNP') {{ 'selected' }} @endif>MNP</option>
                                            <option value="HomeWifi" @if ($data->status == 'HomeWifi') {{ 'selected' }} @endif>Home Wifi</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Plan Name</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="status" class="form-control" name="plan_name"
                                            value="{{$data->plan_name}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Agent Name</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="status" class="form-control" name="agent_name"
                                            value="{{$data->agent_name}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Nationality</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="status" class="form-control" name="nationality"
                                            value="{{$data->nationality}}" />
                                    </div>
                                </div>
                            </div>
                                                         <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Customer Name</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="first-name-icon" class="form-control" name="customer_name"
                                            value="{{$data->customer_name}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Alternative Number</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="first-name-icon" class="form-control" name="alternative_number"
                                            value="{{$data->alternative_number}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Remarks</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="status" class="form-control" name="remarks"
                                            value="{{$data->remarks}}" />
                                    </div>
                                </div>
                            </div>

                            {{-- IMO END --}}
                            <div class="col-12">

                                <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>

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
  {{-- vendor files --}}
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection
@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/custom.js')) }}"></script>
<script>
$(document).ready(function () {
    $('#pdf').DataTable({
"drawCallback": function( settings ) {
        feather.replace();
    }
    });
});
</script>
<!-- Page js files -->
@endsection
