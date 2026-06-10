@auth
    <nav class="navbar navbar-expand bg-light sticky-top px-4 py-0">
 
        <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
            <h2 class="text-primary mb-0">
                <i class="fa fa-hashtag"></i>
            </h2>
        </a>
        <a href="#" class="sidebar-toggler flex-shrink-0">
            <i class="fa fa-bars"></i>
        </a>
        <form class="d-none d-md-flex ms-4">
            <input class="form-control" type="search" placeholder="Search">
        </form>

        <div class="navbar-nav align-items-center ms-auto">
            {{-- 
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fa fa-envelope me-lg-2"></i>
                    <span class="d-none d-lg-inline-flex">Message</span>
                </a>
                <div class="dropdown-menu">
                    <a href="#" class="dropdown-item">
                        <div class="d-flex align-items-center">
                            <img class="rounded-circle" src="{{ auth()->user()->user_image() }}" alt=""
                                style="width: 40px; height: 40px;">
                            <div class="ms-2">
                                <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                <small>15 minutes ago</small>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item">
                        <div class="d-flex align-items-center">
                            <img class="rounded-circle" src="{{ auth()->user()->user_image() }}" alt=""
                                style="width: 40px; height: 40px;">
                            <div class="ms-2">
                                <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                <small>15 minutes ago</small>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item">
                        <div class="d-flex align-items-center">
                            <img class="rounded-circle" src="{{ auth()->user()->user_image() }}" alt=""
                                style="width: 40px; height: 40px;">
                            <div class="ms-2">
                                <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                <small>15 minutes ago</small>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item text-center">See all message</a>
                </div>
            </div> 
            --}}
            <!-- زرار تغيير اللغة الجديد -->
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="langswitch" checked>
                <label class="form-check-label" for="arabic">ع</label>
            </div>
            <!--             
            <div class="dropdown topbar-head-dropdown">
                <a type="button" class="link dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        @switch(Session::get('lang'))
                            @case('ar')
                                العربية
                            @break

                            @default
                                English
                        @endswitch
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                        @switch(Session::get('lang'))
                            @case('ar')
                                <a href="{{ route('admin.index', ['lang' => 'en']) }}"
                                    class="dropdown-item language py-2" data-lang="en" title="English">
                                    <span>English</span>
                                </a>
                            @break

                            @default
                                <a href="{{ route('admin.index', ['lang' => 'ar']) }}"
                                    class="dropdown-item language" data-lang="sp" title="Spanish">
                                    <span>عربي</span>
                                </a>
                        @endswitch
                </div> 
            </div> 
            -->
            
            <div class="nav-item dropdown has-submenu" id="notifications-dropdown">
                <a href="" class="nav-link dropdown-toggle notificationsIcon" data-bs-toggle="dropdown">
                    <i class="fa fa-bell me-lg-2">
                        <p class="dot dot-md text-success" id="notificationsIconCounter">
                            {{  count(Auth::user()->unreadnotifications) }}
                        </p>
                    </i>
                    <!-- <span class="d-none d-lg-inline-flex">{{ __('dashboard.notifications') }}</span> -->
                </a>
                <div class="ul" id="notificationsModel">
                    @if (count(Auth::user()->notifications) > 0)
                        @foreach (Auth::user()->notifications->take(7) as $notification)
                            <a href="{{  route('admin.order.show', $notification->data['order_id']) }}" class="dropdown-item @if ($notification->unread())  text-dark  @else text-primary @endif">
                                <h6 class="en text-default">{{ $notification->data['message'] }}</h6>
                                <p class="en">{{ $notification->data['client'] }}</p>
                                <small class="ar fw-lig text-gray">{{ $notification->created_at->diffForHumans() }}</small>
                            </a>
                        @endforeach
                    @endif

                    <a href="#" class="dropdown-item text-center">{{ __('dashboard.see_all_notifications') }}</a>
                </div>
            </div>

            <div class="nav-item dropdown has-submenu">
                <a href="#" class="nav-link dropdown-toggle usermenu" data-bs-toggle="dropdown">
                   <!-- <img class="rounded-circle me-lg-2" src="{{ auth()->user()->user_image() }}" alt=""> -->
                <i class="fa fa-regular fa-user"></i>
                    <span class="d-none d-lg-inline-flex">{{ auth()->user()->first_name }}</span>
                </a>
                <div class="ul">
                    <a href="{{  route('admin.profile.index') }}" class="dropdown-item">{{ __('dashboard.my_profile') }}</a>
                    <a href="{{  route('admin.setting.index') }}" class="dropdown-item">{{ __('dashboard.settings') }}</a>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="dropdown-item"> {{ __('Logout') }}</a>
                </div>
                <form action="{{ route('logout') }}" method="POST" id="logout-form">
                    @csrf
                </form>
            </div>
        </div>


    </nav>
@endauth
