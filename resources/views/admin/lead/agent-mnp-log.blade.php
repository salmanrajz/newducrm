@extends('layouts/contentLayoutMaster')

@section('title', 'Logs')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection
@section('content')
<!-- Basic Horizontal form layout section start -->

<!-- Basic Horizontal form layout section end -->

<!-- Basic Vertical form layout section start -->
<section id="basic-vertical-layouts">
    <div class="row">

        <div class="col-md-12 col-12">
           @inject('provider', 'App\Http\Controllers\NumberAssigner')
                {{--  --}}
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Agent Log</h4>
                            {{-- <a class="btn btn-success" href="{{route('user.create')}}">Agent MNP Log</a> --}}
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration" id="pdf">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Data Assigned</th>
                                                <th>Data Used</th>
                                                <th>Data Available</th>
                                                <th>Already Postpaid</th>
                                                <th>Not Interested</th>
                                                <th>No Answer</th>
                                                <th>Switch Off</th>
                                                <th>DNC</th>
                                                <th>Follow up General</th>
                                                <th>Follow up Interested</th>
                                                <th>Call Later</th>
                                                <th>Less Salary - Interested</th>
                                                <th>No Docs - Interested</th>
                                                <th>Lead</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)

                                            <tr>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->email}}</td>
                                                <td>
                                                    {{$new_complete = $provider::SingleCampaignCount('data-assigned',$item->id,'monthly')}}
                                                </td>
                                                <td>
                                                    {{$new_complete = $provider::SingleCampaignCount('data-used',$item->id,'monthly')}}
                                                </td>
                                                <td>
                                                    {{$new_complete = $provider::SingleCampaignCount('data-available',$item->id,'monthly')}}
                                                </td>
                                                <td>
                                                    {{$new_complete = $provider::SingleCampaignCount('Already Postpaid',$item->id,'monthly')}}
                                                </td>
                                                <td>
                                                    {{$new_complete = $provider::SingleCampaignCount('Not Interested',$item->id,'monthly')}}
                                                </td>
                                                <td>
                                                    {{$new_complete = $provider::SingleCampaignCount('No Answer',$item->id,'monthly')}}
                                                </td>
                                                <td>
                                                    {{$new_complete = $provider::SingleCampaignCount('Switch off',$item->id,'monthly')}}
                                                </td>
                                                <td>
                                                    {{$new_complete = $provider::SingleCampaignCount('DNC',$item->id,'monthly')}}
                                                </td>
                                                <td>
                                                    {{$new_complete = $provider::SingleCampaignCount('Follow-up---General',$item->id,'monthly')}}
                                                </td>
                                                <td>
                                                    {{$new_complete = $provider::SingleCampaignCount('Follow-up---Interested',$item->id,'monthly')}}
                                                </td>
                                                <td>
                                                    {{$new_complete = $provider::SingleCampaignCount('Call Later',$item->id,'monthly')}}
                                                </td>
                                                <td>
                                                    {{$new_complete = $provider::SingleCampaignCount('Interested But Less Salary',$item->id,'monthly')}}
                                                </td>
                                                <td>
                                                    {{$new_complete = $provider::SingleCampaignCount('No Docs Interested',$item->id,'monthly')}}
                                                </td>
                                                <td>
                                                    {{$new_complete = $provider::SingleCampaignCount('Lead',$item->id,'monthly')}}
                                                </td>

                                            </tr>
                                            @endforeach

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>

    </div>
</section>
<!-- Basic Vertical form layout section end -->

<!-- Basic multiple Column Form section start -->


@endsection<!-- Basic Floating Label Form section end -->
@section('vendor-script')
  <!-- vendor files -->
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
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection
@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/custom.js')) }}"></script>
<!-- Page js files -->
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>

<script>
$(document).ready(function () {
    $('#pdf').DataTable({

    });
});
</script>

@endsection



