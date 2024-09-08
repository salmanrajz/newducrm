<!DOCTYPE html>
<html>
 <head>
  <title>Import Excel File in CRM SOFTWARE</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />
{{--
  <div class="container">
   <h3 align="center">Import Excel File in CRM SOFTWARE</h3>
    <br />
   @if(count($errors) > 0)
    <div class="alert alert-danger">
     Upload Validation Error<br><br>
     <ul>
      @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
     </ul>
    </div>
   @endif --}}

   @if($message = Session::get('success'))
   <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
           <strong>{{ $message }}</strong>
   </div>
   @endif
   <form method="post" enctype="multipart/form-data" action="{{route('import.excel')}}">
    {{ csrf_field() }}
    <div class="form-group">
     <table class="table">
      <tr>
       <td width="40%" align="right"><label>Select File for Upload</label></td>
       <td width="30">
        <input type="file" name="select_file" />
        <input type="text" name="salman" id="salman" class="form-control" value="salmanahmed">
        {{-- <input type="file" name="select_file2" /> --}}
        {{-- <input type="file" name="select_file3" /> --}}
        {{-- <input type="file" name="select_file4" /> --}}
        {{-- <input type="file" name="select_file5" /> --}}
       </td>
       <td width="30%" align="left">
        <input type="submit" name="upload" class="btn btn-primary" value="Upload">
       </td>
      </tr>
      <tr>
       <td width="40%" align="right"></td>
       <td width="30"><span class="text-muted">.xls, .xslx</span></td>
       <td width="30%" align="left"></td>
      </tr>
     </table>
    </div>
   </form>


   <br />
   {{-- <div class="panel panel-default">
    <div class="panel-heading">
     <h3 class="panel-title">Customer Data</h3>
    </div>
    <div class="panel-body">
     <div class="table-responsive">
      <table class="table table-bordered table-striped">
       <tr>
        <th>Vendor Name</th>
        <th>Model</th>
        <th>description</th>
        <th>shipping_type</th>
        <th>SKU</th>
        <th>stock</th>
       </tr>
       @foreach($data as $row)
       <tr>
        <td>{{ $row->vendor }}</td>
        <td>{{ $row->model }}</td>
        <td>{{ $row->description }}</td>
        <td>{{ $row->shipping_type }}</td>
        <td>{{ $row->SKU }}</td>
        <td>{{ $row->stock }}</td>
       </tr>
       @endforeach
      </table>
     </div>
    </div>
   </div> --}}
  </div>
 </body>
</html>
