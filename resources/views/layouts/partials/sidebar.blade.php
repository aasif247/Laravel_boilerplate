{{--
    * Author           :         System Decoder
    * App Version      :         1.0.0
    * Email            :         contact@systemdecoder.com
    * Author URL       :         https://www.systemdecoder.com
--}}

<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">
            <img src="{{ asset(auth()->user()->profile_photo_path) }}" alt="{{ auth()->user()->name }}" title="{{ auth()->user()->name }}"
                 class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                   data-bs-toggle="dropdown">{{ auth()->user()->name }}</a>
                <div class="dropdown-menu user-pro-dropdown">

                    <!-- item-->
                    <a href="{{ url('profile') }}" class="dropdown-item notify-item">
                        <i class="fe-user me-1"></i>
                        <span>Profile</span>
                    </a>

                    <!-- item-->
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item notify-item">
                        <i class="fe-log-out me-1"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li>
                    <a href="{{ route('dashboard') }}">
                        <i data-feather="airplay"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                <li class="menu-title mt-2">Apps</li>
                <li>
                    <a href="#sidebarProduct" data-bs-toggle="collapse">
                        <i data-feather="shopping-cart"></i>
                        <span> Product </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarProduct">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('products.index') }}">Product List</a>
                            </li>
                            <li>
                                <a href="{{ route('products.create') }}">Create Product</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="{{ route('users.index') }}">
                        <i data-feather="user"></i>
                        <span> Users </span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('application/settings') }}">
                        <i data-feather="settings"></i>
                        <span>Application Settings </span>
                    </a>
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
