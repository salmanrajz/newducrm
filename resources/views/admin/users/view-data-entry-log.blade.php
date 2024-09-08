@extends('layouts/contentLayoutMaster')

@section('title', 'Users')

@section('content')
<!-- Basic Horizontal form layout section start -->

<!-- Basic Horizontal form layout section end -->

<!-- Basic Vertical form layout section start -->
<section id="basic-vertical-layouts">

    <div class="row">

        @inject('provider', 'App\Http\Controllers\FunctionController')



        <div class="col-12">
            <div class="card container table">
                <table class="table table-bordered zero-configuration">
                    {{-- <table class="datatables-basic table" id="pdf"> --}}
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Agent Name</th>
                            <th>Daily Entry</th>
                            <th>Daily Entry HWP</th>
                            <th>Daily Entry HWE</th>
                            <th>Daily Entry PP</th>
                            <th>Daily Entry All</th>
                            <th>Last Seen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>
                                {{$provider::DataEntryCountLog('All',$item->id,'Daily')}}
                            </td>
                            <td>
                                {{$provider::DataEntryCountLog('Home Wireless Plus',$item->id,'Daily')}}
                            </td>
                            <td>
                                {{$provider::DataEntryCountLog('Home Wireless Entertainment',$item->id,'Daily')}}
                            </td>
                            <td>
                                {{$provider::DataEntryCountLog('Postpaid',$item->id,'Daily')}}
                            </td>
                            <td>
                                {{$provider::DataEntryCountLog('All',$item->id,'Daily')}}
                            </td>
                            <td>
                                @if($item->last_seen != null)
                                {{ \Carbon\Carbon::parse($item->last_seen)->diffForHumans() }}
                                @else
                                No data
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <h2>Monthly Report</h2>
                <table class="table table-bordered zero-configuration">
                    {{-- <table class="datatables-basic table" id="pdf"> --}}
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Agent Name</th>
                            <th>Monthly Entry</th>
                            <th>Monthly Entry HWP</th>
                            <th>Monthly Entry HWE</th>
                            <th>Monthly Entry PP</th>
                            <th>Monthly Entry All</th>

                            <th>Last Seen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>
                                {{$provider::DataEntryCountLog('All',$item->id,'Monthly')}}
                            </td>
                            <td>
                                {{$provider::DataEntryCountLog('Home Wireless Plus',$item->id,'Monthly')}}
                            </td>
                            <td>
                                {{$provider::DataEntryCountLog('Home Wireless Entertainment',$item->id,'Monthly')}}
                            </td>
                            <td>
                                {{$provider::DataEntryCountLog('Postpaid',$item->id,'Monthly')}}
                            </td>
                            <td>
                                {{$provider::DataEntryCountLog('All',$item->id,'Monthly')}}
                            </td>
                            <td>
                                @if($item->last_seen != null)
                                {{ \Carbon\Carbon::parse($item->last_seen)->diffForHumans() }}
                                @else
                                No data
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


@endsection
<!-- Basic Floating Label Form section end -->
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
            "drawCallback": function (settings) {
                feather.replace();
            }
        });
    });

</script>
<!-- Page js files -->
@endsection
