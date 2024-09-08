@extends('layouts/contentLayoutMaster')

@section('title', 'New Candidate')

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
                <div id='calendar'></div>
            </div>
        </div>

    </div>
</section>
<!-- Basic Vertical form layout section end -->

<!-- Basic multiple Column Form section start -->


@endsection<!-- Basic Floating Label Form section end -->
@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/custom.js')) }}"></script>
<!-- Page js files -->
{{-- <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script> --}}
{{-- <script src='https://fullcalendar.io/js/fullcalendar-2.1.1/lib/moment.min.js'></script> --}}
{{-- <script src='https://fullcalendar.io/js/fullcalendar-2.1.1/lib/jquery.min.js'></script> --}}
{{-- <script src="https://fullcalendar.io/js/fullcalendar-2.1.1/lib/jquery-ui.custom.min.js"></script> --}}
{{-- <script src='https://fullcalendar.io/js/fullcalendar-2.1.1/fullcalendar.min.js'></script> --}}
    {{-- <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.0/fullcalendar.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.5.0/fullcalendar.min.js"></script>

<script>
        $(document).ready(function() {

      // page is now ready, initialize the calendar...

      function flagEvent(event, element) {
        element.addClass('event-on-' + event.start.format('YYYY-MM-DD'))
          .css('display', 'none');
      }

      $('#calendar').fullCalendar({
        // put your options and callbacks here
        defaultDate: '2023-01-01',
        header: {
          left: '',
          center: 'prev title next',
          right: 'today'
        },
        eventRender: function(event, element) {
          // When rendering each event, add a class to it, so you can find it later.
          // Also add css to hide it so it is not displayed.
          // Note I used a class, so it is visible in source and easy to work with, but
          // you can use data attributes instead if you want.

          flagEvent(event, element);

          if (event.end && event.start.format('YYYY-MM-DD') !== event.end.format('YYYY-MM-DD')) {
            while (event.end > event.start) {
              event.start.add(1, 'day');
              console.log('flag', event.start.format('YYYY-MM-DD'))
              flagEvent(event, element);
            }
          }
        },
        eventAfterAllRender: function(view) {
          // After all events have been rendered, we can now use the identifying CSS
          // classes we added to each one to count the total number on each day.
          // Then we can display that count.
          // Iterate over each displayed day, and get its data-date attribute
          // that Fullcalendar provides.  Then use the CSS class we added to each event
          // to count the number of events on that day.  If there are some, add some
          // html to the day cell to show the count.

          $('#calendar .fc-day.fc-widget-content').each(function(i) {
            var date = $(this).data('date'),
              count = $('#calendar a.fc-event.event-on-' + date).length;
            if (count > 0) {
              $(this).html('<div class="fc-event-count">+' + count + '<div>');
            }
          });
        },
        events: [

        @foreach($data as $pp)
                @if(strlen($pp->account_created) > 9)
				{
					title: 'Number of Connections Going to Expire',
					start: '{{\Carbon\Carbon::createFromFormat('d/m/Y', $pp->account_created)}}'

				},
				{
					title: 'Long Event',
					start: '2024-01-07',
				},
                @endif
            @endforeach
    ]
      })

    });

</script>
@endsection
