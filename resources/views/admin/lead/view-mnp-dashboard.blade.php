@extends('layouts/contentLayoutMaster')

@section('title', 'Leads Data')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection
@section('content')
<!-- Basic Horizontal form layout section start -->

<!-- Basic Horizontal form layout section end -->

<!-- Basic Vertical form layout section start -->
<section id="basic-vertical-layouts">
    <div class="row">

        <div class="col-md-12 col-12">
           <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{$status}} Data</h4>
                            {{-- <a class="btn btn-success" href="{{route('user.create')}}">Add New Users</a> --}}
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration" id="pdf">
                                        <thead>
                                            <tr>
                                                <th>S#</th>
                                                <th>Number</th>
                                                <th>Status</th>
                                                <th>Other Remarks</th>
                                                <th>Remarks By Team Leader</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $k => $item)

                                            <tr>
                                                <td>{{++$k}}</td>
                                                <td>{{$item->number}}</td>
                                                <td>{{$item->status}}</td>
                                                <td>{{$item->other_remarks}}</td>
                                                <td>{{$item->remarks_by_tl}}</td>
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
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection
@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/custom.js')) }}"></script>
<!-- Page js files -->
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>



@endsection



