@extends('layouts/contentLayoutMaster')

@section('title', 'Plans')

@section('content')
<!-- Basic Horizontal form layout section start -->

<!-- Basic Horizontal form layout section end -->

<!-- Basic Vertical form layout section start -->
<section id="basic-vertical-layouts">
  <div class="row">

    <div class="col-md-6 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Edit Plan</h4>
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

                      value="{{$data->plan_name}}"
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

                      value="{{$data->plan_names_du}}"
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

                      value="{{$data->local_minutes}}"
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

                      value="{{$data->flexible_minutes}}"

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

                      value="{{$data->data}}"

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

                      value="{{$data->free_minutes}}"

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

                      value="{{$data->monthly_payment}}"

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
                        <option value="12 Years" @if ($data->duration == '12 Years') {{ 'selected' }} @endif>12 Years</option>
                        <option value="24 Years" @if ($data->duration == '24 Years') {{ 'selected' }} @endif>24 Years</option>
                        <option value="No Contract" @if ($data->duration == 'No Contract') {{ 'selected' }} @endif>No Contract</option>
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

                      value="{{$data->revenue}}"

                    />
                  </div>
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
                      name="revenue_port"

                      value="{{$data->revenue_port}}"

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
                        <option value="1" @if ($data->status == '1') {{ 'selected' }} @endif>Enable</option>
                        <option value="0" @if ($data->status == '0') {{ 'selected' }} @endif>Disabled</option>
                    </select>
                </div>
            </div>
            </div>
            <div class="col-12">

                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
            </div>
            <input type="hidden" name="id" value="{{$data->id}}">

              <div class="col-12">
            <button type="submit" class="btn btn-primary me-1" onclick="SavingActivationLead('{{route('plan.edit.update')}}', 'MyRoleForm','{{route('plan')}}')">Submit</button>
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
