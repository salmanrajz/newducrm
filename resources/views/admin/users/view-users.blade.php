@extends('layouts.simple.master')
@section('title', 'Data Forms')

@section('css')
@endsection

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">

@endsection

@section('breadcrumb-title')
<h3>View Users</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Users</li>
<li class="breadcrumb-item active">View Users</li>

@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-xl-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Data form</h5>
                        </div>
                       <div class="table-responsive">
                            <table class="display" id="basic-1">
        {{-- <table class="datatables-basic table" id="pdf"> --}}
          <thead>
            <tr>
              <th>id</th>
              <th>Agent Name</th>
              <th>Email</th>
              <th>CNIC</th>
              <th>Contact #</th>
              <th>Password</th>
              <th>Call Center</th>
              <th>Team Leader</th>
              <th>JobType</th>
              <th>Role</th>
              <th>Oath</th>
              <th>CMT</th>
              <th>Status</th>
              <th>Action</th>
              <th>Joined Yet</th>
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
                    <td>{{$item->cnic_number}}</td>
                    <td>{{$item->phone}}</td>
                    <td>{{$item->sl}}</td>
                    <td>{{$item->agent_code}}</td>
                    <td>
                        @php
                        $s = \App\Models\User::where('id',$item->teamleader)->first();
                        if($s){
                            echo $s->name;
                        }
                        @endphp
                        {{-- {{$item->teamleader}} --}}
                    </td>
                    <td>{{$item->jobtype}}</td>
                    <td>{{$item->role}}</td>
                    <td>{{$item->oath_form}}</td>
                    <td>{{$item->monthly_commitment}}</td>
                    <td>
 @if($item->deleted_at != '')
 Closed
 @else
 Active
                                                    @endif

                    </td>
                    <td>
                        {{$item->created_at}}
                    </td>
                    <td>
 @if($item->deleted_at != '')
                                            <a href="{{route('user.destroy',$item->id)}}" onclick="return confirm('Are you sure you want to Enable this user?');">
                                                {{-- <i class="fa fa-key" data-feather='trash'></i> --}}
                                                {{-- <i data-feather='rotate-ccw' data-toggle="tooltip" title="Enable User"></i> --}}
                                                {{-- <i data-toggle="tooltip" title="Delete Data" data-feather='trash' ></i> --}}
                                                <span class="fa fa-recycle"></span>

                                            </a>
                                            {{-- Active --}}
                                            @else
                                            <a href="{{route('user.edit',$item->id)}}">EDIT</a>
                                            <a href="{{route('add.commitment',$item->id)}}">Add Commitment</a>
                                        {{-- <i data-feather="activity"></i> --}}

                                            <i  class="fa fa-key float-right right"
                                            onclick="window.location.href='{{ route('master.login',$item->id) }}'"></i>
                                            {{-- <div class="fa fa-key"></div> --}}

                                        {{-- De Active --}}
                                        <a href="{{route('user.destroy',$item->id)}}" onclick="return confirm('Are you sure you want to Disabled this user?');">
                                            <i data-toggle="tooltip" title="Delete Data" class='fa fa-trash' ></i>
                                                        {{-- <i class="fa fa-recycle"></i> --}}
                                                    </a>
                                                    @endif
                    </td>
                    <td>
                                        @if(Cache::has('user-is-online-' . $item->id))
                                            <span class="text-success">Online</span>
                                        @else
                                            <span class="text-secondary">Offline</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->last_seen != null)
                                            {{ \Carbon\Carbon::parse($item->last_seen)->diffForHumans() }}
                                        @else
                                            No data
                                        @endif
                                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
    {{-- <script src="{{asset('assets/js/icons/feather-icon/feather-icon-clipart.js')}}"></script> --}}

@endsection
