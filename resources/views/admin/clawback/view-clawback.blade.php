
@extends('layouts/contentLayoutMaster')

@section('title', 'Claw Back Data')

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
<div class="container">
    <div class="row mb-1">
        {{-- <h</h1> --}}
        {{-- <h3>Date Range Filter</h3>
        <div class="form-group col-md-4">
                    <label for="mydate">Start Date:</label>
                    <input type="date" name="start" id="start" class="form-control">
        </div>
        <div class="form-group col-md-4">
                    <label for="mydate">End Date:</label>
                    <input type="date" name="start" id="start" class="form-control">
        </div> --}}

    </div>
    <div class=" mb-4 row">

        <div class="form-group col-md-4">
            <input type="button" value="Submit" class="btn btn-success">
        </div>
    </div>
</div>
<section id="basic-datatable">
  <div class="row">
    <div class="col-4 mb-2">
        <button class="btn btn-success" id="BulkDelete">Bulk Delete</button>
    </div>
    <div class="col-12">
      <div class="card container table-responsive">
        <table class="table table-striped table-bordered zero-configuration" id="pdf">
        {{-- <table class="datatables-basic table" id="pdf"> --}}
          <thead>
            <tr>
            <th>
                <input type="checkbox" id="select-all">
            </th>
              <th>id</th>
              <th>Action</th>
              <th>Activation Date</th>
              <th>Mobile Number</th>
              <th>Leads Source</th>
              <th>Account Number</th>
              <th>Sim Serial #</th>
              <th>Contract ID</th>
              <th>Status</th>
              <th>Billing Cycle</th>
              <th>FBD</th>
              <th>FBD Bill Date</th>
              <th>FBD 21</th>
              <th>FBD 90</th>
              <th>SBD</th>
              <th>SBD Bill Date</th>
              <th>SBD 21</th>
              <th>SBD 90</th>
              <th>TBD</th>
              <th>TBD Bill Date</th>
              <th>TBD 21</th>
              <th>TBD 90</th>
              <th>Total Pending</th>
              <th>Claw Back</th>
              <th>Category</th>
              <th>Plan name</th>
              <th>Agent Name</th>
              <th>Nationality</th>
              <th>Customer Name</th>
            </tr>
            <tr>
            <th class="filterhead">
                {{-- <input type="checkbox" id="select-all"> --}}
            </th>
              <th class="filterhead">id</th>
              <th class="filterhead">Action</th>
              <th class="filterhead">Activation Date</th>
              <th class="filterhead">Mobile Number</th>
              <th class="filterhead">Leads Source</th>
              <th class="filterhead">Account Number</th>
              <th class="filterhead">Sim Serial #</th>
              <th class="filterhead">Contract ID</th>
              <th class="filterhead">Status</th>
              <th class="filterhead">Billing Cycle</th>
              <th class="filterhead">FBD</th>
              <th class="filterhead">FBD Bill Date</th>
              <th class="filterhead">FBD 21</th>
              <th class="filterhead">FBD 90</th>
              <th class="filterhead">SBD</th>
              <th class="filterhead">SBD Bill Date</th>
              <th class="filterhead">SBD 21</th>
              <th class="filterhead">SBD 90</th>
              <th class="filterhead">TBD</th>
              <th class="filterhead">TBD Bill Date</th>
              <th class="filterhead">TBD 21</th>
              <th class="filterhead">TBD 90</th>
              <th class="filterhead">Total Pending</th>
              <th class="filterhead">Claw Back</th>
              <th class="filterhead">Category</th>
              <th class="filterhead">Plan name</th>
              <th class="filterhead">Agent Name</th>
              <th class="filterhead">Nationality</th>
              <th class="filterhead">Customer Name</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $k=> $item)
                <tr>
                    <td>
                            <input type="checkbox" name="id[]" class="toedit" value="{{$item->id}}" />
                    </td>
                    <td>{{++$k}}</td>
                    <td>
                    <i data-feather='eye'
                            onclick="window.location.href='{{ route('ShowClawBack',$item->id) }}'"></i>
                    <i data-feather='edit'
                            onclick="window.location.href='{{ route('EditClawBack',$item->id) }}'"></i>
                    <i data-feather='trash'
                            onclick="window.location.href='{{ route('DeleteClawBack',$item->id) }}'"></i>
                    </td>
                    <td>{{$item->activation_date}}</td>
                    <td>{{$item->mobile_number}}</td>
                    {{-- <td>{{$item->email}}</td> --}}
                    <td>{{$item->lead_source}}</td>
                    <td>{{$item->account_number}}</td>
                    <td>{{$item->sim_serial_number}}</td>
                    <td>{{$item->contract_id}}</td>
                    <td>{{$item->status}}</td>
                    <td>{{$item->billing_cycle}}</td>
                    <td>{{$item->fbd}}</td>
                    <td>{{$item->fbd_bill_date}}</td>
                    <td>{{$item->fbd_21}}</td>
                    <td>{{$item->fbd_90}}</td>
                    <td>{{$item->sbd}}</td>
                    <td>{{$item->sbd_bill_date}}</td>
                    <td>{{$item->sbd_21}}</td>
                    <td>{{$item->sbd_90}}</td>
                    <td>{{$item->tbd}}</td>
                    <td>{{$item->tbd_bill_date}}</td>
                    <td>{{$item->tbd_21}}</td>
                    <td>{{$item->tbd_90}}</td>
                    <td>{{$item->total_pending}}</td>
                    <td>{{$item->clawback}}</td>
                    <td>{{$item->category}}</td>
                    <td>{{$item->plan_name}}</td>
                    <td>{{$item->agent_name}}</td>
                    <td>{{$item->nationality}}</td>
                    <td>{{$item->customer_name}}</td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>
  </div>
<input type="hidden" id="url" value="{{route('BulkClawBackDelete')}}">
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
    $('#pdf2').DataTable({
            "drawCallback": function( settings ) {
        feather.replace();
    },
    fixedHeader: {
             	 header: true,
               headerOffset: $('#basic-datatable').outerHeight()
             },
    dom: 'Bfrtip',
        buttons: [
{
                extend: 'excelHtml5',
                exportOptions: { orthogonal: 'export' }
            },        ],
    });

    var table = $('#pdf').DataTable({
        "drawCallback": function( settings ) {
        feather.replace();
    },
      orderCellsTop: true,
        dom: 'Bfrtip',
        scrollX: true,
        buttons: [
{
                extend: 'excelHtml5',
                exportOptions: { orthogonal: 'export' }
            },        ],
        initComplete: function () {
          var api = this.api();
            $('.filterhead', api.table().header()).each( function (i) {
              var column = api.column(i);
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(this).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' );
                } );
            } );
        }
    } );
//
// new DataTable('#example', {
//     fixedHeader: {
//         header: true,
//         footer: true
//     }
// });
});

$('#select-all').click(function() {
$(':checkbox').prop('checked',this.checked).change();
});

$("#BulkDelete").on('click', function () {

  if (confirm("are you sure  you want to delete, Kindly make sure before proceed?")) {

    var url = $("#url").val();
    var ids = [];
    $(".toedit").each(function () {
        if ($(this).is(":checked")) {
            ids.push($(this).val());
        }
    });
    if (ids.length) {
        $.ajax({
            type: 'POST',
            url: url,
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: ids
            },
            success: function (data) {
                // alert(data);
                window.location.reload();
                // $("p").text(data);
            }
        });
    } else {
        alert("Please select items.");
    }
}
});


</script>
  {{-- <script src="{{ asset(mix('js/scripts/tables/table-datatables-basic.js')) }}"></script> --}}
@endsection
