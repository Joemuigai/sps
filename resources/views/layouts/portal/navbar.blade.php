<div id="header" class="app-header app-header-inverse">
    <div class="navbar-header">
        <a class="navbar-brand"> <img src="{{ asset('assets/img/logo/studentaffairslogo.png') }}" height="120"
                alt="Strath Logo" />

        </a>
        <button type="button" class="navbar-mobile-toggler" data-toggle="app-sidebar-mobile">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>

    <div class="navbar-nav">
        <div class="navbar-item navbar-form">
            {{-- @if (session('role') == 'Administrator')
                <form action="{{ route('admin.studentSearch') }}" method="POST" name="search">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="student_id" class="form-control" placeholder="Enter Student ID"
                            required />
                        <button type="submit" class="btn btn-search">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
            @endif --}}

        </div>
        {{-- <div class="navbar-item dropdown">
            <a href="#" data-bs-toggle="dropdown" class="navbar-link dropdown-toggle icon">
                <i class="fa fa-bell"></i>
                <span class="badge">5</span>
            </a>
            <div class="dropdown-menu media-list dropdown-menu-end">
                <div class="dropdown-header">NOTIFICATIONS (1)</div>
                <a href="javascript:;" class="dropdown-item media">
                    <div class="media-left">
                        <i class="fa fa-bug media-object bg-gray-400"></i>
                    </div>
                    <div class="media-body">
                        <h6 class="media-heading">
                            Server Error Reports
                            <i class="fa fa-exclamation-circle text-danger"></i>
                        </h6>
                        <div class="text-muted fs-10px">3 minutes ago</div>
                    </div>
                </a>

                <div class="dropdown-footer text-center">
                    <a href="javascript:;" class="text-decoration-none">View more</a>
                </div>
            </div>
        </div> --}}
        <div class="navbar-item navbar-user dropdown">
            <a href="#" class="navbar-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                <img src="{{ asset('assets/img/user/profile.jpg') }}" alt="Profile Image" />
                <span class="d-none d-md-inline">
                    {{ session('name') }}
                </span>
                <b class="caret ms-6px"></b>
            </a>
            <div class="dropdown-menu dropdown-menu-end me-1">
                {{-- <a href="extra_profile.html" class="dropdown-item">Edit Profile</a>
                <a href="settings.html" class="dropdown-item">Settings</a> --}}
                <div class="dropdown-divider"></div>
                <a href="{{ route('account.logout') }}" class="dropdown-item">Log Out</a>
            </div>
        </div>
    </div>
</div>
