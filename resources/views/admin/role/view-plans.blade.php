@extends('layouts/contentLayoutMaster')

@section('title', 'Plan')

@section('content')
<!-- Basic Horizontal form layout section start -->

<!-- Basic Horizontal form layout section end -->

<!-- Basic Vertical form layout section start -->
<section id="basic-vertical-layouts">
  <div class="row">

    <div class="col-md-6 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Add Plan</h4>
        </div>
        <div class="card-body">
          <form class="form form-vertical"  id="MyRoleForm" onsubmit="return false">
            <div class="row">
              <div class="col-12">
                <div class="mb-1">
                  <label class="form-label" for="first-name-icon">Plan Name</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text"><i data-feather="user"></i></span>
                    <input
                      type="text"
                      id="first-name-icon"
                      class="form-control"
                      name="plan_name"
                      placeholder="Role Name"
                    />
                  </div>
                </div>
            </div>
              <div class="col-12">
                <div class="mb-1">
                  <label class="form-label" for="first-name-icon">CRM Plan Name</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text"><i data-feather="user"></i></span>
                    <input
                      type="text"
                      id="first-name-icon"
                      class="form-control"
                      name="plan_names_du"
                      placeholder="CRM Plan Name"
                    />
                  </div>
                </div>
            </div>
              <div class="col-12">
                <div class="mb-1">
                  <label class="form-label" for="first-name-icon">Local Minutes</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text"><i data-feather="user"></i></span>
                    <input
                      type="text"
                      id="first-name-icon"
                      class="form-control"
                      name="local_minutes"
                      placeholder="Role Name"
                    />
                  </div>
                </div>
            </div>
              <div class="col-12">
                <div class="mb-1">
                  <label class="form-label" for="first-name-icon">Flexible Minute</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text"><i data-feather="user"></i></span>
                    <input
                      type="text"
                      id="first-name-icon"
                      class="form-control"
                      name="flexible_minutes"
                      placeholder="Role Name"
                    />
                  </div>
                </div>
            </div>
              <div class="col-12">
                <div class="mb-1">
                  <label class="form-label" for="first-name-icon">Data</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text"><i data-feather="user"></i></span>
                    <input
                      type="text"
                      id="first-name-icon"
                      class="form-control"
                      name="data"
                      placeholder="Role Name"
                    />
                  </div>
                </div>
            </div>
              <div class="col-12">
                <div class="mb-1">
                  <label class="form-label" for="first-name-icon">Free Minutes</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text"><i data-feather="user"></i></span>
                    <input
                      type="text"
                      id="first-name-icon"
                      class="form-control"
                      name="free_minutes"
                      placeholder="Role Name"
                    />
                  </div>
                </div>
            </div>
              <div class="col-12">
                <div class="mb-1">
                  <label class="form-label" for="first-name-icon">Monthly Payment</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text"><i data-feather="user"></i></span>
                    <input
                      type="text"
                      id="first-name-icon"
                      class="form-control"
                      name="monthly_payment"
                      placeholder="Role Name"
                    />
                  </div>
                </div>
            </div>
              <div class="col-12">
                <div class="mb-1">
                  <label class="form-label" for="first-name-icon">Duration</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text"><i data-feather="user"></i></span>
                    <select name="duration" id="duration" class="form-control">
                        <option value="12 Years">12 Years</option>
                        <option value="24 Years">24 Years</option>
                        <option value="No Contract">No Contract</option>
                    </select>
                </div>
            </div>
              <div class="col-12">
                <div class="mb-1">
                  <label class="form-label" for="first-name-icon">Points</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text"><i data-feather="user"></i></span>
                    <input
                      type="text"
                      id="first-name-icon"
                      class="form-control"
                      name="revenue"
                      placeholder="Role Name"
                    />
                  </div>
                </div>
            </div>
              <div class="col-12">
                <div class="mb-1">
                  <label class="form-label" for="first-name-icon">Status</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text"><i data-feather="user"></i></span>
                    <select name="status" id="status" class="form-control">
                        <option value="1">Enable</option>
                        <option value="0">Disabled</option>
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
                <button type="submit" class="btn btn-primary me-1" onclick="SavingActivationLead('{{route('plan.add')}}', 'MyRoleForm','{{route('plan')}}')">Submit</button>
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
          <h4 class="card-title">Existing Plan</h4>
        </div>
        <div class="card-body">
          <form class="form form-vertical">
            <div class="row">
              <div class="col-12">
                @foreach ($role as $key => $item)

                <div class="mb-1">
                    <label class="form-label" for="first-name-icon">{{++$key}} - {{$item->plan_name}}
                    </label>
                    <i data-feather='edit' class="float-right right" onclick="window.location.href='{{route('plan.edit',$item->id)}}'"></i>
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
