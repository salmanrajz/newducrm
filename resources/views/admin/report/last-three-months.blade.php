
@extends('layouts/contentLayoutMaster')

@section('title', 'Daily Report')

@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection

@section('content')
@inject('provider', 'App\Http\Controllers\FunctionController')
<!-- Basic table -->
<section id="basic-datatable">
  <div class="row">
    <h3>Activation Comparison</h3>
    <div class="col-12">
      <div class="table-responsive">
        <table class="table table-striped table-bordered zero-configuration" >
            {{-- <table class="datatables-basic table" id="pdf"> --}}
                <thead>
            <tr>
              <th >Date</th>
              @foreach ($data as $item)
                <th>{{$item['month']}}</th>
              @endforeach
            </tr>
                </thead>

                <tbody>
                    <tr>
                        @php
                        $startDate = \Carbon\Carbon::now()->subMonth(); //returns current day
                        $now = $startDate->firstOfMonth();
                        $first_date = $startDate->firstOfMonth();
                        $start = \Carbon\Carbon::now()->subMonth();
                        $dates = [$now->format('d')];
                        $m= \Carbon\Carbon::now()->format('d');
                        @endphp
                        @for($i = 1; $i <=$m; $i++)
                        <td>

                        @if($i == 1)
                            {{$now->format('d')}}
                        @else
                            {{$a = $now->addDays(1)->format('d')}}
                        @endif
                        </td>
                        @foreach ($data as $item)
                            <td>
                                @php
                                $z = $i . '/' . $item['monthId'] .'/'. $item['year'];
                                // $z = '01-Nov-2023';
                                 $k = Carbon\Carbon::createFromFormat('d/m/Y', $z)->toDateString();
                                 // $shipDate = \Carbon\Carbon::createFromFormat('d-m-Y H:i',\Carbon\Carbon::parse($z)->format('d-M-Y'));

                                 //    echo $m =  \Carbon\Carbon::createFromFormat('Y-m-d', $z)->format('d-M-Y')

                                 @endphp
                                 {{$a = $provider::DateActivation($k,'CL1')}}
                                {{-- {{$z = $i .' '.$item['month']}} --}}
                            </td>
                        @endforeach
                    </tr>
                    @endfor



        </table>
      </div>

    </div>
  </div>
  <!-- Modal to add new record -->

</section>
<section id="basic-datatable">
    <h3>Submission Comparison</h3>

  <div class="row">
    <div class="col-12">
      <div class="table-responsive">
        <table class="table table-striped table-bordered zero-configuration" >
            {{-- <table class="datatables-basic table" id="pdf"> --}}
                <thead>
            <tr>
              <th >Date</th>
              @foreach ($data as $item)
                <th>{{$item['month']}}</th>
              @endforeach
            </tr>
                </thead>

                <tbody>
                    <tr>
                        @php
                        $startDate = \Carbon\Carbon::now()->subMonth(); //returns current day
                        $now = $startDate->firstOfMonth();
                        $first_date = $startDate->firstOfMonth();
                        $start = \Carbon\Carbon::now()->subMonth();
                        $dates = [$now->format('d')];
                        $m= \Carbon\Carbon::now()->format('d');
                        @endphp
                        @for($i = 1; $i <=$m; $i++)
                        <td>

                        @if($i == 1)
                            {{$now->format('d')}}
                        @else
                            {{$a = $now->addDays(1)->format('d')}}
                        @endif
                        </td>
                        @foreach ($data as $item)
                            <td>
                                @php
                                $z = $i . '/' . $item['monthId'] .'/'. $item['year'];
                                // $z = '01-Nov-2023';
                                 $k = Carbon\Carbon::createFromFormat('d/m/Y', $z)->toDateString();
                                 // $shipDate = \Carbon\Carbon::createFromFormat('d-m-Y H:i',\Carbon\Carbon::parse($z)->format('d-M-Y'));

                                 //    echo $m =  \Carbon\Carbon::createFromFormat('Y-m-d', $z)->format('d-M-Y')

                                 @endphp
                                 {{$a = $provider::DateSubmission($k,'CL1')}}
                                {{-- {{$z = $i .' '.$item['month']}} --}}
                            </td>
                        @endforeach
                    </tr>
                    @endfor



        </table>
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
        // dom: 'Bfrtip',
        // buttons: [
        //     'copy', 'csv', 'excel', 'pdf', 'print'
        // ]

    });
    $('#pdf2').DataTable({
        // dom: 'Bfrtip',
        // buttons: [
        //     'copy', 'csv', 'excel', 'pdf', 'print'
        // ]
    });
});
</script>
  {{-- <script src="{{ asset(mix('js/scripts/tables/table-datatables-basic.js')) }}"></script> --}}
@endsection
