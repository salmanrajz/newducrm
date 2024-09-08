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
          <h4 class="card-title">Add Products</h4>
        </div>
        <div class="card-body">
          <form class="form form-vertical"  id="MyRoleForm">
            <div class="row">
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
                    />
                  </div>
                </div>
                <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
              </div>

              <div class="col-12">
                <button type="submit" class="btn btn-primary me-1" onclick="SavingActivationLead('{{route('role.add')}}', 'MyRoleForm','{{route('role')}}')">Submit</button>
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
                    <label class="form-label" for="first-name-icon">{{++$key}} - {{$item->name}}
                    </label>
                    <i data-feather='edit' class="float-right right" onclick="window.location.href='{{route('product.edit',$item->id)}}'"></i>
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
