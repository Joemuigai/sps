<div id="sidebar" class="app-sidebar app-sidebar-grid">
    <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
        <div class="menu">
            <div class="menu-profile">
                <a href="javascript:;" class="menu-profile-link" data-toggle="app-sidebar-profile"
                    data-target="#appSidebarProfileMenu">
                    <div class="menu-profile-cover with-shadow"></div>
                    <div class="menu-profile-image">
                        <img src="{{ asset('assets/img/user/profile.jpg') }}" alt="Profile Image" />
                    </div>
                    <div class="menu-profile-info">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                {{ session('name') }}

                            </div>

                        </div>
                        <small>
                            {{ session('role') }}
                        </small>
                    </div>
                </a>
            </div>



            <div class="menu-header">Navigation</div>


            @if (auth()->user()->hasRole('Administrator'))
                {{-- Admin Portal Sidebar Functionalities --}}

                <div class="menu-item mb-1 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="menu-link">
                        <div class="menu-icon">
                            <i class="fa fa-dashboard"></i>
                        </div>
                        <div class="menu-text">
                            Dashboard
                        </div>
                    </a>
                </div>

                <div class="menu-item {{ request()->routeIs('admin.systemUsers') ? 'active' : '' }}">
                    <a href="{{ route('admin.systemUsers') }}" class="menu-link">
                        <div class="menu-icon">
                            <i class="fa fa-universal-access"></i>
                        </div>
                        <div class="menu-text">
                            System Users
                        </div>
                    </a>
                </div>

                <div class="menu-item {{ request()->routeIs('admin.parkingLots') ? 'active' : '' }}">
                    <a href="{{ route('admin.parkingLots') }}" class="menu-link">
                        <div class="menu-icon">
                            <i class="fa fa-cubes-stacked"></i>
                        </div>
                        <div class="menu-text">
                            Parking Lots
                        </div>
                    </a>
                </div>

                <div class="menu-item {{ request()->routeIs('admin.students') ? 'active' : '' }}">
                    <a href="{{ route('admin.students') }}" class="menu-link">
                        <div class="menu-icon">
                            <i class="fa fa-user-gear"></i>
                        </div>
                        <div class="menu-text">
                            Students
                        </div>
                    </a>
                </div>

                <div class="menu-item {{ request()->routeIs('admin.cars') ? 'active' : '' }}">
                    <a href="{{ route('admin.cars') }}" class="menu-link">
                        <div class="menu-icon">
                            <i class="fa fa-car"></i>
                        </div>
                        <div class="menu-text">
                            Registered Cars
                        </div>
                    </a>
                </div>

                <div class="menu-item {{ request()->routeIs('admin.logs') ? 'active' : '' }}">
                    <a href="{{ route('admin.logs') }}" class="menu-link">
                        <div class="menu-icon">
                            <i class="fa fa-fax"></i>
                        </div>
                        <div class="menu-text">
                            Parking Logs
                        </div>
                    </a>
                </div>

                {{-- End Admin Portal Sidebar Functionalities --}}

            @elseif (auth()->user()->hasRole('Student'))
                {{-- Member Sidebar Functionalities --}}

                <div class="menu-item mb-1 {{ request()->is('member/profile*') ? 'active' : '' }}">
                    <a href="{{ route('member.profile') }}" class="menu-link">
                        <div class="menu-icon">
                            <i class="fa fa-user-shield
                        "></i>
                        </div>
                        <div class="menu-text">
                            Member Profile
                        </div>
                    </a>
                </div>

                <div class="menu-item mb-1 {{ request()->is('member/registered_cars*') ? 'active' : '' }}">
                    <a href="{{ route('member.cars') }}" class="menu-link">
                        <div class="menu-icon">
                            <i class="fa fa-car
                        "></i>
                        </div>
                        <div class="menu-text">
                            Registered Cars
                        </div>
                    </a>
                </div>

                <div class="menu-item mb-1 {{ request()->is('member/parking_logs*') ? 'active' : '' }}">
                    <a href="{{ route('member.parkingLoogs') }}" class="menu-link">
                        <div class="menu-icon">
                            <i class="fa fa-fax
                        "></i>
                        </div>
                        <div class="menu-text">
                            Parking Logs
                        </div>
                    </a>
                </div>

                {{-- End Member Sidebar Functionalities --}}


            @endif





            <div class="menu-item d-flex">
                <a href="javascript:;"
                    class="app-sidebar-minify-btn ms-auto d-flex align-items-center text-decoration-none"
                    data-toggle="app-sidebar-minify"><i class="fa fa-angle-double-left"></i></a>
            </div>
        </div>
    </div>
</div>
<div class="app-sidebar-bg"></div>
<div class="app-sidebar-mobile-backdrop">
    <a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a>
</div>
