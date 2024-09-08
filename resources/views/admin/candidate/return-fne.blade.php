@extends('layouts/contentLayoutMaster')

@section('title', 'New FNE Request')

@section('content')
<!-- Basic Horizontal form layout section start -->

<!-- Basic Horizontal form layout section end -->

<!-- Basic Vertical form layout section start -->
<section id="basic-vertical-layouts">
    <div class="row">

        <div class="col-md-12 col-12">
            <div class="card">

                <div class="card-header">
                    <h4 class="card-title">FNE Request</h4>
                </div>
                <div class="card-body">
                    <form class="form form-vertical" id="MyRoleForm" onsubmit="return false">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Agent Name:</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="full_name" class="form-control" name="building"
                                            placeholder="Building Name"
                                            value="{{$data->name}}"
                                            />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Agent Email:</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="full_name" class="form-control" name="building"
                                            placeholder="Building Name"
                                            value="{{$data->email}}"
                                            />
                                    </div>
                                </div>
                            </div>
                            {{--  --}}
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Customer Name:</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text"  id="first-name-icon"
                                            class="form-control" name="customer_name" placeholder="Salman"
                                            value="{{$data->customer_name}}"
                                            />
                                    </div>
                                </div>
                            </div>

                           <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">FNE Plan - {{$data->plan}}</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <select name="plans" id="plans" class="is_mnp form-control" required>
                                            <option value="">Select Plan</option>
                                            @foreach($planwifi as $item)
                                                <option value="{{ $item->id }}" {{$data->plan == $item->id ? 'selected' : ''}}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                           <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Activity #</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" name="fne_activity_number" id="fne_activity_number" class="form-control"
                                        {{-- value="{{$data->fne_activity_number}}" --}}
                                        value="{{$data->fne_activity_number == '' ? 'NOT GENERATED YET' : $data->fne_activity_number}}"
                                        >
                                    </div>
                                </div>
                            </div>


                           <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Work Order #</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" name="fne_work_order_num" id="fne_work_order_num" class="form-control"
                                        {{-- value="{{$data->fne_work_order_num}}" --}}
                                        value="{{$data->fne_work_order_num == '' ? 'NOT GENERATED YET' : $data->fne_work_order_num}}"


                                        >
                                    </div>
                                </div>
                            </div>

                           <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Visit Date:</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" name="fne_visit_date" id="fne_visit_date" class="form-control"
                                        {{-- value="{{$data->fne_visit_date}}" --}}
                                        value="{{$data->fne_visit_date == '' ? 'NOT GENERATED YET' : $data->fne_visit_date}}"


                                        >
                                    </div>
                                </div>
                            </div>
                           <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Return Remarks:</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" name="return_remarks" id="return_remarks" class="return_remarks form-control" >
                                    </div>
                                </div>
                            </div>


                            <input type="hidden" name="id" value="{{$data->id}}">
                            <input type="hidden" name="fne_id" value="{{$data->fne_id}}">
                            <input type="hidden" name="uniquestatus" id="remarks" class="form-control" value="">




                            {{-- IMO END --}}
                            <div class="col-12">
                                <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-success me-1"
                                    onclick="SavingActivationLead('{{ route('update.return.fne') }}', 'MyRoleForm','{{ route('home') }}')">Submit</button>
                                {{-- <button type="submit" class="btn btn-primary me-1"
                                id="DuResource"
                                    onclick="SavingActivationLead('{{ route('SendForApproval') }}', 'MyRoleForm','{{ route('home') }}')">Send for Approval</button>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                        Add Activity & WO
                                </button> --}}


                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{--  --}}
        <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

        {{--  --}}
    </div>
</section>
<!-- Basic Vertical form layout section end -->

<!-- Basic multiple Column Form section start -->

<input type="hidden" name="leadid" id="leadid" value="{{$data->id}}">
<input type="hidden" name="leadid" id="fne_id" value="{{$data->fne_id}}">

@include('admin.chat.chat-fne')

@endsection<!-- Basic Floating Label Form section end -->
@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/custom.js')) }}"></script>
<!-- Page js files -->
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script>
    $(":input").inputmask();

</script>
@endsection
