<table class="table table-responsive">
    <thead>
        <tr>
            <td>S#</td>
            <td>SystemID</td>
            <td>Name</td>
            <td>CustomerNum</td>
            <td>Act Date:</td>
            <td>Nationality</td>
            <td>Remarks</td>

        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>{{$data->number_id}}</td>
            <td>{{$data->cname}}</td>
            <td>{{$data->number}}</td>
            <td>{{$data->activation_date}}</td>
            <td>{{$data->nationality}}</td>
            <td>{{$data->remarks}}</td>
        </tr>
    </tbody>

</table>
