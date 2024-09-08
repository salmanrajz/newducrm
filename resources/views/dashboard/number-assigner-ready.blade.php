<!DOCTYPE html>
<html>

<head>
    <title>Assign Number to Manager</title>
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
    @role('Admin')
    <form method="post" enctype="multipart/form-data"
    action="{{route('bulk.excel')}}"
    >
        {{ csrf_field() }}
        <div class="form-group">
            <table class="table">
                <tr>
                    <td width="40%" align="right"><label>Select File for Upload</label></td>
                    <td width="30">
                        <input type="file" name="select_file" />
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
    @endrole


    <br />
    <div id="assigner_block">

        <form class="form-horizontal form-label-left input_mask" method="post" id="assigner"
            enctype="multipart/form-data">

            {{-- <form action="{{route('bulk.assigner')}}" method="post"> --}}
            {{-- @csrf --}}
            {{ csrf_field() }}

            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <label for="number">Total Number - {{auth()->user()->role}} ({{$NumberCount}}) | Selected Number: <span
                                id="selected_number" style="color:red">0</span></label>
                        <select name="number[]" id="number" class="form-control" multiple style="height:500px;">
                            @foreach ($b as $item)
                            {{-- <option value="{{$item->id}}">{{$item->number}} - {{$item->name}} - {{$item->area}} - {{$item->emirates}}</option> --}}
                            <option value="{{$item->id}}">{{$item->customer_number}} - {{$item->lead_type}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="user">User</label>
                            <select name="user" id="user" class="form-control">
                                @foreach ($u as $s)
                                <option value="{{$s->id}}">{{$s->name . '-' .$s->agent_code}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            @if(auth()->user()->role == 'Admin' || auth()->user()->role == 'MainAdmin')
                            <input type="button" value="Assign Number"
                                onclick="BulkAssigner('{{route('bulk.assigner.fne')}}','assigner')" class="btn btn-info">
                            @else
                            <input type="button" value="Assign Number"
                                    onclick="BulkAssigner('{{route('bulk.assigner.user.fne')}}','assigner')" class="btn btn-info">
                            @endif
                        </div>
                        <div class="form-group">
                            <h3 class="text-center" id="loading_num" style="display:none">
                                Please wait while assigning numbers...
                                <img src="{{asset('assets/images/loader.gif')}}" alt="Loading"
                                    class="img-fluid text-center offset-md-6">
                            </h3>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
    @role('TeamLeader')
    @inject('provider', 'App\Http\Controllers\FunctionController')

    <div class="container">
        <div class="row">
             <h1>
        TEAM LEADER
    </h1>
    <table class="table table-responsive">
    <thead>
        <th>S#</th>
        <th>TL Name</th>
        <th>5G Total</th>
        <th>5G Assigned</th>
        <th>5G Used</th>
        <th>5G Remaining</th>
        <th>Not Ans</th>
        <th>Not Called</th>
    </thead>
    <tbody>
        @foreach ($u as $i => $item)

        <tr>
            <td>
                {{++$i}}
            </td>
            <td>
                {{$item->name}}
            </td>
            <td>
                {{$provider::FNEDataCountAgent($item->id,'All')}}
            </td>
            <td>
                {{$provider::FNEDataCountAgent($item->id,'Assigned')}}
            </td>
            <td>
                {{$provider::FNEDataCountAgent($item->id,'Used')}}
            </td>
            <td>
                {{$provider::FNEDataCountAgent($item->id,'Remaining')}}
            </td>
            <td>
                {{$provider::FNEDataCountAgent($item->id,'NotAns')}}
            </td>
            <td>
                {{$provider::FNEDataCountAgent($item->id,'NotCalled')}}
            </td>
        </tr>
        @endforeach
    </tbody>
   </table>
        </div>
    </div>
    @endrole

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
<script src="{{ asset(mix('js/custom.js')) }}"></script>
<script>
    setInterval(() => {
    var count = $("#number :selected").length;
    // console.log(count);
    $("#selected_number").text(count);

}, 0);
</script>


</html>
{{-- <x-footer></x-footer> --}}
