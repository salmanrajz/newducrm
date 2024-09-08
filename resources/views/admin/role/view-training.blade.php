@extends('layouts/contentLayoutMaster')

@section('title', 'Training')

@section('content')

<!-- Basic Horizontal form layout section start -->

<!-- Basic Horizontal form layout section end -->

<!-- Basic Vertical form layout section start -->
<section id="basic-vertical-layouts">
  <div class="row">

    <div class="col-md-12 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Add Training</h4>
        </div>
        <div class="card-body">
          <form class="form form-vertical"  id="MyRoleForm" onsubmit="return false" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-12">
                <div class="mb-1">
                  <label class="form-label" for="first-name-icon">Training Page Name</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text"><i data-feather="user"></i></span>
                    <input
                      type="text"
                      id="first-name-icon"
                      class="form-control"
                      name="name"
                      placeholder="Training Page Name"
                    />
                  </div>
                </div>

              </div>
              <div class="col-12">
                <div class="mb-1">
                  <label class="form-label" for="first-name-icon">Trainign Page Description</label>
                  <div class="input-group input-group-merge">
                    <textarea name="TrainingDesc" id="TrainingDesc" cols="30" rows="10" class="form-control" ></textarea >
                  </div>
                </div>

              </div>
              <div class="col-12">
                <div class="mb-1">
                  <label class="form-label" for="first-name-icon">Upload PDF</label>
                  <div class="input-group input-group-merge">
                    <input type="file" name="pdf" id="pdf" class="form-control" accept="application/pdf, application/vnd.ms-excel">
                  </div>
                </div>

              </div>
              <div class="col-12">
                                <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
              </div>

              <div class="col-12">
                <button type="submit" class="btn btn-primary me-1" onclick="VerifyLeadBlog('{{route('training.add')}}', 'MyRoleForm','{{route('training')}}')">Submit</button>
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
          <h4 class="card-title">Existing Products</h4>
        </div>
        <div class="card-body">
          <form class="form form-vertical">
            <div class="row">
              <div class="col-12">
                @foreach ($role as $key => $item)

                <div class="mb-1">
                    <label class="form-label" for="first-name-icon">{{++$key}} - {{$item->page_name}}
                    </label>
                    <i data-feather='edit' class="float-right right" onclick="window.location.href='{{route('product.edit',$item->id)}}'"></i>
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
<script src="https://cdn.tiny.cloud/1/2mrbou8da9x4ojjd4wsp5gqez8qhlsee7z5myu0wy8ewepu7/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

  {{-- <script src="https://cdn.tiny.cloud/1/2mrbou8da9x4ojjd4wsp5gqez8qhlsee7z5myu0wy8ewepu7/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> --}}
  <script>
    tinymce.init({
  selector: '#TrainingDesc',
  height: 500,
  width: '100%',
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen codesample',
    'insertdatetime media table paste imagetools wordcount spellchecker fullpage'
  ],
  toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image codesample fullscreen',
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:18px }'
});
  </script>
@endsection
