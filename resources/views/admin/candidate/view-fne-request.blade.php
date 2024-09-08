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
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Building Name:</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="full_name" class="form-control" name="building"
                                            placeholder="Building Name"
                                            value="{{$data->building}}"
                                            />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Unit Name:</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="full_name" class="form-control" name="unit"
                                            placeholder="Unit Name"                                             value="{{$data->unit}}"
 />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Full Address: </label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="first-name-icon" class="form-control" name="address"
                                            placeholder="Full Address"
                                            value="{{$data->address}}"

                                            />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Google Location Url:</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text"  id="first-name-icon"
                                            class="form-control" name="google_location" placeholder="https://maps.google.com"
                                            value="{{$data->google_location}}"

                                            />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Customer Number:</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text"  id="first-name-icon"
                                            class="form-control" name="customer_number" placeholder="052XXXXXX"
                                            value="{{$data->customer_number}}"
                                            />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Customer 5G Number:</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text"  id="first-name-icon"
                                            class="form-control" name="fiveg_number" placeholder="052XXXXXX"
                                            value="{{$data->fnumber}}"

                                            />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Status:</label>
                                    <div class="input-group input-group-merge">
                                        <select name="is_status" id="is_status" class="form-control">
                                            <option value="">Select Status</option>
                                            <option value="Pending" {{$data->is_status == 'Pending' ? 'selected' : ''}}>Pending</option>
                                            <option value="Available" {{$data->is_status == 'Available' ? 'selected' : ''}}>Available</option>
                                            <option value="Not Available" {{$data->is_status == 'Not Available' ? 'selected' : ''}}>Not Available</option>
                                            <option value="Closed" {{$data->is_status == 'Closed' ? 'selected' : ''}}>Closed</option>
                                            <option value="ShortFall" {{$data->is_status == 'ShortFall' ? 'selected' : ''}}>ShortFall</option>
                                            <option value="Commercial" {{$data->is_status == 'Commercial' ? 'selected' : ''}}>Commercial</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{$data->id}}">



                            {{-- IMO END --}}
                            {{-- <div class="col-12">
                                <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>
                            </div> --}}
                            {{-- <div class="col-12">
                                <button type="submit" class="btn btn-primary me-1"
                                    onclick="SavingActivationLead('{{ route('request.fne.update') }}', 'MyRoleForm','{{ route('allfne') }}')">Submit</button>
                            </div> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- Basic Vertical form layout section end -->

<!-- Basic multiple Column Form section start -->

<input type="hidden" name="leadid" id="leadid" value="{{$data->id}}">

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
