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
                                    <label class="form-label" for="first-name-icon">Address</label>
                                    <div class="input-group input-group-merge">
                                    <textarea name="address" id="address" cols="30" rows="10"  class="showme"  >{{$item->address}}</textarea>
                                    </div>
                                </div>
                            </div>
                              <div class="col-3">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Status</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                         <select name="rfs_type" id="rfs_type" class="form-control">
                                                <option value="">Select</option>
                                                <option value="RFS">RFS</option>
                                                <option value="Shortfall">Shortfall</option>
                                                <option value="OutZone">OutZone</option>
                                                <option value="Incomplete Address">Incomplete Address</option>
                                            </select>
                                    </div>
                                </div>
                            </div>

                             <div class="col-1">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Action</label>
                                    <button class="btn btn-success"
                                            id="btnEntry"
                                            {{-- disabled --}}
                                    onclick="SavingActivationLead('{{ route('SubmitEntryRfs') }}', 'MyRoleForm','{{ route('AddRFS') }}')"
                                            >Submit</button>
                                </div>
                            </div>
                    </div>
                            </form>

                    </form>
                    </div>
            </div>

        </div>
    </div>
    <!-- Modal to add new record -->

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
