@extends('layouts/contentLayoutMaster')

@section('title', 'Users')

@section('content')
<!-- Basic Horizontal form layout section start -->

<!-- Basic Horizontal form layout section end -->

<!-- Basic Vertical form layout section start -->
<section id="basic-vertical-layouts">

    <div class="row">




        <div class="col-12">
      <div class="card container table">
        <table class="table table-striped table-bordered zero-configuration table-responsive" id="pdf">
        {{-- <table class="datatables-basic table" id="pdf"> --}}
          <thead>
            <tr>
                <th>S#</th>
              <th>Agent Name</th>
              <th>TL Name</th>
              <th>Month</th>
              <th>Week</th>
              <th>Commitment</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $key => $item)
                <tr>
                    <td>
                        {{++$key}}
                    </td>
                    <td>{{$item->name}}</td>
                    <td>
                        @php
                        $s = \App\Models\User::where('id',$item->teamleader)->first();
                        if($s){
                            echo $s->name;
                        }
                        @endphp
                    </td>
                    <td>December 2023</td>
                    <td>{{$item->week}}</td>
                    <td>{{$item->commitment}}</td>
                    <td>
                        @if($item->status == 1)
                        Acheived 🏆
                        @else
                        Failed
                        @endif
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
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
