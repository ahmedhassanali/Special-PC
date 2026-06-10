@auth
    <div class="sidebar pe-1 pb-3">
        <nav class="navbar bg-white navbar-light">
            <a href="{{ route('admin.index') }}" class="navbar-brand mx-4 mb-3">
                <h3 class="text-primary">{{ config('app.name', 'Ecommerce') }}</h3>
            </a>
            <div class="d-flex align-items-center ms-4 mb-4">
                <div class="position-relative">
                    <img class="rounded-circle" src="{{ auth()->user()->user_image() }}" alt=""
                        style="width: 40px; height: 40px;">
                    <div
                        class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                    </div>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0">{{ auth()->user()->first_name }}</h6>
                    <span>{{ auth()->user()->user_role->role }}</span>
                </div>
            </div>
            <div class="navbar-nav w-100">
                @foreach (auth()->user()->user_role->sidenav_list() as $nav)
                    @if (isset($nav['items']))
                        <div class="nav-item dropdown">
                            <a href="{{ route($nav['route']) }}" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="{{ $nav['icon'] }}"></i>{{ app()->getLocale() === 'ar' ? $nav['ar_title'] : $nav['title'] }}</a>
                            <div class="dropdown-menu bg-transparent border-0">
                                @foreach ($nav['items'] as $item)
                                    <a href="{{ route($item['route']) }}" class="dropdown-item">{{ app()->getLocale() === 'ar' ? $item['ar_title'] :  $item['title'] }}</a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a href="{{ route($nav['route']) }}" class="nav-item nav-link"><i
                                class="{{ $nav['icon'] }}"></i>{{ app()->getLocale() === 'ar' ? $nav['ar_title'] : $nav['title'] }}</a>
                    @endif
                @endforeach


            </div>

        </nav>
    </div>

@endauth
