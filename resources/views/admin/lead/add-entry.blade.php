@extends('layouts/contentLayoutMaster')

@section('title', 'Lead Data')

@section('vendor-style')
{{-- vendor css files --}}
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection

@section('content')

<!-- Basic table -->
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card container">
                    {{-- <table class="datatables-basic table" id="pdf"> --}}
                    <div class="col-xl-12 col-md-6 col-12">
                            <form onsubmit="return false" method="post" enctype="multipart/form-data" id="MyRoleForm">
                                                <div class="form-container container" >
                    <div class="row">

                        <div class="col-3">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">CM ID</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="emirate_id" class="form-control" name="cmid"
                                            value="{{$item->cmid}}"

                                            />
                                    </div>
                                </div>
                            </div>
                        <div class="col-3">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Status</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                         <select name="status" id="status_entry" class="form-control">
                                                <option value="">Select</option>
                                                <option value="Home Wireless Plus">Home Wireless Plus</option>
                                                <option value="Home Wireless Entertainment">Home Wireless Entertainment</option>
                                                <option value="Postpaid">Postpaid</option>
                                                <option value="Not Available">Not Available</option>
                                            </select>
                                    </div>
                                </div>
                            </div>

                        <div class="col-2">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">File:</label>
                                    <div class="input-group input-group-merge">
                                            <input type="file" name="file" id="showme" class="showme" style="display: none">
                                    </div>
                                </div>
                            </div>
                             <div class="col-3">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Address</label>
                                    <div class="input-group input-group-merge">
                                    <textarea name="address" id="address" cols="30" rows="10"  class="showme"  style="display: none">{{$item->address}}</textarea>
                                    </div>
                                </div>
                            </div>
                             <div class="col-1">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Action</label>
                                    <button class="btn btn-success"
                                            id="btnEntry"
                                            disabled
                                    onclick="SavingActivationLead('{{ route('SubmitEntry') }}', 'MyRoleForm','{{ route('AddEntry') }}')"
                                            >Submit</button>
                                </div>
                            </div>
                    </div>
                            </form>

                    </form>
                    </div>
            </div>
             @inject('provider', 'App\Http\Controllers\FunctionController')

                                {{--  --}}
                                <table class="table table-bordered zero-configuration">
                            {{-- <table class="datatables-basic table" id="pdf"> --}}
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Agent Name</th>
                                    {{-- <th>Daily Entry HWP</th> --}}
                                    {{-- <th>Daily Entry HWE</th> --}}
                                    {{-- <th>Daily Entry PP</th> --}}
                                    <th>Target</th>
                                    <th>Daily Acheived</th>
                                    <th>Remaining</th>
                                    <th>Perc</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>{{auth()->user()->name}}</td>
                                    <td>
                                        1000
                                    </td>
                                    <td>
                                        {{$d = $provider::DataEntryCountLog('All',auth()->user()->id,'Daily')}}
                                    </td>
                                    <td>
                                        <span style="color:red">
                                        @php
                                            $a = 1000;
                                            $b = $provider::DataEntryCountLog('All',auth()->user()->id,'Daily');
                                            echo $c = $a-$b;
                                        @endphp
                                        </span>

                                        {{-- {{$provider::DataEntryCountLog('All',auth()->user()->id,'Daily')}} --}}
                                    </td>
                                    <td>
                                        @php
                                        if($d == 0){
                                                $d = 1;
                                                $c = 1;
                                        }
                                            echo $perc = round($c/$d*100);
                                        @endphp
                                    </td>

                                </tr>
                            </tbody>
                        </table>
        </div>
    </div>
    <!-- Modal to add new record -->
    <div class="modal modal-slide-in fade" id="modals-slide-in">
        <div class="modal-dialog sidebar-sm">
            <form class="add-new-record modal-content pt-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">New Record</h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                        <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname"
                            placeholder="John Doe" aria-label="John Doe" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-post">Customer #</label>
                        <input type="text" id="basic-icon-default-post" class="form-control dt-post"
                            placeholder="Web Developer" aria-label="Web Developer" />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-email">Emirate</label>
                        <input type="text" id="basic-icon-default-email" class="form-control dt-email"
                            placeholder="john.doe@example.com" aria-label="john.doe@example.com" />
                        <small class="form-text"> You can use letters, numbers & periods </small>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-date">Joining Date</label>
                        <input type="text" class="form-control dt-date" id="basic-icon-default-date"
                            placeholder="MM/DD/YYYY" aria-label="MM/DD/YYYY" />
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="basic-icon-default-salary">Salary</label>
                        <input type="text" id="basic-icon-default-salary" class="form-control dt-salary"
                            placeholder="$12000" aria-label="$12000" />
                    </div>
                    <button type="button" class="btn btn-primary data-submit me-1">Submit</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</section>
<!--/ Basic table -->


@endsection


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
{{-- Page js files --}}
<script>
    $(document).ready(function () {
        $('#pdf').DataTable({

        });
    });

</script>
{{-- <script src="{{ asset(mix('js/scripts/tables/table-datatables-basic.js')) }}"></script> --}}
<!-- Page js files -->
<script src="{{ asset(mix('js/custom.js')) }}"></script>
<!-- Page js files -->
@endsection
