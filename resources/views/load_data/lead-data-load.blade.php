<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">

<!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <h3>{{$heading}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Lead No</th>
                                        <th>Customer Number</th>
                                        <th>Plan</th>
                                        <th>Status</th>
                                        {{-- <th>Salary</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($data as $item)

                                    <tr>
                                        <td>{{$item->customer_name}}</td>
                                        <td>{{$item->lead_no}}</td>
                                        <td>{{$item->customer_number}}</td>
                                        <td>{{$item->lead_type}}</td>
                                        <td>{{$item->status}}</td>
                                        {{-- <td>$112,000</td> --}}
                                        <td>
                                            <ul class="action">
                                                @role('Sale|MainAdmin')
                                                <li class="edit"> <a href="{{route('view.lead',$item->id)}}"><i class="icon-eye" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal"></i></a>
                                                </li>
                                                @endrole
                                                @role('Activator')
                                                <li class="edit"> <a href="{{route('precheck.lead',$item->id)}}"><i class="icon-eye" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal"></i></a>
                                                </li>
                                                @endrole
                                                @role('Verification')
                                                <li class="edit"> <a href="{{route('verification.lead',$item->id)}}"><i class="icon-eye" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal"></i></a>
                                                </li>
                                                @endrole
                                            </ul>
                                        </td>
                                    </tr>
                                   @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Zero Configuration  Ends-->


 {{-- @section('script') --}}
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
    {{-- <script>
        $(document).ready(function () {
    $('#basic-1').DataTable({
        dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script> --}}
{{-- @endsection --}}
