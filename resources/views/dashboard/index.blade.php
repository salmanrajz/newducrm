@extends('layouts.simple.master')

@section('title', 'Default')

@section('css')

@endsection

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection

@section('breadcrumb-title')
<h3>{{$heading}}</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Dashboard</li>
<li class="breadcrumb-item active">{{$heading}}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row widget-grid" id="LoadData">



    </div>
</div>
<script type="text/javascript">
    var session_layout = '{{ session()->get('
    layout ') }}';

</script>
@endsection

@section('script')
{{-- <script src="{{ asset('assets/js/clock.js') }}"></script>
<script src="{{ asset('assets/js/chart/apex-chart/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('assets/js/dashboard/default.js') }}"></script>
<script src="{{ asset('assets/js/notify/index.js') }}"></script>
<script src="{{ asset('assets/js/typeahead/handlebars.js') }}"></script>
<script src="{{ asset('assets/js/typeahead/typeahead.bundle.js') }}"></script>
<script src="{{ asset('assets/js/typeahead/typeahead.custom.js') }}"></script>
<script src="{{ asset('assets/js/typeahead-search/handlebars.js') }}"></script>
<script src="{{ asset('assets/js/typeahead-search/typeahead-custom.js') }}"></script>
<script src="{{ asset('assets/js/height-equal.js') }}"></script>
<script src="{{ asset('assets/js/animation/wow/wow.min.js') }}"></script> --}}

<script>
    function ShowCordDashboard(url,type, loadingUrl,divName) {
    $.ajax({
        type: 'POST',
        url: url,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            type:type,
        },

        beforeSend: function () {
            // alert(Month);
                $("#" + divName).html('<img src="' + loadingUrl + '" class="img-fluid text-center offset-md-6" style="width:35px;"></img>');
            // $("#DailySummaryLead").show();
            // $("#loading_num3").html('<p> Loading </p>');
        },
        success: function (data) {
            // alert(data);
            // $("#loading_num3").hide();
            // setTimeout(() => {
                $("#" + divName).html(data);

            // }, 1000);
            // if (Month == 'Daily') {
            // } else if (Month == 'Monthly') {
                // $("#MonthlySummaryLead").html(data);
            // } else if (Month == 'CallCenter') {
                // $("#CallCenterSummaryLead").html(data);
            // } else if (Month == 'ActivationAgent') {
                // $("#ActivationAgentSummaryLead").html(data);
            // }
        }
    });
}
</script>
@role('MainAdmin|Sale')
<script>
    ShowCordDashboard('{{route('agent.LoadData')}}','homepage','{{asset('assets/images/ajax-loader.gif')}}','LoadData');
</script>
@endrole
@role('Activator')
<script>
    ShowCordDashboard('{{route('activator.LoadData')}}','homepage','{{asset('assets/images/ajax-loader.gif')}}','LoadData');
</script>
@endrole
@role('Verification')
<script>
    ShowCordDashboard('{{route('verification.LoadData')}}','homepage','{{asset('assets/images/ajax-loader.gif')}}','LoadData');
</script>
@endrole
{{-- @role('MainAdmin')
<script>
    ShowCordDashboard('{{route('admin.LoadData')}}','{{asset('assets/images/ajax-loader.gif')}}');
</script>
@endrole --}}
@endsection
