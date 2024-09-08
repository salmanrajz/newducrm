<div class="form-group">
            <label class="form-label" for="basic-icon-default-fullname">Category Name</label>
            <input
              type="text"
              class="form-control dt-full-name"
              id="basic-icon-default-fullname"
              {{-- placeholder="Category 1" --}}
              {{-- aria-label="Category 1" --}}
               name="category_name"
              autocomplete="off" value="{{$data->category_name}}"
            />
          </div>
          <div class="form-group">
            <label class="form-label" for="basic-icon-default-fullname">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="1" {{ $data->status == "1" ? 'checked' : '' }}>Enable</option>
                <option value="0" {{ $data->status == "0" ? 'checked' : '' }}>Disable</option>
            </select>
          </div>
<input type="hidden" name="id" value="{{$data->id}}">
{{-- <input type="hidden" name="task_name" value="{{$task_name}}"> --}}
{{-- <input type="hidden" name="page_name" value="{{$page_name}}"> --}}
<div class="col-sm-12 data-field-col-data-list-upload mt-3">
    {{-- <div class="alert alert-danger print-error-msg" style="display:none">
                      <ul></ul>
                  </div> --}}
    <div class="alert alert-danger alert-validation-msg print-error-msg" role="alert" style="display: none">
        <div class="alert-body">
            <ul></ul>
        </div>
    </div>
</div>
{{--  --}}
<button type="button" class="btn btn-primary data-submit mr-1"
onclick="VerifyLead('{{route('exam.EditBlogCategory')}}','ClassesAdd','{{route($redirect)}}')">Submit</button>
<button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
