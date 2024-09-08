
@extends('layouts/contentLayoutMaster')

@section('title', 'Training Category Management')

@section('vendor-style')
  {{-- vendor css files --}}
  {{-- <link rel="stylesheet" href="{{ asset('admin/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/extensions/toastr.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">

@endsection

@section('content')
{{-- <div class="row">
  <div class="col-12">
    <p>Read full documnetation <a href="https://datatables.net/" target="_blank">here</a></p>
  </div>
</div> --}}
<!-- Basic table -->
<section id="basic-datatable">
  <div class="row">
    <div class="container mb-2">
        <button class="btn btn-success" onclick="window.location.href='{{route('addcategory')}}'">Add New</button>
    </div>
    <div class="col-12">
      <div class="card">
        <table class="datatables-basic table">
          <thead>
            <tr>
              <th>id</th>
              <th>Name</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($data as $key => $item)
              <tr>
                <td>{{++$key}}</td>
                <td>{{$item->category_name}}</td>
                <td>
                    @if($item->status == 1)
                    Enable
                    @else
                    Disable
                    @endif
                </td>
                 <td class="product-action">
                        <span>
                                <i data-toggle="tooltip" title="Edit Data" data-feather='edit' onclick="window.location.href='{{route('edit.category.index',$item->id)}}'"></i>
                        </span>
                        <span>
                          {{-- <i data-feather='trash'></i> --}}
                                <i data-toggle="tooltip" title="Delete Data" data-feather='trash' onclick="DeleteData('{{ $item->id }}','{{route('exam.category.delete')}}')"></i>
                        </span>
              </td>
              </tr>
              @endforeach

          </tbody>
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
  {{-- <script src="{{ asset('admin/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/tables/datatable/responsive.bootstrap4.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/tables/datatable/jszip.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/extensions/toastr.min.js') }}"></script> --}}
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
<script src="{{ asset(mix('js/custom.js')) }}"></script>

  {{-- <script src="{{asset('admin/js/main.js')}}"></script> --}}
  {{-- <script src="{{ asset('js/scripts/tables/table-datatables-basic.js') }}"></script> --}}
@endsection
