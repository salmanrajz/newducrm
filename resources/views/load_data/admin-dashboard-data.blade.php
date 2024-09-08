<div class="table-responsive">
                    <table class="text-center table  table-bordered zero-configuration" id="pdf" style="font-weight:400;">
                        @inject('provider', 'App\Http\Controllers\FunctionController')
                        <thead>
                            <tr>
                            <th colspan="100%" style="background:#FFC107">
                                <h3>
                                     Yearly Performance >>
                                    {{$day = \Carbon\Carbon::parse($date = \Carbon\Carbon::today())->format('l')}},
                                    {{$day = \Carbon\Carbon::parse($date = \Carbon\Carbon::today())->format('M, d, Y')}}
                                </h3>
                            </th>
                        </tr>
                            <tr >
                                <th>S#</th>
                                <th>Agent Name</th>
                                <th>Call Center</th>
                                @php
                                   $start = $month = strtotime('2023-01-01');
                                    $end = strtotime(date('Y-m-d'));
                                    @endphp
                                 @while($month < $end)
                                 <th>

                                     @php
                             echo date('F Y', $month);
                             $month = strtotime("+1 month", $month);
                             @endphp
                             </th>

                             @endwhile
                             <th>Total</th>
                             <th>
                                Team Leader
                             </th>
                                {{-- <th>Activated</th>
                                <th>MNP Activated</th>
                                <th>Verified</th>
                                <th>Non Verified</th>
                                <th>Rejected</th>
                                <th>Follow</th>
                                <th>Later</th> --}}
                                {{-- <th>Carry Forward</th> --}}
                                {{-- <th>Point</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $numberOfAgent = \App\Models\User::whereIn('agent_code',['CL1','CL2','CL3'])->where('role','Sale')->get();
                            @endphp
                            @foreach ($numberOfAgent as $key => $agent)
                            {{-- {{$k == 1}} --}}
                            <tr>
                                <td>
                                    {{++$key}}
                                </td>
                                <td>
                                    {{$agent->name}}
                                </td>
                                <td>
                                    {{$agent->agent_code}}
                                </td>
                                @php
                                   $start = $month = strtotime('2023-01-01');
                                    $end = strtotime(date('Y-m-d'));
                                    @endphp
                                @while($month < $end)
                                {{-- { --}}
                                    {{-- // echo date('F Y', $month), PHP_EOL; --}}

                                {{-- } --}}
                                   {{-- @endphp --}}
                                {{-- <button class="btn btn-success mb-2" onclick="MyLeadPrepaid('1','{{date('Y', $month)}}','{{date('m',$month)}}','{{asset('assets/images/loader.gif')}}')"> --}}
                                    {{-- {{date('m',$month)}} --}}
                                {{-- </button> --}}

                                   @php
                                //    $id= 1;
                                // echo $month;
                                // $year = date('Y',$month);
                                // $year = '2023';
                                // date('F Y', $month);
                                // $month = strtotime("+1 month", $month);
                                // $month = date('m',$month);
                                // $year = '2023';
                                   @endphp
                                   <td>
                                    {{-- {{$month}} --}}
                                    {{-- {{$year}} --}}
                                    {{$hw = $provider::user_monthly_ach($agent->id,date('m',$month),date('Y',$month))}}

                                   </td>
                                    @php
                             date('F Y', $month);
                             $month = strtotime("+1 month", $month);
                             @endphp
                            {{-- {{}} --}}
                            {{-- @php --}}

                            {{-- @endphp --}}

                            @endwhile
                            <td>
                                   {{$hw = $provider::user_total_act($agent->id,'02','2023')}}
                            </td>
                            <td>
                                   {{$hw = $provider::TeamLeaderName($agent->teamleader)}}
                            </td>
                            </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">
                                    Total :
                                    {{$finalTotal = $provider::cctotal(auth()->user()->agent_code,\Carbon\Carbon::now()->month(),'daily')}}
                                </td>

                            </tr>
                        </tfoot>
                    </table>
            </div>
