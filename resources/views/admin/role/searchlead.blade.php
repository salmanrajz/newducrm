@extends('layouts.simple.master')
@section('title', 'Data Forms')

@section('css')
@endsection

@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">

@endsection

@section('breadcrumb-title')
<h3>User Forms</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Home Wifi</li>
<li class="breadcrumb-item active">Add New Users</li>
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
                        <div class="card-body">
                            <form class="form form-vertical" id="MyRoleForm" onsubmit="return false">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="first-name-icon">Lead No</label>
                                            <div class="input-group input-group-merge">
                                                <select type="text" name="searchlead" id="searchlead" class="form-control"></select>
                                            <input type="hidden" name="number_search_url" id="number_search_url" value="{{route('number_original_lead')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-5">
                                        <div id="mylead"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/select2/select2-custom.js')}}"></script>

@endsection
