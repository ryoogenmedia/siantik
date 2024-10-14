<div class="modal fade modalLeft" id="sidebar">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-sidebar">
            <div class="sidebar-header">
                <a href="{{ route('dashboard') }}" class="sidebar-logo">
                    <img src="{{ asset('logo/tik-polri-logo.png') }}" alt="img">
                </a>
                <div>
                    <p>Sistem Presensi Kehadiran</p>
                </div>
            </div>

            <div class="sidebar-content">
                <div class="d-flex gap-10 align-items-center pb-20 line-bt">
                    <div class="avatar avt-40">
                        <img src="{{ auth()->user()->avatarUrl() }}" alt="img">
                    </div>
                    <div class="content-right">
                        <p class="text-1">{{ auth()->user()->roles }}</p>
                        <h6 class="fw-7">{{ auth()->user()->name }}</h6>
                    </div>
                </div>

                <ul class="pt-20 pb-20">
                    <li class="text-sm-start text-uppercase fw-7 text-2">MENU APLIKASI</li>

                    @foreach (config('sidebar') as $sidebar)
                        @if (in_array(auth()->user()->roles, $sidebar['roles']))
                            <li class="mt-18 sub-menu" id="accordionExample">
                                <a href="{{ route($sidebar['route-name']) }}" class="nav-link-item not-link">
                                    <span>{{ $sidebar['title'] }}</span>
                                </a>
                            </li>
                        @endif
                    @endforeach

                    <li class="mt-16">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                            class="nav-link-item not-link">
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </div>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</div>
