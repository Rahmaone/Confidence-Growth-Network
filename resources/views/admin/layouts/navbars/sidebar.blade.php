<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">{{ __('CGN') }}</a>
            <a href="#" class="simple-text logo-normal">{{ __('CGN Dashboard') }}</a>
        </div>
        <ul class="nav">
            <li>
                <a href="{{ route('admin.home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#users" aria-expanded="true">
                    <i class="tim-icons icon-user-run"></i>
                    <span class="nav-link-text">{{ __('User Management') }}</span>
                    <b class="caret mt-1"></b>
                </a>
                <div class="collapse show" id="users">
                    <ul class="nav pl-4">
                        <li>
                            <a href="{{ route('admin.userManagement') }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Daftar User') }}</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.buatUser') }}">
                                <i class="tim-icons icon-simple-add"></i>
                                <p>{{ __('Tambah User') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#modul-pembelajaran" aria-expanded="true">
                    <i class="tim-icons icon-book-bookmark"></i>
                    <span class="nav-link-text">{{ __('Modul Pembelajaran') }}</span>
                    <b class="caret mt-1"></b>
                </a>
                <div class="collapse show" id="modul-pembelajaran">
                    <ul class="nav pl-4">
                        <li>
                            <a href="{{ route('admin.modulPembelajaran') }}">
                                <i class="tim-icons icon-align-center"></i>
                                <p>{{ __('List') }}</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.buatModul') }}">
                                <i class="tim-icons icon-simple-add"></i>
                                <p>{{ __('Tambah Modul') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
                <a data-toggle="collapse" href="#events" aria-expanded="true">
                    <i class="tim-icons icon-calendar-60"></i>
                    <span class="nav-link-text">{{ __('Events') }}</span>
                    <b class="caret mt-1"></b>
                </a>
                <div class="collapse show" id="events">
                    <ul class="nav pl-4">
                        <li>
                            <a href="{{ route('admin.eventAnnouncement') }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Daftar Event') }}</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.buatEvent') }}">
                                <i class="tim-icons icon-simple-add"></i>
                                <p>{{ __('Tambah Event') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>