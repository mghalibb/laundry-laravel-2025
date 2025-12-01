<div class="topbar d-print-none">
    <div class="container-fluid">
        <nav class="topbar-custom d-flex justify-content-between" id="topbar-custom">
            <ul class="topbar-item list-unstyled d-inline-flex align-items-center mb-0">
                <li>
                    <button class="nav-link mobile-menu-btn nav-icon" id="togglemenu">
                        <i class="iconoir-menu"></i>
                    </button>
                </li>
            </ul>

            <ul class="topbar-item list-unstyled d-inline-flex align-items-center mb-0">
                {{-- // ==========================================================
                        === DARK MODE ===
                    // ========================================================== --}}
                <li class="topbar-item">
                    <a class="nav-link nav-icon" href="javascript:void(0);" id="light-dark-mode">
                        <i class="iconoir-half-moon dark-mode"></i>
                        <i class="iconoir-sun-light light-mode"></i>
                    </a>
                </li>
                {{-- // ==========================================================
                        === DARK MODE ===
                    // ========================================================== --}}

                {{-- // ==========================================================
                        === NOTIFICATIONS ===
                    // ========================================================== --}}
                <li class="dropdown topbar-item">
                    <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false" data-bs-offset="0,19">
                        <i class="iconoir-bell"></i>
                        <span class="alert-badge"></span>
                    </a>
                    <div class="dropdown-menu stop dropdown-menu-end dropdown-lg py-0">

                        <h5 class="dropdown-item-text m-0 py-3 d-flex justify-content-between align-items-center">
                            Notifications <a href="#" class="badge text-body-tertiary badge-pill">
                                <i class="iconoir-plus-circle fs-4"></i>
                            </a>
                        </h5>
                        <ul class="nav nav-tabs nav-tabs-custom nav-success nav-justified mb-1" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link mx-0 active" data-bs-toggle="tab" href="#All" role="tab"
                                    aria-selected="true">
                                    All <span class="badge bg-primary-subtle text-primary badge-pill ms-1">24</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link mx-0" data-bs-toggle="tab" href="#Projects" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    Projects
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link mx-0" data-bs-toggle="tab" href="#Teams" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    Team
                                </a>
                            </li>
                        </ul>

                        <div class="ms-0" style="max-height:230px;" data-simplebar>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="All" role="tabpanel"
                                    aria-labelledby="all-tab" tabindex="0">
                                    <!-- item-->
                                    <a href="#" class="dropdown-item py-3">
                                        <small class="float-end text-muted ps-2">2 min ago</small>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="flex-shrink-0 bg-primary-subtle text-primary thumb-md rounded-circle">
                                                <i class="iconoir-wolf fs-4"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2 text-truncate">
                                                <h6 class="my-0 fw-normal text-dark fs-13">Your order is placed</h6>
                                                <small class="text-muted mb-0">Dummy text of the printing and
                                                    industry.</small>
                                            </div>
                                            <!--end media-body-->
                                        </div>
                                        <!--end media-->
                                    </a>
                                    <!--end-item-->
                                    <!-- item-->
                                    <a href="#" class="dropdown-item py-3">
                                        <small class="float-end text-muted ps-2">10 min ago</small>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="flex-shrink-0 bg-primary-subtle text-primary thumb-md rounded-circle">
                                                <i class="iconoir-apple-swift fs-4"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2 text-truncate">
                                                <h6 class="my-0 fw-normal text-dark fs-13">Meeting with designers</h6>
                                                <small class="text-muted mb-0">It is a long established fact that a
                                                    reader.</small>
                                            </div>
                                            <!--end media-body-->
                                        </div>
                                        <!--end media-->
                                    </a>
                                    <!--end-item-->
                                    <!-- item-->
                                    <a href="#" class="dropdown-item py-3">
                                        <small class="float-end text-muted ps-2">40 min ago</small>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="flex-shrink-0 bg-primary-subtle text-primary thumb-md rounded-circle">
                                                <i class="iconoir-birthday-cake fs-4"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2 text-truncate">
                                                <h6 class="my-0 fw-normal text-dark fs-13">UX 3 Task complete.</h6>
                                                <small class="text-muted mb-0">Dummy text of the printing.</small>
                                            </div>
                                            <!--end media-body-->
                                        </div>
                                        <!--end media-->
                                    </a>
                                    <!--end-item-->
                                    <!-- item-->
                                    <a href="#" class="dropdown-item py-3">
                                        <small class="float-end text-muted ps-2">1 hr ago</small>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="flex-shrink-0 bg-primary-subtle text-primary thumb-md rounded-circle">
                                                <i class="iconoir-drone fs-4"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2 text-truncate">
                                                <h6 class="my-0 fw-normal text-dark fs-13">Your order is placed</h6>
                                                <small class="text-muted mb-0">It is a long established fact that a
                                                    reader.</small>
                                            </div>
                                            <!--end media-body-->
                                        </div>
                                        <!--end media-->
                                    </a>
                                    <!--end-item-->
                                    <!-- item-->
                                    <a href="#" class="dropdown-item py-3">
                                        <small class="float-end text-muted ps-2">2 hrs ago</small>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="flex-shrink-0 bg-primary-subtle text-primary thumb-md rounded-circle">
                                                <i class="iconoir-user fs-4"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2 text-truncate">
                                                <h6 class="my-0 fw-normal text-dark fs-13">Payment Successfull</h6>
                                                <small class="text-muted mb-0">Dummy text of the printing.</small>
                                            </div>
                                            <!--end media-body-->
                                        </div>
                                        <!--end media-->
                                    </a>
                                    <!--end-item-->
                                </div>

                                <div class="tab-pane fade" id="Projects" role="tabpanel"
                                    aria-labelledby="projects-tab" tabindex="0">
                                    <!-- item-->
                                    <a href="#" class="dropdown-item py-3">
                                        <small class="float-end text-muted ps-2">40 min ago</small>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="flex-shrink-0 bg-primary-subtle text-primary thumb-md rounded-circle">
                                                <i class="iconoir-birthday-cake fs-4"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2 text-truncate">
                                                <h6 class="my-0 fw-normal text-dark fs-13">UX 3 Task complete.</h6>
                                                <small class="text-muted mb-0">Dummy text of the printing.</small>
                                            </div>
                                            <!--end media-body-->
                                        </div>
                                        <!--end media-->
                                    </a>
                                    <!--end-item-->
                                    <!-- item-->
                                    <a href="#" class="dropdown-item py-3">
                                        <small class="float-end text-muted ps-2">1 hr ago</small>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="flex-shrink-0 bg-primary-subtle text-primary thumb-md rounded-circle">
                                                <i class="iconoir-drone fs-4"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2 text-truncate">
                                                <h6 class="my-0 fw-normal text-dark fs-13">Your order is placed</h6>
                                                <small class="text-muted mb-0">It is a long established fact that a
                                                    reader.</small>
                                            </div>
                                            <!--end media-body-->
                                        </div>
                                        <!--end media-->
                                    </a>
                                    <!--end-item-->
                                    <!-- item-->
                                    <a href="#" class="dropdown-item py-3">
                                        <small class="float-end text-muted ps-2">2 hrs ago</small>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="flex-shrink-0 bg-primary-subtle text-primary thumb-md rounded-circle">
                                                <i class="iconoir-user fs-4"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2 text-truncate">
                                                <h6 class="my-0 fw-normal text-dark fs-13">Payment Successfull</h6>
                                                <small class="text-muted mb-0">Dummy text of the printing.</small>
                                            </div>
                                            <!--end media-body-->
                                        </div>
                                        <!--end media-->
                                    </a>
                                    <!--end-item-->
                                </div>

                                <div class="tab-pane fade" id="Teams" role="tabpanel"
                                    aria-labelledby="teams-tab" tabindex="0">
                                    <!-- item-->
                                    <a href="#" class="dropdown-item py-3">
                                        <small class="float-end text-muted ps-2">1 hr ago</small>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="flex-shrink-0 bg-primary-subtle text-primary thumb-md rounded-circle">
                                                <i class="iconoir-drone fs-4"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2 text-truncate">
                                                <h6 class="my-0 fw-normal text-dark fs-13">Your order is placed</h6>
                                                <small class="text-muted mb-0">It is a long established fact that a
                                                    reader.</small>
                                            </div><!--end media-body-->
                                        </div><!--end media-->
                                    </a><!--end-item-->
                                    <!-- item-->
                                    <a href="#" class="dropdown-item py-3">
                                        <small class="float-end text-muted ps-2">2 hrs ago</small>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="flex-shrink-0 bg-primary-subtle text-primary thumb-md rounded-circle">
                                                <i class="iconoir-user fs-4"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2 text-truncate">
                                                <h6 class="my-0 fw-normal text-dark fs-13">Payment Successfull</h6>
                                                <small class="text-muted mb-0">Dummy text of the printing.</small>
                                            </div><!--end media-body-->
                                        </div><!--end media-->
                                    </a><!--end-item-->
                                </div>
                            </div>
                        </div>
                        <!-- All-->
                        <a href="{{ route('second', ['pages', 'notification']) }}"
                            class="dropdown-item text-center text-dark fs-13 py-2">
                            View All <i class="fi-arrow-right"></i>
                        </a>
                    </div>
                </li>
                {{-- // ==========================================================
                        === NOTIFICATIONS ===
                    // ========================================================== --}}

                {{-- // ==========================================================
                        === ACCOUNT SETTINGS ===
                    // ========================================================== --}}
                <li class="dropdown topbar-item">
                    <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false" data-bs-offset="0,19">
                        {{-- <img src="{{ auth()->user()->photo ? asset(auth()->user()->photo) : asset('/images/users/avatar-2.jpg') }}"
                            alt="Photo Profile" class="thumb-md rounded-circle"> --}}

                        @if (auth()->user()->photo)
                            <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="Photo Profile"
                                class="thumb-md rounded-circle">
                        @else
                            <img src="{{ asset('/images/users/avatar-2.jpg') }}" alt="Photo Profile"
                                class="thumb-md rounded-circle">
                        @endif
                    </a>

                    <div class="dropdown-menu dropdown-menu-end py-0">
                        <div class="d-flex align-items-center dropdown-item py-2 bg-secondary-subtle">
                            <div class="flex-shrink-0">
                                {{-- <img src="{{ auth()->user()->photo ? asset(auth()->user()->photo) : asset('/images/users/avatar-2.jpg') }}"
                            alt="Photo Profile" class="thumb-md rounded-circle"> --}}

                                @if (auth()->user()->photo)
                                    <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="Photo Profile"
                                        class="thumb-md rounded-circle">
                                @else
                                    <img src="{{ asset('/images/users/avatar-2.jpg') }}" alt="Photo Profile"
                                        class="thumb-md rounded-circle">
                                @endif
                            </div>
                            <div class="flex-grow-1 ms-2 text-truncate align-self-center">
                                <h5 class="my-0 fw-medium text-dark fs-14">{{ auth()->user()->name ?? 'No Name' }}
                                </h5>
                                <small class="text-muted mb-0">{{ auth()->user()->role->name ?? 'User' }}</small>
                            </div>
                            <!--end media-body-->
                        </div>

                        <div class="dropdown-divider mt-0"></div>
                        <small class="text-muted px-2 pb-1 d-block">Account</small>
                        <form method="POST" action="{{ route('logout') }}" id="logout-form" class="d-contents">
                            @csrf
                            <a class="dropdown-item text-danger" href="#"
                                onclick="event.preventDefault();
                                    Swal.fire({
                                        title: 'Are you sure?',
                                        text: 'You will exit this session!',
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Yes, Logout!',
                                        cancelButtonText: 'No, Cancel!',
                                        customClass: {
                                            confirmButton: 'btn btn-success me-2',
                                            cancelButton: 'btn btn-danger'
                                        },
                                        buttonsStyling: false
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            document.getElementById('logout-form').submit();
                                        }
                                    });">
                                <i class="bx bx-log-out fs-18 align-middle me-1"></i><span class="align-middle"><i
                                        class="las la-power-off fs-18 me-1 align-text-bottom"></i> Logout</span>
                            </a>
                        </form>
                        {{-- ========= LOGOUT ========= --}}
                    </div>
                </li>
                {{-- // ==========================================================
                        === ACCOUNT SETTINGS ===
                    // ========================================================== --}}
            </ul>
        </nav>
    </div>
</div>
