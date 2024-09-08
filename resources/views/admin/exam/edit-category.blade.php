@extends('layouts/contentLayoutMaster')

@section('title', 'Training Category')

@section('content')
<!-- Basic Horizontal form layout section start -->

<!-- Basic Horizontal form layout section end -->

<!-- Basic Vertical form layout section start -->
<section id="basic-vertical-layouts">
  <div class="row">

    <div class="col-md-6 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Add Training Category</h4>
        </div>
        <div class="card-body">
          <form class="form form-vertical"  id="MyRoleForm" onsubmit="return false">
            <div class="row">
              <div class="col-12">
                <div class="mb-1">
                  <label class="form-label" for="first-name-icon">Category Name</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text"><i data-feather="user"></i></span>
                    <input
                      type="text"
                      id="first-name-icon"
                      class="form-control"
                      name="category_name"
                      placeholder="Role Name"
                      value="{{$role->category_name}}"
                    />
                  </div>
                </div>

              </div>
              <input type="hidden" name="id" value="{{$role->id}}">
              <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Category Status</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="box"></i></span>
                                        <select name="status" id="status" class="status form-control">
                                            <option value="1" @if ($role->status == '1') {{ 'selected' }} @endif>Yes</option>
                                            <option value="0" @if ($role->status == '0') {{ 'selected' }} @endif>No</option>
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
                <button type="submit" class="btn btn-primary me-1" onclick="SavingActivationLead('{{route('exam.EditBlogCategory')}}', 'MyRoleForm','{{route('exam.category.index')}}')">Submit</button>
                {{-- <button type="reset" class="btn btn-outline-secondary">Reset</button> --}}
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
