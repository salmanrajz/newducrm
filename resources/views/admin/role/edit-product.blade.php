@extends('layouts/contentLayoutMaster')

@section('title', 'Products')

@section('content')
<!-- Basic Horizontal form layout section start -->

<!-- Basic Horizontal form layout section end -->

<!-- Basic Vertical form layout section start -->
<section id="basic-vertical-layouts">
  <div class="row">

    <div class="col-md-6 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Edit Products</h4>
        </div>
        <div class="card-body">
          <form class="form form-vertical"  id="MyRoleForm">
            <div class="row">
                <input type="hidden" name="id" value="{{$data->id}}">
              <div class="col-12">
                <div class="mb-1">
                  <label class="form-label" for="first-name-icon">Products Name</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text"><i data-feather="user"></i></span>
                    <input
                      type="text"
                      id="first-name-icon"
                      class="form-control"
                      name="name"
                      placeholder="Role Name"
                      value="{{$data->name}}"
                    />
                  </div>
                </div>
            </div>
              <div class="col-12">
                <div class="mb-1">
                  <label class="form-label" for="first-name-icon">Products Status</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text"><i data-feather="box"></i></span>
                    <select name="status"  id="status" class="status form-control"  >
                                    <option value="1" @if ($data->status == '1') {{ 'selected' }} @endif>Yes</option>
                                    <option value="0" @if ($data->status == '0') {{ 'selected' }} @endif>No</option>
                                    </select>
                </div>
            </div>
            </div>
            <div class="col-12">

                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
            </div>

              <div class="col-12">
                <button type="submit" class="btn btn-primary me-1" onclick="SavingActivationLead('{{route('product.edit.update')}}', 'MyRoleForm','{{route('product')}}')">Submit</button>
                {{-- <button type="reset" class="btn btn-outline-secondary">Reset</button> --}}
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Existing Products</h4>
        </div>
        <div class="card-body">
          <form class="form form-vertical">
            <div class="row">
              <div class="col-12">
                @foreach ($role as $key => $item)

                <div class="mb-1">
                    <label class="form-label" for="first-name-icon">{{++$key}} - {{$item->name}}</label>
                </div>
                @endforeach
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Basic Vertical form layout section end -->

<!-- Basic multiple Column Form section start -->


@endsection<!-- Basic Floating Label Form section end -->
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/custom.js'))}}"></script>
  <!-- Page js files -->
@endsection
