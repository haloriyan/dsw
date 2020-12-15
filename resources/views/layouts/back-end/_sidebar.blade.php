        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-people-arrows"></i>
                </div>
                <div class="sidebar-brand-text mx-3">DSW</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Master
            </div>

            <!-- Nav Item - User -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.faq') }}">
                    <i class="fas fa-fw fa-question"></i>
                    <span>FAQ</span></a>
            </li>

            <!-- Nav Item - Jenis Pekerhaan -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.contact') }}">
                    <i class="fas fa-fw fa-phone-alt"></i>
                    <span>Contact</span></a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.sponsorType') }}">
                    <i class="fas fa-fw fa-ad"></i>
                    <span>Jenis Sponsor</span></a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.sponsor') }}">
                    <i class="fas fa-fw fa-ad"></i>
                    <span>Sponsor</span></a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.eventType') }}">
                    <i class="fas fa-fw fa-calender"></i>
                    <span>Jenis Event</span></a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.event') }}">
                    <i class="fas fa-fw fa-calender"></i>
                    <span>Event</span></a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.speaker') }}">
                    <i class="far fa-fw fa-users"></i>
                    <span>Speaker</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Kirim
            </div>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-paper-plane"></i>
                    <span>Push Notifikasi</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
