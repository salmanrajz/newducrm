@extends('layouts/contentLayoutMaster')

@section('title', 'Add Quiz')

@section('vendor-style')
{{-- vendor css files --}}
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
{{-- <link rel="stylesheet" href="{{ asset('admin/vendors/css/forms/select/select2.min.css') }}"> --}}
  {{-- <link rel="stylesheet" href="{{ asset('admin/vendors/css/editors/quill/katex.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/editors/quill/monokai-sublime.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/editors/quill/quill.snow.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/editors/quill/quill.bubble.css') }}"> --}}
<script src="https://cdn.tiny.cloud/1/2mrbou8da9x4ojjd4wsp5gqez8qhlsee7z5myu0wy8ewepu7/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

@endsection

@section('content')
{{-- <div class="row">
  <div class="col-12">
    <p>Read full documnetation <a href="https://datatables.net/" target="_blank">here</a></p>
  </div>
</div> --}}
<!-- Basic table -->
<section id="basic-vertical-layouts">
<form class="form form-vertical" id="ClassesAdd">

    <div class="row">
        <div class="col-md-8 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Blog Form</h4>
                </div>
                <div class="card-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="long_description">Type Your Question</label>
                                    <textarea name="question" id="long_description" cols="30" rows="10" class="form-control" >{{$data->question}}</textarea >
                                </div>
                            </div>
                            @php
                            $data2 = \App\Models\question_bank_answer::where('quiz_id',$data->id)->get();
                            @endphp
                            <hr>
                            @foreach ($data2 as $key => $item)
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="long_description">Answer {{++$key}}
                                     {{-- {{$item->answer == $key ? 'checked' : ''}} --}}

                                    </label>
                                    <textarea name="answer{{$key}}" id="answer{{$key}}" cols="30" rows="10" class="form-control" >{{$item->answer}}</textarea >
                                    @if($item->correct==1)
                                    <input type="radio" name="selected_answer" id="answer_{{$key}}" value="{{$key}}" checked>
                                    @else
                                    <input type="radio" name="selected_answer" id="answer_{{$key}}" value="{{$key}}" >
                                    @endif
                                     {{-- {{ ($item->answer==$key)? "checked" : "" }} --}}
                                    {{-- > --}}
                                    <label for="answer_1">is it correct?</label>
                                </div>
                            </div>
                            @endforeach

                            {{-- <hr>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="long_description">Answer 2</label>
                                    <textarea name="answer2" id="answer2" cols="30" rows="10" class="form-control" ></textarea >
                                    <input type="radio" name="selected_answer" id="answer_2" value="2">
                                    <label for="answer_1">is it correct?</label>
                                </div>
                            </div>
                            <hr>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="long_description">Answer 3</label>
                                    <textarea name="answer3" id="answer3" cols="30" rows="10" class="form-control" ></textarea >
                                    <input type="radio" name="selected_answer" id="answer_3" value="3">
                                    <label for="answer_1">is it correct?</label>
                                </div>
                            </div>
                            <hr>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="long_description">Answer 4</label>
                                    <textarea name="answer4" id="answer4" cols="30" rows="10" class="form-control" ></textarea >
                                    <input type="radio" name="selected_answer" id="answer_4" value="4">
                                    <label for="answer_1">is it correct?</label>
                                </div>
                            </div> --}}





                            <div class="col-12">
                                <div class="alert alert-danger alert-validation-msg print-error-msg" role="alert"
                                    style="display: none">
                                    <div class="alert-body">
                                        <ul></ul>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="{{$data->id}}">
                                <button type="reset" class="btn btn-primary mr-1"
                                onclick="VerifyLeadBlog('{{route('QuizUpdate')}}','ClassesAdd','loadtable')">Submit</button>
                                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                            </div>
                        </div>

                </div>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="card-body card">
                <div class="row">
                    <!-- Basic -->
                    <div class="col-md-12 mb-1">
                        <label>Category</label>
                        <select class="select2 form-control form-control-lg" name="category">
                            @foreach ($category as $item)
                            <option value="{{$item->id}}" {{$data->category_id == $item->id ? 'selected' : ''}}>{{$item->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>



        </div>
                    </form>

    </div>
</section>
<!--/ Basic table -->

@endsection


@section('vendor-script')
{{-- vendor files --}}
{{-- <script src="{{ asset('admin/vendors/js/editors/quill/katex.min.js') }}"></script> --}}
{{-- <script src="{{ asset('admin/vendors/js/editors/quill/highlight.min.js') }}"></script> --}}
{{-- <script src="{{ asset('admin/vendors/js/editors/quill/quill.min.js') }}"></script> --}}
{{-- <script src="{{ asset('admin/vendors/js/forms/select/select2.full.min.js') }}"></script> --}}
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>

@endsection
@section('page-script')
{{-- Page js files --}}
<script src="{{ asset('admin/js/scripts/forms/form-select2.js') }}"></script>
<script src="{{asset('admin/js/main.js')}}"></script>
<script>
    // tinymce.init({
    //     selector: '#short_description'
    // });
    // tinymce.init({
    //     selector: '#long_description'
    // });
//    tinymce.init({
//   selector: '#short_description',  // change this value according to your HTML
//   plugins: [
//       'image','link'
//     ],
//   a11y_advanced_options: true
// });
// tinymce.init({
//   selector: '#long_description',
//   height: 500,
//   plugins: [
//     'advlist autolink lists link image charmap print preview anchor',
//     'searchreplace visualblocks code fullscreen codesample',
//     'insertdatetime media table paste imagetools wordcount spellchecker fullpage'
//   ],
//   toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image codesample',
//   content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:18px }',
//   automatic_uploads: true,
// });
tinymce.init({
       selector: '#long_description',
      plugins: 'quickbars table image link lists media autoresize help codesample code',
       images_upload_handler: function (blobInfo, success, failure) {
           var xhr, formData;
           xhr = new XMLHttpRequest();
           xhr.withCredentials = false;
           xhr.open('POST', '{{route('upload.image')}}');
           var token = '{{ csrf_token() }}';
           xhr.setRequestHeader("X-CSRF-Token", token);
           xhr.onload = function() {
               var json;
            //    alert(xhr.status);
               if (xhr.status != 200) {
                   failure('HTTP Error: ' + xhr.status);
                   return;
               }
            //    json = JSON.parse(xhr.responseText);

            //    if (!json || typeof json.location != 'string') {
            //        failure('Invalid JSON: ' + xhr.responseText);
            //        return;
            //    }
            //    success(json.location);
           };
           formData = new FormData();
           formData.append('file', blobInfo.blob(), blobInfo.filename());
           xhr.send(formData);
       }
});
tinymce.init({
    selector: '#answer1',
      plugins: 'quickbars table image link lists media autoresize help codesample code',
       images_upload_handler: function (blobInfo, success, failure) {
           var xhr, formData;
           xhr = new XMLHttpRequest();
           xhr.withCredentials = false;
           xhr.open('POST', '{{route('upload.image')}}');
           var token = '{{ csrf_token() }}';
           xhr.setRequestHeader("X-CSRF-Token", token);
           xhr.onload = function() {
               var json;
            //    alert(xhr.status);
               if (xhr.status != 200) {
                   failure('HTTP Error: ' + xhr.status);
                   return;
               }
            //    json = JSON.parse(xhr.responseText);

            //    if (!json || typeof json.location != 'string') {
            //        failure('Invalid JSON: ' + xhr.responseText);
            //        return;
            //    }
            //    success(json.location);
           };
           formData = new FormData();
           formData.append('file', blobInfo.blob(), blobInfo.filename());
           xhr.send(formData);
       }
});
tinymce.init({
    selector: '#answer2',
      plugins: 'quickbars table image link lists media autoresize help codesample code',
       images_upload_handler: function (blobInfo, success, failure) {
           var xhr, formData;
           xhr = new XMLHttpRequest();
           xhr.withCredentials = false;
           xhr.open('POST', '{{route('upload.image')}}');
           var token = '{{ csrf_token() }}';
           xhr.setRequestHeader("X-CSRF-Token", token);
           xhr.onload = function() {
               var json;
            //    alert(xhr.status);
               if (xhr.status != 200) {
                   failure('HTTP Error: ' + xhr.status);
                   return;
               }
            //    json = JSON.parse(xhr.responseText);

            //    if (!json || typeof json.location != 'string') {
            //        failure('Invalid JSON: ' + xhr.responseText);
            //        return;
            //    }
            //    success(json.location);
           };
           formData = new FormData();
           formData.append('file', blobInfo.blob(), blobInfo.filename());
           xhr.send(formData);
       }
});
tinymce.init({
    selector: '#answer3',
      plugins: 'quickbars table image link lists media autoresize help codesample code',
       images_upload_handler: function (blobInfo, success, failure) {
           var xhr, formData;
           xhr = new XMLHttpRequest();
           xhr.withCredentials = false;
           xhr.open('POST', '{{route('upload.image')}}');
           var token = '{{ csrf_token() }}';
           xhr.setRequestHeader("X-CSRF-Token", token);
           xhr.onload = function() {
               var json;
            //    alert(xhr.status);
               if (xhr.status != 200) {
                   failure('HTTP Error: ' + xhr.status);
                   return;
               }
            //    json = JSON.parse(xhr.responseText);

            //    if (!json || typeof json.location != 'string') {
            //        failure('Invalid JSON: ' + xhr.responseText);
            //        return;
            //    }
            //    success(json.location);
           };
           formData = new FormData();
           formData.append('file', blobInfo.blob(), blobInfo.filename());
           xhr.send(formData);
       }
});
tinymce.init({
    selector: '#answer4',
      plugins: 'quickbars table image link lists media autoresize help codesample code',
       images_upload_handler: function (blobInfo, success, failure) {
           var xhr, formData;
           xhr = new XMLHttpRequest();
           xhr.withCredentials = false;
           xhr.open('POST', '{{route('upload.image')}}');
           var token = '{{ csrf_token() }}';
           xhr.setRequestHeader("X-CSRF-Token", token);
           xhr.onload = function() {
               var json;
            //    alert(xhr.status);
               if (xhr.status != 200) {
                   failure('HTTP Error: ' + xhr.status);
                   return;
               }
            //    json = JSON.parse(xhr.responseText);

            //    if (!json || typeof json.location != 'string') {
            //        failure('Invalid JSON: ' + xhr.responseText);
            //        return;
            //    }
            //    success(json.location);
           };
           formData = new FormData();
           formData.append('file', blobInfo.blob(), blobInfo.filename());
           xhr.send(formData);
       }
});

// tinymce.init({
//   selector: '#short_description',
//   plugins: 'quickbars table image link lists media autoresize help codesample code',
//   toolbar: 'undo redo | formatselect | bold italic | alignleft aligncentre alignright alignjustify | indent outdent | bullist numlist',
//   content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
// });



</script>
  {{-- <script src="{{ asset('admin/js/scripts/forms/form-quill-editor.js') }}"></script> --}}

{{-- <script src="{{ asset('js/scripts/tables/table-datatables-basic.js') }}"></script> --}}
@endsection
