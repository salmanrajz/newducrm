@extends('layouts/contentLayoutMaster')

@section('title', 'Users')

@section('content')
<!-- Basic Horizontal form layout section start -->

<!-- Basic Horizontal form layout section end -->

<!-- Basic Vertical form layout section start -->
@inject('provider', 'App\Http\Controllers\FunctionController')
<section id="basic-vertical-layouts">
  <div class="row">

    <div class="col-md-6 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Edit Users</h4>
        </div>
        <div class="card-body">
          <form class="form form-vertical"  id="MyRoleForm" onsubmit="return false">
            <div class="row">
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Users Name</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="first-name-icon" class="form-control" name="name"
                                            placeholder="Role Name" value="{{$data->name}}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Users Email</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="first-name-icon" class="form-control" name="email"
                                            placeholder="Role Name" value="{{$data->email}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Commitment Week</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <select name="week" id="week" class="form-control">
                                            <option value="1">1st Week</option>
                                            <option value="2">2nd Week</option>
                                            <option value="3">3rd Week</option>
                                            <option value="4">4th Week</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">No of Commitment</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="tel" name="commitment" id="commitment" class="form-control">
                                    </div>
                                </div>
                            </div>
                              <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Achieved  - Total Sale: {{$provider::MyTotalSale($data->id)}}

                                    </label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <select name="status" id="status" class="form-control">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="id" value="{{$data->id}}">


                            {{--  --}}
                            {{-- IMO END --}}
                            <div class="col-12">

                                <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>

                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary me-1"
                                    onclick="SavingActivationLead('{{ route('commitment.update') }}', 'MyRoleForm','{{ route('users') }}')">Submit</button>
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
          <h4 class="card-title">Monthly Commitment Form</h4>
        </div>
        <div class="card-body">
          <form class="form form-vertical">
            <div class="row">
              <div class="col-12">
                    <img id="CnicBackImg" src="{{env('CDN_URL')}}/user-cnic/{{$data->monthly_commitment}}" alt="your image" style="width:55%"/>
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
