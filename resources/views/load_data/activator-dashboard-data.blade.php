 <div class="col-xxl-3 col-xl-4 col-md-6 box-col-6">
     <div class="row">
         <div class="col-sm-12">
             <div class="card course-box widget-course">
                 <div class="card-body">
                     <div class="course-widget">
                         <div class="course-icon success">
                             <svg class="fill-icon">
                                 <use href="{{ asset('assets/svg/icon-sprite.svg#dash') }}"></use>
                             </svg>
                         </div>
                         <div>
                        @inject('provider', 'App\Http\Controllers\FunctionController')
                             <h4 class="mb-0">
                                        {{$provider::HWPreCheckUp('Monthly','PendingLeads')}}


                            </h4><span class="f-light">HW Pre Check</span><a
                                 class="btn btn-light f-light" onclick="ShowCordDashboard('{{route('activator.PreCheckLeads')}}','PendingLeads','{{asset('assets/images/ajax-loader.gif')}}','loadLeadData');">View
                                 Leads<span class="ms-2">
                                     <svg class="fill-icon f-light">
                                         <use href="{{ asset('assets/svg/icon-sprite.svg#arrowright') }}"></use>
                                     </svg></span></a>
                         </div>
                     </div>
                 </div>
                 <ul class="square-group">
                     <li class="square-1 warning"></li>
                     <li class="square-1 primary"></li>
                     <li class="square-2 warning1"></li>
                     <li class="square-3 danger"></li>
                     <li class="square-4 light"></li>
                     <li class="square-5 warning"></li>
                     <li class="square-6 success"></li>
                     <li class="square-7 success"></li>
                 </ul>
             </div>
         </div>
     </div>
 </div>
 <div class="col-xxl-3 col-xl-4 col-md-6 box-col-6">
     <div class="row">
         <div class="col-sm-12">
             <div class="card course-box widget-course">
                 <div class="card-body">
                     <div class="course-widget">
                         <div class="course-icon warning">
                             <svg class="fill-icon">
                                 <use href="{{ asset('assets/svg/icon-sprite.svg#course-2') }}"></use>
                             </svg>
                         </div>
                         <div>
                             <h4 class="mb-0">
                                        {{$provider::HWPreCheckUp('Monthly','inprocess')}}

                            </h4><span class="f-light">In Progress Leads</span><a
                                 class="btn btn-light f-light" onclick="ShowCordDashboard('{{route('activator.PreCheckLeads')}}','InProcessLead','{{asset('assets/images/ajax-loader.gif')}}','loadLeadData');">View
                                 Leads<span class="ms-2">
                                     <svg class="fill-icon f-light">
                                         <use href="{{ asset('assets/svg/icon-sprite.svg#arrowright') }}"></use>
                                     </svg></span></a>
                         </div>
                     </div>
                 </div>
                 <ul class="square-group">
                     <li class="square-1 warning"></li>
                     <li class="square-1 primary"></li>
                     <li class="square-2 warning1"></li>
                     <li class="square-3 danger"></li>
                     <li class="square-4 light"></li>
                     <li class="square-5 warning"></li>
                     <li class="square-6 success"></li>
                     <li class="square-7 success"></li>
                 </ul>
             </div>
         </div>
     </div>
 </div>
 <div class="col-xxl-3 col-xl-4 col-md-6 box-col-6">
     <div class="row">
         <div class="col-sm-12">
             <div class="card course-box widget-course">
                 <div class="card-body">
                     <div class="course-widget">
                         <div class="course-icon pending">
                             <svg class="fill-icon">
                                 <use href="{{ asset('assets/svg/icon-sprite.svg#sale') }}"></use>
                             </svg>
                         </div>
                         <div>
                             <h4 class="mb-0">
                                        {{$provider::HWPreCheckUp('Monthly','ActiveLeadsAltID')}}

                            </h4><span class="f-light">Active Leads - AltID</span><a
                                 class="btn btn-light f-light" onclick="ShowCordDashboard('{{route('activator.PreCheckLeads')}}','ActiveLeadsAltID','{{asset('assets/images/ajax-loader.gif')}}','loadLeadData');">View
                                 Leads<span class="ms-2">
                                     <svg class="fill-icon f-light">
                                         <use href="{{ asset('assets/svg/icon-sprite.svg#arrowright') }}"></use>
                                     </svg></span></a>
                         </div>
                     </div>
                 </div>
                 <ul class="square-group">
                     <li class="square-1 warning"></li>
                     <li class="square-1 primary"></li>
                     <li class="square-2 warning1"></li>
                     <li class="square-3 danger"></li>
                     <li class="square-4 light"></li>
                     <li class="square-5 warning"></li>
                     <li class="square-6 success"></li>
                     <li class="square-7 success"></li>
                 </ul>
             </div>
         </div>
     </div>
 </div>
 <div class="col-xxl-3 col-xl-4 col-md-6 box-col-6">
     <div class="row">
         <div class="col-sm-12">
             <div class="card course-box widget-course">
                 <div class="card-body">
                     <div class="course-widget">
                         <div class="course-icon pending">
                             <svg class="fill-icon">
                                 <use href="{{ asset('assets/svg/icon-sprite.svg#doller-return') }}"></use>
                             </svg>
                         </div>
                         <div>
                             <h4 class="mb-0">
                                        {{$provider::HWPreCheckUp('Monthly','ActiveLeadsSameID')}}

                            </h4><span class="f-light">Active Leads - SameID</span><a
                                 class="btn btn-light f-light" onclick="ShowCordDashboard('{{route('activator.PreCheckLeads')}}','ActiveLeadsSameID','{{asset('assets/images/ajax-loader.gif')}}','loadLeadData');">View
                                 Leads<span class="ms-2">
                                     <svg class="fill-icon f-light">
                                         <use href="{{ asset('assets/svg/icon-sprite.svg#arrowright') }}"></use>
                                     </svg></span></a>
                         </div>
                     </div>
                 </div>
                 <ul class="square-group">
                     <li class="square-1 warning"></li>
                     <li class="square-1 primary"></li>
                     <li class="square-2 warning1"></li>
                     <li class="square-3 danger"></li>
                     <li class="square-4 light"></li>
                     <li class="square-5 warning"></li>
                     <li class="square-6 success"></li>
                     <li class="square-7 success"></li>
                 </ul>
             </div>
         </div>
     </div>
 </div>
{{--  --}}
 <div class="col-xxl-3 col-xl-4 col-md-6 box-col-6">
     <div class="row">
         <div class="col-sm-12">
             <div class="card course-box widget-course">
                 <div class="card-body">
                     <div class="course-widget">
                         <div class="course-icon pending">
                             <svg class="fill-icon">
                                 <use href="{{ asset('assets/svg/icon-sprite.svg#expense') }}"></use>
                             </svg>
                         </div>
                         <div>
                             <h4 class="mb-0">
                                        {{$provider::HWPreCheckUp('Monthly','TotalActive')}}

                            </h4><span class="f-light">Active Leads - HW</span><a
                                 class="btn btn-light f-light" onclick="ShowCordDashboard('{{route('activator.PreCheckLeads')}}','TotalActive','{{asset('assets/images/ajax-loader.gif')}}','loadLeadData');">View
                                 Leads<span class="ms-2">
                                     <svg class="fill-icon f-light">
                                         <use href="{{ asset('assets/svg/icon-sprite.svg#arrowright') }}"></use>
                                     </svg></span></a>
                         </div>
                     </div>
                 </div>
                 <ul class="square-group">
                     <li class="square-1 warning"></li>
                     <li class="square-1 primary"></li>
                     <li class="square-2 warning1"></li>
                     <li class="square-3 danger"></li>
                     <li class="square-4 light"></li>
                     <li class="square-5 warning"></li>
                     <li class="square-6 success"></li>
                     <li class="square-7 success"></li>
                 </ul>
             </div>
         </div>
     </div>
 </div>
{{--  --}}
{{--  --}}
 <div class="col-xxl-3 col-xl-4 col-md-6 box-col-6">
     <div class="row">
         <div class="col-sm-12">
             <div class="card course-box widget-course">
                 <div class="card-body">
                     <div class="course-widget">
                         <div class="course-icon pending">
                             <svg class="fill-icon">
                                 <use href="{{ asset('assets/svg/icon-sprite.svg#fill-landing-page') }}"></use>
                             </svg>
                         </div>
                         <div>
                             <h4 class="mb-0">
                                        {{$provider::HWPreCheckUp('Monthly','TotalActivePostpaid')}}

                            </h4><span class="f-light">Postpaid Active</span><a
                                 class="btn btn-light f-light" onclick="ShowCordDashboard('{{route('activator.PreCheckLeads')}}','TotalActivePostpaid','{{asset('assets/images/ajax-loader.gif')}}','loadLeadData');">View
                                 Leads<span class="ms-2">
                                     <svg class="fill-icon f-light">
                                         <use href="{{ asset('assets/svg/icon-sprite.svg#arrowright') }}"></use>
                                     </svg></span></a>
                         </div>
                     </div>
                 </div>
                 <ul class="square-group">
                     <li class="square-1 warning"></li>
                     <li class="square-1 primary"></li>
                     <li class="square-2 warning1"></li>
                     <li class="square-3 danger"></li>
                     <li class="square-4 light"></li>
                     <li class="square-5 warning"></li>
                     <li class="square-6 success"></li>
                     <li class="square-7 success"></li>
                 </ul>
             </div>
         </div>
     </div>
 </div>
{{--  --}}

 <div id="loadLeadData">

 </div>

 {{-- @section('script') --}}
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
    {{-- <script>
        $(document).ready(function () {
    $('#basic-1').DataTable({
        dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script> --}}
{{-- @endsection --}}
