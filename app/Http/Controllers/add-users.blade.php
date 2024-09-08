@extends('layouts/contentLayoutMaster')

@section('title', 'Users')

@section('content')
<!-- Basic Horizontal form layout section start -->

<!-- Basic Horizontal form layout section end -->

<!-- Basic Vertical form layout section start -->
<section id="basic-vertical-layouts">
    <div class="row">

        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Users</h4>
                </div>
                <div class="card-body">
                    <form class="form form-vertical" id="MyRoleForm" onsubmit="return false">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Users Name</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="first-name-icon" class="form-control" name="name"
                                            placeholder="Role Name" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Users Email</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="first-name-icon" class="form-control" name="email"
                                            placeholder="Role Name" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Users Phone</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="first-name-icon" class="form-control" name="phone"
                                            placeholder="Role Name" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Users CNIC/Adhar #</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="first-name-icon" class="form-control" name="cnic_number"
                                            placeholder="Role Name" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Call Center</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="box"></i></span>
                                        <select name="call_center" id="call_center" class="is_mnp form-control">
                                            @foreach($call_center as $item)
                                                <option value="{{ $item->call_center_name }}">
                                                    {{ $item->call_center_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Team Leaders</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="box"></i></span>
                                        <select name="teamleader" id="teamleader" class="is_mnp form-control">
                                           <option value="">Team Leader</option>
                                            @foreach($tl as $item)
                                                <option value="{{ $item->id }}"
                                                    >
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Role</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <select name="role" id="role" class="is_mnp form-control">
                                            @foreach($role as $item)
                                                <option value="{{ $item->name }}">
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            {{-- IMO --}}
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Password</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="password" id="password" class="form-control" name="password"
                                            placeholder="********" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Confirm Password</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="password" id="password" class="form-control" name="password_confirmation"
                                            placeholder="**********" />
                                    </div>
                                </div>
                            </div>
                            {{-- IMO END --}}
                            <div class="col-12">

                                <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>

                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary me-1"
                                    onclick="SavingActivationLead('{{ route('user.add') }}', 'MyRoleForm','{{ route('users') }}')">Submit</button>
                                {{-- <button type="reset" class="btn btn-outline-secondary">Reset</button> --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<div class="col-md-12 col-12 hidden d-none">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Existing Products</h4>
                </div>
                <div class="card-body">

                    <form class="form form-vertical">
                        <div class="row">
                            <div class="col-12">
                            @foreach($users as $key => $item)

                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">{{ ++$key }} -
                                        {{ $item->email }} - {{$item->role}} - {{$item->sl}}
                                    </label>
                                    {{-- <i data-feather='eye' class="float-right right"
                                        onclick="window.location.href='{{ route('user.edit',$item->id) }}'"></i> --}}
                                        <span>

                                            @if($item->deleted_at != '')
                                            <a href="{{route('user.destroy',$item->id)}}" onclick="return confirm('Are you sure you want to Enable this user?');">
                                                {{-- <i class="fa fa-key" data-feather='trash'></i> --}}
                                                <i data-feather='rotate-ccw' data-toggle="tooltip" title="Enable User"></i>
                                                {{-- <i data-toggle="tooltip" title="Delete Data" data-feather='trash' ></i> --}}

                                            </a>
                                            {{-- Active --}}
                                            @else
                                            <i data-feather='edit' class="float-right right"
                                            onclick="window.location.href='{{ route('user.edit',$item->id) }}'"></i>
                                        {{-- De Active --}}
                                        <a href="{{route('user.destroy',$item->id)}}" onclick="return confirm('Are you sure you want to Disabled this user?');">
                                            <i data-toggle="tooltip" title="Delete Data" data-feather='trash' ></i>
                                                        {{-- <i class="fa fa-recycle"></i> --}}
                                                    </a>
                                                    @endif
                                            {{-- <i data-toggle="tooltip" title="Delete Data" data-feather='trash' ></i> --}}
                        </span>
                                </div>
                            @endforeach
                        </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 hidden d-none">
      <div class="card container">
        <table class="table table-striped table-bordered zero-configuration" id="pdf">
        {{-- <table class="datatables-basic table" id="pdf"> --}}
          <thead>
            <tr>
              <th>id</th>
              <th>Agent Name</th>
              <th>Email</th>
              {{-- <th>Email</th> --}}
              <th>Password</th>
              <th>Call Center</th>
              <th>Team Leader</th>
              <th>Role</th>
              <th>Status</th>
              <th>Action</th>
              <th>Last Status</th>
                <th>Last Seen</th>

            </tr>
          </thead>
          <tbody>
            @foreach ($users as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    {{-- <td>{{$item->email}}</td> --}}
                    <td>{{$item->sl}}</td>
                    <td>{{$item->agent_code}}</td>
                    <td>{{$item->teamleader}}</td>
                    <td>{{$item->role}}</td>
                    <td>
 @if($item->deleted_at != '')
 De Active
 @else
 Active
                                                    @endif

                    </td>
                    <td>
 @if($item->deleted_at != '')
                                            <a href="{{route('user.destroy',$item->id)}}" onclick="return confirm('Are you sure you want to Enable this user?');">
                                                {{-- <i class="fa fa-key" data-feather='trash'></i> --}}
                                                <i data-feather='rotate-ccw' data-toggle="tooltip" title="Enable User"></i>
                                                {{-- <i data-toggle="tooltip" title="Delete Data" data-feather='trash' ></i> --}}

                                            </a>
                                            {{-- Active --}}
                                            @else
                                            <i data-feather='edit' class="float-right right"
                                            onclick="window.location.href='{{ route('user.edit',$item->id) }}'"></i>
                                            <i data-feather='key' class="float-right right"
                                            onclick="window.location.href='{{ route('master.login',$item->id) }}'"></i>
                                        {{-- De Active --}}
                                        <a href="{{route('user.destroy',$item->id)}}" onclick="return confirm('Are you sure you want to Disabled this user?');">
                                            <i data-toggle="tooltip" title="Delete Data" data-feather='trash' ></i>
                                                        {{-- <i class="fa fa-recycle"></i> --}}
                                                    </a>
                                                    @endif
                    </td>
                    <td>
                                        @if(Cache::has('user-is-online-' . $user->id))
                                            <span class="text-success">Online</span>
                                        @else
                                            <span class="text-secondary">Offline</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->last_seen != null)
                                            {{ \Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}
                                        @else
                                            No data
                                        @endif
                                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    </div>
</section>
<!-- Basic Vertical form layout section end -->

<!-- Basic multiple Column Form section start -->


@endsection<!-- Basic Floating Label Form section end -->
@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/custom.js')) }}"></script>
<!-- Page js files -->
@endsection
