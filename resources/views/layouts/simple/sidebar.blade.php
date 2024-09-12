<div class="sidebar-wrapper" sidebar-layout="stroke-svg">
    <div>
        <div class="logo-wrapper"><a href="{{ route('index') }}"><img class="img-fluid for-light"
                    src="{{ asset('assets/images/logo/logo.png') }}" alt=""><img class="img-fluid for-dark"
                    src="{{ asset('assets/images/logo/logo_dark.png') }}" alt=""></a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
        </div>
        <div class="logo-icon-wrapper"><a href="{{ route('index') }}"><img class="img-fluid"
                    src="{{ asset('assets/images/logo/logo-icon.png') }}" alt=""></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"><a href="{{ route('index') }}"><img class="img-fluid"
                                src="{{ asset('assets/images/logo/logo-icon.png') }}" alt=""></a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i></div>
                    </li>
                    <li class="pin-title sidebar-main-title">
                        <div>
                            <h6>Pinned</h6>
                        </div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6 class="lan-1">General</h6>
                        </div>
                    </li>
                    @role('Sale')
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                        <label class="badge badge-light-primary">5</label><a class="sidebar-link sidebar-title"
                            href="#">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-home') }}"></use>
                            </svg><span class="lan-3">Dashboard</span></a>
                        <ul class="sidebar-submenu">
                            <li><a class="" href="{{ route('index') }}">Dashboard</a></li>
                            <li><a class="" href="{{ route('add-lead-data') }}">Add Data</a></li>
                            <li><a class="" href="{{ route('my_call_log') }}">Call Log</a></li>
                            <li><a class="" href="{{ route('MyLogDashboard') }}">View Call Log</a></li>
                            <li><a class="" href="{{ route('my_call_log_expired') }}">4G Call Log</a></li>
                            <li><a class="" href="{{ route('MyLogDashboardExpired') }}">View 4G Call Log</a></li>
                        </ul>
                    </li>
                    @endrole
                    @role('MainAdmin')
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                        <label class="badge badge-light-primary">5</label><a class="sidebar-link sidebar-title"
                            href="#">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-home') }}"></use>
                            </svg><span class="lan-3">Dashboard</span></a>
                        <ul class="sidebar-submenu">
                            <li><a class="" href="{{ route('index') }}">Dashboard</a></li>
                            <li><a class="" href="{{ route('users.add') }}">Add Users</a></li>
                            <li><a class="" href="{{ route('view-users') }}">View Users</a></li>
                            {{-- <li><a class="" href="{{ route('call.center') }}">Add CC</a></li> --}}
                            <li><a class="" href="{{ route('call.center') }}">View CC</a></li>
                            <li><a class="" href="{{ route('checksecretcode') }}">Secret Code</a></li>
                            <li><a class="" href="{{ route('checkleadnumber') }}">Search Lead</a></li>
                        </ul>
                    </li>

                    @endrole
                    @role('Activator')
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                        <label class="badge badge-light-primary">5</label><a class="sidebar-link sidebar-title"
                            href="#">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-home') }}"></use>
                            </svg><span class="lan-3">Dashboard</span></a>
                        <ul class="sidebar-submenu">
                            <li><a class="" href="{{ route('checksecretcode') }}">Secret Code</a></li>
                        </ul>
                    </li>

                    @endrole

                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
