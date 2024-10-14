<div class="modal fade modalLeft" id="sidebar">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-sidebar">
            <div class="sidebar-header">
                <a href="{{ route('dashboard') }}" class="sidebar-logo">
                    <img src="{{ asset('logo/tik-polri-logo.png') }}" alt="img">
                </a>
                <p>Sistem Aplikasi Presensi TIK POLRI</p>
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
                    <li class="mt-18 sub-menu" id="accordionExample">
                        <a href="index.html" class="nav-link-item not-link">
                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 20 20" fill="none">
                                <path
                                    d="M7.62043 17.3185V14.7628C7.62042 14.1152 8.14704 13.589 8.79935 13.5849H11.1945C11.8497 13.5849 12.3809 14.1123 12.3809 14.7628V17.3111C12.3809 17.8728 12.8373 18.3293 13.4031 18.3334H15.0372C15.8003 18.3354 16.5329 18.0357 17.0733 17.5007C17.6136 16.9656 17.9173 16.239 17.9173 15.4813V8.22162C17.9173 7.60957 17.644 7.02901 17.1712 6.63633L11.6198 2.22864C10.6494 1.45768 9.26346 1.48259 8.32181 2.2879L2.88983 6.63633C2.3946 7.01743 2.09861 7.59972 2.08398 8.22162V15.4739C2.08398 17.0532 3.37347 18.3334 4.96413 18.3334H6.56089C6.83329 18.3354 7.09522 18.2293 7.28855 18.0388C7.48187 17.8482 7.59059 17.589 7.59058 17.3185H7.62043Z"
                                    fill="#D3D5DA" />
                            </svg>
                            <span>Home</span>
                        </a>
                    </li>

                    <li class="mt-16">
                        <a href="javascript:void(0);" class="nav-link-item btn-choose-page">
                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 20 20" fill="none">
                                <path opacity="0.4"
                                    d="M15.6734 7.51758C15.2971 7.51758 14.7987 7.50925 14.1782 7.50925C12.6649 7.50925 11.4206 6.25675 11.4206 4.72925V2.04925C11.4206 1.83841 11.2523 1.66675 11.0436 1.66675H6.6357C4.57865 1.66675 2.91602 3.35508 2.91602 5.42425V14.4034C2.91602 16.5742 4.65787 18.3334 6.80733 18.3334H13.3712C15.4209 18.3334 17.0827 16.6559 17.0827 14.5851V7.89258C17.0827 7.68091 16.9152 7.51008 16.7056 7.51091C16.3533 7.51341 15.9308 7.51758 15.6734 7.51758Z"
                                    fill="#D3D5DA" />
                                <path opacity="0.4"
                                    d="M13.4029 2.13947C13.1538 1.88031 12.7188 2.05864 12.7188 2.41781V4.61531C12.7188 5.53697 13.4779 6.29531 14.3996 6.29531C14.9804 6.30197 15.7871 6.30364 16.4721 6.30197C16.8229 6.30114 17.0013 5.88197 16.7579 5.62864C15.8788 4.71447 14.3046 3.07614 13.4029 2.13947Z"
                                    fill="#D3D5DA" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.47742 9.48986H10.2983C10.6408 9.48986 10.9191 9.21236 10.9191 8.86986C10.9191 8.52736 10.6408 8.24902 10.2983 8.24902H7.47742C7.13492 8.24902 6.85742 8.52736 6.85742 8.86986C6.85742 9.21236 7.13492 9.48986 7.47742 9.48986ZM7.47751 13.6517H12.0142C12.3567 13.6517 12.635 13.3742 12.635 13.0317C12.635 12.6892 12.3567 12.4109 12.0142 12.4109H7.47751C7.13501 12.4109 6.85751 12.6892 6.85751 13.0317C6.85751 13.3742 7.13501 13.6517 7.47751 13.6517Z"
                                    fill="#D3D5DA" />
                            </svg>
                            <span>Pages</span>
                        </a>
                    </li>

                    <li class="mt-16">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                            class="nav-link-item not-link">

                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 20 20" fill="none">
                                <path opacity="0.4"
                                    d="M1.66602 5.37258C1.66602 3.33008 3.35788 1.66675 5.43646 1.66675H9.57072C11.6451 1.66675 13.3327 3.32508 13.3327 5.36425V14.6276C13.3327 16.6709 11.6408 18.3334 9.56139 18.3334H5.42883C3.35364 18.3334 1.66602 16.6751 1.66602 14.6359V13.8526V5.37258Z"
                                    fill="#D3D5DA" />
                                <path
                                    d="M18.149 9.54579L15.7775 7.12162C15.5324 6.87162 15.138 6.87162 14.8937 7.12329C14.6502 7.37495 14.651 7.78079 14.8953 8.03079L16.1947 9.35828H14.9489H7.95696C7.61203 9.35828 7.33203 9.64579 7.33203 9.99995C7.33203 10.355 7.61203 10.6416 7.95696 10.6416H16.1947L14.8953 11.9691C14.651 12.2191 14.6502 12.625 14.8937 12.8766C15.0162 13.0025 15.1761 13.0658 15.3368 13.0658C15.4959 13.0658 15.6558 13.0025 15.7775 12.8783L18.149 10.455C18.2667 10.3341 18.3333 10.1708 18.3333 9.99995C18.3333 9.82995 18.2667 9.66662 18.149 9.54579Z"
                                    fill="#D3D5DA" />
                            </svg>

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
