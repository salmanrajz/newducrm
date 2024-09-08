@extends('layouts/contentLayoutMaster')

@section('title', 'MNP | P2P Leads')

@section('content')
<!-- Basic Horizontal form layout section start -->

<!-- Basic Horizontal form layout section end -->

<!-- Basic Vertical form layout section start -->
<section id="basic-vertical-layouts">
    <div class="row">

        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Upload Front ID for Data Fetching</h4>
                </div>
                <div class="form-container container">
                    <div class="row">
                        {{-- <div class="col-12">
                            <form onsubmit="return false" method="post" enctype="multipart/form-data"
                                id="FetchApiForm3">
                                @csrf
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Emirate Front ID:</label>
                                    <div class="input-group input-group-merge">
                                        <input type="file" name="front_img" id="front_img"
                                            onchange="NameApi('{{ route('ocr-name.submit') }}','FetchApiForm3')">
                                        <h3 class="text-center" id="loading_num1" style="display:none">
                                            <img src="{{ asset('assets/images/loader.gif') }}"
                                                alt="Loading" class="img-fluid text-center offset-md-6"
                                                style="width:35px;">
                                        </h3>
                                        <div class="form-group hidden d-none">
                                            <label for="dob">Name:</label>
                                            <input type="text" name="dob" id="name">
                                        </div>
                                        <div class="form-group  hidden d-none ">
                                            <label for="dob">Emirate ID:</label>
                                            <input type="text" name="dob" id="emirate_id_l">
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div> --}}

                    </div>
                </div>
                <div class="card-header">
                    <h4 class="card-title">Lead Information</h4>
                </div>
                <div class="card-body">
                    <form class="form form-vertical" id="MyRoleForm" onsubmit="return false">
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group ">
                            <input class="form-control " id="leadno"
                                value="{{$data->lead_no}}"
                                placeholder="Lead Number" type="text" disabled>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Full Name</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="full_name" class="form-control" name="full_name"
                                            placeholder="Full Name (Exactly as Per Emirate ID)" required  value="{{$data->customer_name}}" disabled/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Emirate ID</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                        <input type="text" id="emirate_id" class="form-control" name="emirate_id"
                                            value="{{$data->emirate_id}}" disabled/>
                                    </div>
                                </div>
                            </div>





                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Emirate Front ID:</label>
                                    {{-- <div class="input-group input-group-merge">
                                        <input type="file" name="front_id" id="front_img"
                                            class="form-control" accept="image/*">
                                        </h3>

                                    </div> --}}
                                    <img id="myImg1" src="{{env('CDN_URL')}}/documents/{{$data->front_id}}" alt="your image" style="width:25%" onerror="this.style.display='none'"/>
                                </div>

                        </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Emirate Back ID:</label>
                                    {{-- <div class="input-group input-group-merge">
                                        <input type="file" name="front_id" id="front_img"
                                            class="form-control" accept="image/*">
                                        </h3>

                                    </div> --}}
                                    <img id="myImg1" src="{{env('CDN_URL')}}/documents/{{$data->back_id}}" alt="your image" style="width:25%" onerror="this.style.display='none'"/>
                                </div>

                        </div>
                        <div class="col-12">
                    <div class="mb-1">
                        <label class="form-label" for="first-name-icon">Remarks</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="user"></i></span>
                            <input type="text" name="remarks" id="remarks" class="form-control" value="Please Verify">
                        </div>
                    </div>
                </div>

                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="first-name-icon">Additional Documents:</label>
                                    <div class="input-group input-group-merge">
                                        <input type="file" name="additional_docs_photo" id="additional_documents"
                                            class="form-control" accept="image/*">

                                        </h3>
                                    </div>
                                    <img id="myImg3" src="{{env('CDN_URL')}}/documents/{{$data->additional_docs}}" alt="your image" style="width:25%" onerror="this.style.display='none'"/>
                                </div>
                                <input type="hidden" name="leadid" value="{{$data->id}}">

                        </div>

                            {{-- IMO END --}}
                            <div class="col-12">
                                <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary me-1"
                                    onclick="SavingActivationLead('{{ route('designer.verification') }}', 'MyRoleForm','{{ route('home') }}')">Submit For Verification</button>
                            {{-- </div> --}}
                            {{-- <div class="col-12"> --}}
                                {{-- <button type="submit" class="btn btn-primary me-1"
                                    onclick="SavingActivationLead('{{ route('submit.proceed') }}', 'MyRoleForm','{{ route('home') }}')">Submit For Proceed</button> --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@include('admin.chat.chat')

</section>
<!-- Basic Vertical form layout section end -->

<!-- Basic multiple Column Form section start -->


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
