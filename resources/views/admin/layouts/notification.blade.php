@foreach ($notifications as $notification)
    @php
        $data = $notification->data;
        $data['message'] = $notification->data['message'];
        $data['status'] = $notification->data['status'];
        $data['url'] = isset($notification->data['url']) ? $notification->data['url'] : '';
    @endphp
    <!-- Notif item -->
    <li>
        <a href="{{ route('notification.notification', $notification->id) }}"
            class="list-group-item-action border-0 border-bottom d-flex p-3">
            <div class="me-3">
                <div class="avatar avatar-md">
                    <i class="bi bi-bell fa-fw"></i>
                </div>
            </div>
            <div>
                <p class="text-body small m-0 ar">
                    {{ $data['message'] }}
                </p>

            </div>
        </a>
    </li>
    <!-- /Notif item -->
@endforeach
