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
                        <img style="border-radius: 100%" src="{{ auth()->user()->avatarUrl() }}" alt="img">
                    </div>
                    <div class="content-right">
                        <p class="text-1 py-1 px-2 d-inline rounded-2"
                            style="font-size: 13px; background-color: #bfffb9; color: #41a722">
                            {{ auth()->user()->roles }}</p>
                        <h6 class="fw-7 mt-1">{{ auth()->user()->name }}</h6>
                    </div>
                </div>

                <ul class="pt-20 pb-20">
                    <li class="text-sm-start text-uppercase fw-7 text-2">MENU APLIKASI</li>

                    @foreach (config('sidebar') as $sidebar)
                        @if (in_array(auth()->user()->roles, $sidebar['roles']))
                            <li class="mt-18 sub-menu" id="accordionExample">
                                <a href="{{ route($sidebar['route-name']) }}" class="nav-link-item not-link">
                                    <div><span style="font-weight: bold"
                                            class="me-2 text-primary las la-{{ $sidebar['icon'] }}"></span>
                                        {{ $sidebar['title'] }}
                                    </div>
                                </a>
                            </li>
                        @endif
                    @endforeach

                    <li style="margin-top: 60px" class="d-flex justify-content-center">
                        <a class="btn btn-danger text-white w-100" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                            class="nav-link-item not-link">
                            <b>Keluar Aplikasi <span class="ms-1 las la-arrow-right fw-bold"></span></b>
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
