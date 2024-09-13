@extends('layouts.simple.master')
@section('title', 'Data Forms')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Data Forms</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Home Wifi</li>
<li class="breadcrumb-item active">Data Forms</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">

    <div class="col-md-6 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Generate Code</h4>
        </div>
        <div class="card-body">
          <form class="form form-vertical"  id="MyRoleForm">
            <div class="row">
              <div class="col-12">
                <div class="mb-1">
                  <label class="form-label" for="first-name-icon">Customer Number</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text"><i data-feather="user"></i></span>
                    <input
                      type="tel"
                      class="form-control"
                      name="cnumber"
                      placeholder="Customer Number"
                    />
                  </div>
                </div>
                <div class="mb-1">
                  <label class="form-label" for="first-name-icon">Old Short Code</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text"><i data-feather="user"></i></span>
                    <input
                      type="tel"
                      class="form-control"
                      name="old_code"
                      placeholder="Old Code"
                    />
                  </div>
                </div>

                <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
              </div>

              <div class="col-12 mt-5">
                <button type="button" class="btn btn-primary me-1" onclick="SavingActivationLead('{{route('GenerateCode')}}', 'MyRoleForm','{{route('home')}}')">Submit</button>
                {{-- <button type="button" class="btn btn-primary me-1" onclick="SavingActivationLead('{{route('role.add')}}', 'MyRoleForm','{{route('role')}}')">Check Existing Code</button> --}}
                {{-- <button type="reset" class="btn btn-outline-secondary">Reset</button> --}}
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection

@section('script')

@endsection
