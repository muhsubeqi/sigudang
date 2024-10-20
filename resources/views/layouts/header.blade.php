<header id="page-header">
    <!-- Header Content -->
    <div class="content-header">
        <!-- Left Section -->
        <div class="d-flex align-items-center">
            <!-- Toggle Sidebar -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
            <button type="button" class="btn btn-sm btn-alt-secondary me-2 d-lg-none" data-toggle="layout"
                data-action="sidebar_toggle">
                <i class="fa fa-fw fa-bars"></i>
            </button>
            <!-- END Toggle Sidebar -->
            <button type="button" class="btn btn-sm btn-alt-secondary me-2 d-none d-lg-inline-block"
                data-toggle="layout" data-action="sidebar_mini_toggle">
                <i class="fa fa-fw fa-ellipsis-v"></i>
            </button>
        </div>
        <!-- END Left Section -->

        <!-- Right Section -->
        <div class="d-flex align-items-center">
            <!-- User Dropdown -->
            <div class="dropdown d-inline-block ms-2">
                <button type="button" class="btn btn-sm btn-alt-secondary d-flex align-items-center"
                    id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if (Auth::user()->image)
                    <img class="rounded-circle" src="{{ asset('storage/images/user/' . Auth::user()->image) }}"
                        alt="Header Avatar" style="width: 21px;">
                    @else
                    <img class="rounded-circle" src="{{ asset('media/avatars/avatar10.jpg') }}" alt="Header Avatar"
                        style="width: 21px;">
                    @endif
                    <span class="d-none d-sm-inline-block ms-2">{{ Auth::user()->name }}</span>
                    <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block ms-1 mt-1"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0 border-0"
                    aria-labelledby="page-header-user-dropdown">
                    <div class="p-3 text-center bg-body-light border-bottom rounded-top">
                        @if (Auth::user()->image)
                        <img class="img-avatar img-avatar48 img-avatar-thumb"
                            src="{{ asset('storage/images/user/' . Auth::user()->image) }}" alt="">
                        @else
                        <img class="img-avatar img-avatar48 img-avatar-thumb"
                            src="{{ asset('media/avatars/avatar10.jpg') }}" alt="">
                        @endif
                        <p class="mt-2 mb-0 fw-medium">{{ Auth::user()->name }}</p>
                        <p class="mb-0 text-muted fs-sm fw-medium">{{ Auth::user()->email }}</p>
                    </div>
                    <div class="p-2">
                        <a class="dropdown-item d-flex align-items-center justify-content-between"
                            href="{{ route('profile.edit') }}">
                            <span class="fs-sm fw-medium">Profile</span>
                            <span class="badge rounded-pill bg-primary ms-2">1</span>
                        </a>
                    </div>
                    <div role="separator" class="dropdown-divider m-0"></div>
                    <div class="p-2">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                href="{{ route('logout') }}" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                <span class="fs-sm fw-medium">Log Out</span>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
            <!-- END User Dropdown -->
        </div>
        <!-- END Right Section -->
    </div>
    <!-- END Header Content -->

    <!-- Header Search -->
    <div id="page-header-search" class="overlay-header bg-body-extra-light">
        <div class="content-header">
            <form class="w-100" action="/dashboard" method="POST">
                @csrf
                <div class="input-group">
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <button type="button" class="btn btn-alt-danger" data-toggle="layout"
                        data-action="header_search_off">
                        <i class="fa fa-fw fa-times-circle"></i>
                    </button>
                    <input type="text" class="form-control" placeholder="Search or hit ESC.."
                        id="page-header-search-input" name="page-header-search-input">
                </div>
            </form>
        </div>
    </div>
    <!-- END Header Search -->

    <!-- Header Loader -->
    <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
    <div id="page-header-loader" class="overlay-header bg-body-extra-light">
        <div class="content-header">
            <div class="w-100 text-center">
                <i class="fa fa-fw fa-circle-notch fa-spin"></i>
            </div>
        </div>
    </div>
    <!-- END Header Loader -->
</header>