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
                                        {{$provider::HWPreCheckUp('Monthly','PendingVerificationHw')}}


                            </h4><span class="f-light">Pending Verification</span><a
                                 class="btn btn-light f-light" onclick="ShowCordDashboard('{{route('activator.PreCheckLeads')}}','PendingVerificationHw','{{asset('assets/images/ajax-loader.gif')}}','loadLeadData');">View
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
                                 <use href="{{ asset('assets/svg/icon-sprite.svg#course-1') }}"></use>
                             </svg>
                         </div>
                         <div>
                             <h4 class="mb-0">
                                        {{$provider::HWPreCheckUp('Monthly','PendingVerificationPP')}}

                            </h4><span class="f-light">Postpaid Pending Leads</span><a
                                 class="btn btn-light f-light"
                                 onclick="ShowCordDashboard('{{route('activator.PreCheckLeads')}}','PendingVerificationPP','{{asset('assets/images/ajax-loader.gif')}}','loadLeadData');"
                                 >View
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
                                        {{$provider::HWCheckUp('Monthly','inprocess')}}

                            </h4><span class="f-light">Total Verified Leads</span><a
                                 class="btn btn-light f-light" >Recount
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
