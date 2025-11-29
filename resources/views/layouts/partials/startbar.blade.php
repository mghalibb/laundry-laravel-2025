<div class="startbar d-print-none">
    {{-- === START BRAND === --}}
    <div class="brand">
        <a href="{{ route('any', 'index') }}" class="logo">
            <span>
                <img src="{{ asset('/images/logo-sm.png') }}" alt="logo-small" class="logo-sm">
            </span>
            <span class="">
                <img src="{{ asset('/images/logo-light.png') }}" alt="logo-large" class="logo-lg logo-light">
                <img src="{{ asset('/images/logo-dark.png') }}" alt="logo-large" class="logo-lg logo-dark">
            </span>
        </a>
    </div>
    {{-- === START BRAND === --}}

    {{-- === STARTBAR-MENU === --}}
    <div class="startbar-menu">
        <div class="startbar-collapse" id="startbarCollapse" data-simplebar>
            <div class="d-flex align-items-start flex-column w-100">
                <ul class="navbar-nav mb-auto w-100">
                    @foreach ($menus as $category => $items)
                        @php
                            $hasAccess = false;
                            foreach ($items as $item) {
                                $allowedRoles = explode(',', $item->roles);
                                if (in_array(auth()->user()->level->nama_level, $allowedRoles)) {
                                    $hasAccess = true;
                                    break;
                                }
                            }
                        @endphp

                        @if ($hasAccess)
                            <li class="menu-label mt-2">
                                <span>{{ $category }}</span>
                            </li>

                            @foreach ($items as $menu)
                                @if (in_array(auth()->user()->level->nama_level, explode(',', $menu->roles)))
                                    {{-- <li class="nav-item">
                                        <a class="nav-link {{ Request::routeIs($menu->url . '*') ? 'active' : '' }}"
                                            href="{{ Route::has($menu->url) ? route($menu->url) : 'inc.error-404' }}">
                                            <i class="{{ $menu->icon }} menu-icon"></i>
                                            <span>{{ $menu->title }}</span>
                                        </a>
                                    </li> --}}

                                    @php
                                        $linkHref = '#';
                                        $isActive = false;
                                        // Cek apakah ini Nama Route yang terdaftar di web.php (Contoh: users.index)
                                        if (Route::has($menu->url)) {
                                            $linkHref = route($menu->url);
                                            $isActive = Request::routeIs($menu->url . '*');
                                        }
                                        // Jika bukan route, anggap sebagai URL Path manual (Contoh: auth/dark)
                                        else {
                                            $cleanUrl = str_replace('.', '/', $menu->url);
                                            $linkHref = url($cleanUrl);
                                            $isActive = Request::is($cleanUrl . '*');
                                        }
                                    @endphp
                                    <li class="nav-item">
                                        <a class="nav-link {{ $isActive ? 'active' : '' }}" href="{{ $linkHref }}">
                                            <i class="{{ $menu->icon }} menu-icon"></i>
                                            <span>{{ $menu->title }}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    {{-- === STARTBAR-MENU === --}}
</div>
<div class="startbar-overlay d-print-none"></div>
