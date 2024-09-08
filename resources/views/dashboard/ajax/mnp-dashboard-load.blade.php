@inject('provider', 'App\Http\Controllers\NumberAssigner')

    <div class="container row mt-3">
        <div class="col-lg-2">
            <div class="card" id="verified_div">
                <div class="card-body text-center" @if(auth()->user()->role == 'FloorManager' || auth()->user()->role ==
                    'TeamLeader' || auth()->user()->role == 'Sale')
                    onclick="window.location.href='{{ route('mnp.status','Arabic') }}'"
                    @endif>
                    <h4 class="white" style="color:#fff;">Arabic</h4>
                    <h6 class="display-6 mt-4 white" style="color:#fff;">
                        {{ $new_complete = $provider::StatusCampaignCount('Arabic',$month) }}
                    </h6>
                </div>
            </div>
        </div>
        {{-- Data Assigned --}}
        <div class="col-lg-2">
            <div class="card" id="verified_div">
                <div class="card-body text-center">
                    <h4 class="white" style="color:#fff;">Data Assigned</h4>
                    <h6 class="display-6 mt-4 white" style="color:#fff;">
                        {{ $new_complete = $provider::StatusCampaignCount('data-assigned',$month) }}
                    </h6>
                </div>
            </div>
        </div>
        {{-- Data Assigned --}}
        {{-- Data Used --}}
        <div class="col-lg-2">
            <div class="card" id="verified_div">
                <div class="card-body text-center">
                    <h4 class="white" style="color:#fff;">Data Used</h4>
                    <h6 class="display-6 mt-4 white" style="color:#fff;">
                        {{ $new_complete = $provider::StatusCampaignCount('data-used',$month) }}
                    </h6>
                </div>
            </div>
        </div>
        {{-- Data Used --}}
        {{-- Data Used --}}
        <div class="col-lg-2">
            <div class="card" id="verified_div">
                <div class="card-body text-center">
                    <h4 class="white" style="color:#fff;">Data Available</h4>
                    <h6 class="display-6 mt-4 white" style="color:#fff;">
                        {{ $new_complete = $provider::StatusCampaignCount('data-available',$month) }}
                    </h6>
                </div>
            </div>
        </div>
        {{-- Data Used --}}

    </div>
    {{-- 1st End --}}
    {{-- 2nd --}}
    <div class="container row mt-3">
        <div class="col-lg-2">
            <div class="card" id="verified_div">
                <div class="card-body text-center" @if(auth()->user()->role == 'FloorManager' || auth()->user()->role ==
                    'TeamLeader' || auth()->user()->role == 'Sale')
                    onclick="window.location.href='{{ route('mnp.status','Already Postpaid') }}'"
                    @endif>
                    <h4 class="white" style="color:#fff;">Already Postpaid</h4>
                    <h6 class="display-6 mt-4 white" style="color:#fff;">
                        {{ $new_complete = $provider::StatusCampaignCount('Already Postpaid',$month) }}
                    </h6>
                </div>
            </div>
        </div>
        {{-- Data Assigned --}}
        <div class="col-lg-2">
            <div class="card" id="verified_div">
                <div class="card-body text-center" @if(auth()->user()->role == 'FloorManager' || auth()->user()->role ==
                    'TeamLeader' || auth()->user()->role == 'Sale')
                    onclick="window.location.href='{{ route('mnp.status','Not Interested') }}'"
                    @endif>
                    <h4 class="white" style="color:#fff;">Not Interested</h4>
                    <h6 class="display-6 mt-4 white" style="color:#fff;">
                        {{ $new_complete = $provider::StatusCampaignCount('Not Interested',$month) }}
                    </h6>
                </div>
            </div>
        </div>
        {{-- Data Assigned --}}
        {{-- Data Used --}}
        <div class="col-lg-2">
            <div class="card" id="verified_div">
                <div class="card-body text-center" @if(auth()->user()->role == 'FloorManager' || auth()->user()->role ==
                    'TeamLeader' || auth()->user()->role == 'Sale')
                    onclick="window.location.href='{{ route('mnp.status','No Answer') }}'"
                    @endif>
                    <h4 class="white" style="color:#fff;">No Answer</h4>
                    <h6 class="display-6 mt-4 white" style="color:#fff;">
                        {{ $new_complete = $provider::StatusCampaignCount('No Answer',$month) }}
                    </h6>
                </div>
            </div>
        </div>
        {{-- Data Used --}}
        {{-- Data Used --}}
        <div class="col-lg-2">
            <div class="card" id="verified_div">
                <div class="card-body text-center" @if(auth()->user()->role == 'FloorManager' || auth()->user()->role ==
                    'TeamLeader' || auth()->user()->role == 'Sale')
                    onclick="window.location.href='{{ route('mnp.status','Switch Off') }}'"
                    @endif>
                    <h4 class="white" style="color:#fff;">Switch Off</h4>
                    <h6 class="display-6 mt-4 white" style="color:#fff;">
                        {{ $new_complete = $provider::StatusCampaignCount('Switch Off',$month) }}
                    </h6>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="card" id="verified_div">
                <div class="card-body text-center" @if(auth()->user()->role == 'FloorManager' || auth()->user()->role ==
                    'TeamLeader' || auth()->user()->role == 'Sale')
                    onclick="window.location.href='{{ route('mnp.status','DNC') }}'"
                    @endif>
                    <h4 class="white" style="color:#fff;">DNC</h4>
                    <h6 class="display-6 mt-4 white" style="color:#fff;">
                        {{ $new_complete = $provider::StatusCampaignCount('DNC',$month) }}
                    </h6>
                </div>
            </div>
        </div>
        {{-- Data Used --}}

    </div>
    {{-- 2nd Data --}}
    {{-- 3rd --}}
    <div class="container row mt-3">
        <div class="col-lg-2">
            <div class="card" id="verified_div">
                <div class="card-body text-center"
                    onclick="window.location.href='{{ route('mnp.status','Follow up') }}'">
                    <h4 class="white" style="color:#fff;">Follow Up</h4>
                    <h6 class="display-6 mt-4 white" style="color:#fff;">
                        {{ $new_complete = $provider::StatusCampaignCount('Follow up',$month) }}
                    </h6>
                </div>
            </div>
        </div>
        {{-- Data Assigned --}}
        {{-- <div class="col-lg-2">
                        <div class="card" id="verified_div">
                            <div class="card-body text-center" onclick="window.location.href='{{ route('mnp.status','Follow-up---Interested') }}'">
        <h4 class="white" style="color:#fff;">Follow up Interested</h4>
        <h6 class="display-6 mt-4 white" style="color:#fff;">
            {{ $new_complete = $provider::StatusCampaignCount('Follow up - Interested',$month) }}
        </h6>
    </div>
    </div>
    </div> --}}
    {{-- Data Assigned --}}
    {{-- Data Used --}}
    <div class="col-lg-2">
        <div class="card" id="verified_div">
            <div class="card-body text-center" @if(auth()->user()->role == 'FloorManager' || auth()->user()->role ==
                'TeamLeader' || auth()->user()->role == 'Sale')
                onclick="window.location.href='{{ route('mnp.status','Call Later') }}'"
                @endif>
                <h4 class="white" style="color:#fff;">Call Later</h4>
                <h6 class="display-6 mt-4 white" style="color:#fff;">
                    {{ $new_complete = $provider::StatusCampaignCount('Call Later',$month) }}
                </h6>
            </div>
        </div>
    </div>
    {{-- Data Used --}}
    {{-- Data Used --}}
    <div class="col-lg-2">
        <div class="card" id="verified_div">
            <div class="card-body text-center" @if(auth()->user()->role == 'FloorManager' || auth()->user()->role ==
                'TeamLeader' || auth()->user()->role == 'Sale')
                onclick="window.location.href='{{ route('mnp.status','Interested But Less Salary') }}'"
                @endif>
                <h4 class="white" style="color:#fff;">Less Salary Interested</h4>
                <h6 class="display-6 mt-4 white" style="color:#fff;">
                    {{ $new_complete = $provider::StatusCampaignCount('Interested But Less Salary',$month) }}
                </h6>
            </div>
        </div>
    </div>
    <div class="col-lg-2">
        <div class="card" id="verified_div">
            <div class="card-body text-center" @if(auth()->user()->role == 'FloorManager' || auth()->user()->role ==
                'TeamLeader' || auth()->user()->role == 'Sale')
                onclick="window.location.href='{{ route('mnp.status','No Docs Interested') }}'"
                @endif>
                <h4 class="white" style="color:#fff;">No Docs Interested</h4>
                <h6 class="display-6 mt-4 white" style="color:#fff;">
                    {{ $new_complete = $provider::StatusCampaignCount('No Docs Interested',$month) }}
                </h6>
            </div>
        </div>
    </div>
    {{-- Data Used --}}

    </div>
    {{-- erd Data --}}
    {{-- 4th --}}
    <div class="container row mt-3">
        <div class="col-lg-2">
            <div class="card" id="verified_div">
                <div class="card-body text-center"
                    onclick="window.location.href='{{ route('mnp.status','Lead') }}'">
                    <h4 class="white" style="color:#fff;">Lead</h4>
                    <h6 class="display-6 mt-4 white" style="color:#fff;">
                        {{ $new_complete = $provider::StatusCampaignCount('Lead',$month) }}
                    </h6>
                </div>
            </div>
        </div>
        {{-- Data Assigned --}}
        <div class="col-lg-2">
            <div class="card" id="verified_div">
                <div class="card-body text-center">
                    <h4 class="white" style="color:#fff;">Active</h4>
                    <h6 class="display-6 mt-4 white" style="color:#fff;">
                        {{ $new_complete = $provider::StatusCampaignCount('Active',$month) }}
                    </h6>
                </div>
            </div>
        </div>
        {{-- Data Assigned --}}
        {{-- Data Used --}}
        <div class="col-lg-2">
            <div class="card" id="verified_div">
                <div class="card-body text-center">
                    <h4 class="white" style="color:#fff;">Rejected</h4>
                    <h6 class="display-6 mt-4 white" style="color:#fff;">
                        {{ $new_complete = $provider::StatusCampaignCount('Rejected',$month) }}
                    </h6>
                </div>
            </div>
        </div>
        {{-- Data Used --}}
    </div>
    {{-- 4th End --}}
