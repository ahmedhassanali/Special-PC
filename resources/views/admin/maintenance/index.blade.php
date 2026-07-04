@extends('admin.layouts.admin')
@section('content')
    <div class="page-content-wrapper m-3">
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h4 class="h4 mt-3 mx-3 mb-sm-0">طلبات الصيانة</h4>
                <a href="{{ route('admin.maintenance.services.index') }}" class="btn btn-outline-primary mx-3 mt-3">
                    خدمات الصيانة
                </a>
            </div>
        </div>

        {{-- Status summary --}}
        <div class="row g-3 mb-3">
            @php
                $cards = [
                    ['label' => 'كل الطلبات', 'value' => $counts['all'], 'color' => 'primary'],
                    ['label' => 'قيد الانتظار', 'value' => $counts['waiting'], 'color' => 'warning'],
                    ['label' => 'جاري العمل', 'value' => $counts['working'], 'color' => 'info'],
                    ['label' => 'منتهية / مسلمة', 'value' => $counts['done'], 'color' => 'success'],
                ];
            @endphp
            @foreach($cards as $card)
                <div class="col-6 col-md-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <span class="text-muted small">{{ $card['label'] }}</span>
                            <h3 class="mb-0 text-{{ $card['color'] }}">{{ $card['value'] }}</h3>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row g-3">
            {{-- Orders list --}}
            <div class="col-lg-6">
                <div class="card">
                    <div class="p-3">
                        <form method="get" action="{{ route('admin.maintenance.index') }}" class="position-relative">
                            <input class="form-control bg-body" type="search" name="q" value="{{ request('q') }}"
                                placeholder="بحث برقم الطلب / الاسم / الجوال / الجهاز">
                        </form>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive border-0">
                            <table class="table align-middle table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="border-0">رقم الطلب</th>
                                        <th class="border-0">العميل</th>
                                        <th class="border-0">النوع</th>
                                        <th class="border-0">الحالة</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders as $order)
                                        <tr class="{{ $selected && $selected->id === $order->id ? 'table-active' : '' }}"
                                            style="cursor:pointer"
                                            onclick="location.href='{{ route('admin.maintenance.index', array_filter(['q' => request('q'), 'order' => $order->order_number])) }}'">
                                            <td class="fw-bold">{{ $order->order_number }}</td>
                                            <td>{{ $order->customer_name }}<br><small class="text-muted">{{ $order->customer_phone }}</small></td>
                                            <td>{{ $order->type === 'pc_build' ? 'تركيب PC' : 'صيانة' }}</td>
                                            <td>@include('admin.maintenance.partials.status', ['status' => $order->status])</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="4" class="text-center text-muted py-4">لا توجد طلبات.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">{{ $orders->links() }}</div>
                    </div>
                </div>
            </div>

            {{-- Selected order detail --}}
            <div class="col-lg-6">
                @if($selected)
                    @php
                        $statusLabels = ['waiting' => 'قيد الانتظار', 'working' => 'جاري العمل', 'done' => 'منتهي', 'delivered' => 'تم التسليم'];
                        $waTracking = "مرحباً {$selected->customer_name}\nرابط تتبع طلبك {$selected->order_number}:\n{$selected->tracking_url}";
                        $waStatus = "مرحباً {$selected->customer_name}\nتم تحديث حالة طلبك {$selected->order_number} إلى: ".($statusLabels[$selected->status] ?? $selected->status)."\nرابط التتبع: {$selected->tracking_url}";
                    @endphp
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h5 class="mb-1">{{ $selected->customer_name }}</h5>
                                    <div class="text-muted">{{ $selected->device_name }} — {{ $selected->order_number }}</div>
                                    <div class="text-muted">{{ $selected->customer_phone }}</div>
                                </div>
                                @include('admin.maintenance.partials.status', ['status' => $selected->status])
                            </div>

                            <div class="d-flex flex-wrap gap-2 mt-3">
                                <a href="{{ route('repair.track', $selected->tracking_token) }}" target="_blank"
                                    class="btn btn-sm btn-outline-info">
                                    <i class="fa fa-external-link-alt me-1"></i> فتح صفحة تتبع العميل
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-secondary"
                                    onclick="navigator.clipboard.writeText('{{ route('repair.track', $selected->tracking_token) }}'); this.textContent='تم نسخ الرابط ✓';">
                                    <i class="fa fa-copy me-1"></i> نسخ رابط التتبع
                                </button>
                                <a href="{{ $selected->whatsappUrl($waTracking) }}" target="_blank" rel="noopener"
                                    class="btn btn-sm text-white" style="background:#128c7e">
                                    <i class="fab fa-whatsapp me-1"></i> واتساب رابط التتبع
                                </a>
                                <a href="{{ $selected->whatsappUrl($waStatus) }}" target="_blank" rel="noopener"
                                    class="btn btn-sm text-white" style="background:#128c7e">
                                    <i class="fab fa-whatsapp me-1"></i> واتساب الحالة
                                </a>
                            </div>

                            @if($selected->problem)
                                <hr><strong>الملاحظات:</strong> <span class="text-muted">{{ $selected->problem }}</span>
                            @endif

                            @if($selected->pc_build)
                                <hr><strong>مواصفات التركيب:</strong>
                                <ul class="small text-muted mb-0 mt-2">
                                    @foreach($selected->pc_build as $label => $value)
                                        <li>{{ $label }}: {{ $value ?: '—' }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            <hr>
                            <strong>الخدمات:</strong>
                            <ul class="small mb-2 mt-2">
                                @foreach($selected->services as $service)
                                    <li>{{ $service->name }} — {{ number_format($service->price) }} ريال</li>
                                @endforeach
                            </ul>
                            <h5 class="text-success">الإجمالي: {{ number_format($selected->total) }} ريال</h5>
                        </div>
                    </div>

                    {{-- Update status --}}
                    <div class="card mb-3">
                        <div class="card-body">
                            <h6 class="mb-3">تحديث الحالة</h6>
                            <form method="post" action="{{ route('admin.maintenance.orders.update', $selected->id) }}">
                                @csrf @method('PATCH')
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <select name="status" class="form-select">
                                            @foreach(['waiting' => 'قيد الانتظار', 'working' => 'جاري العمل', 'done' => 'منتهي', 'delivered' => 'تم التسليم'] as $key => $label)
                                                <option value="{{ $key }}" @selected($selected->status === $key)>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="delivery_date" class="form-control" value="{{ $selected->delivery_date }}" placeholder="موعد التسليم">
                                    </div>
                                </div>
                                <button class="btn btn-primary mt-3">حفظ</button>
                            </form>
                        </div>
                    </div>

                    {{-- Add extra --}}
                    <div class="card mb-3">
                        <div class="card-body">
                            <h6 class="mb-3">إضافة تكلفة إضافية</h6>
                            @foreach($selected->extras as $extra)
                                <div class="d-flex justify-content-between align-items-center border rounded p-2 mb-2 gap-2">
                                    <span>{{ $extra->name }} — {{ number_format($extra->price) }} ريال</span>
                                    <div class="d-flex align-items-center gap-2">
                                        @include('admin.maintenance.partials.extra-status', ['status' => $extra->status])
                                        @if($extra->status === 'pending')
                                            @php
                                                $waExtra = "مرحباً {$selected->customer_name}\nيوجد طلب موافقة على خدمة إضافية:\n{$extra->name} - ".number_format($extra->price)." ريال\nفضلاً افتح رابط التتبع للموافقة أو الرفض:\n{$selected->tracking_url}";
                                            @endphp
                                            <a href="{{ $selected->whatsappUrl($waExtra) }}" target="_blank" rel="noopener"
                                                class="btn btn-sm text-white" style="background:#128c7e" title="إرسال طلب الموافقة عبر واتساب">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            <form method="post" action="{{ route('admin.maintenance.orders.extras.store', $selected->id) }}">
                                @csrf
                                <div class="row g-2">
                                    <div class="col-md-6"><input name="name" class="form-control" placeholder="اسم التكلفة" required></div>
                                    <div class="col-md-6"><input name="price" type="number" min="0" class="form-control" placeholder="السعر" required></div>
                                    <div class="col-12"><input name="note" class="form-control" placeholder="ملاحظة (اختياري)"></div>
                                </div>
                                <button class="btn btn-outline-primary mt-3">إضافة</button>
                            </form>
                        </div>
                    </div>

                    {{-- Images --}}
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-3">صور الجهاز</h6>
                            <div class="row g-2 mb-3">
                                @foreach($selected->images as $image)
                                    <div class="col-4 col-md-3 position-relative">
                                        <img src="{{ asset($image->path) }}" class="img-fluid rounded" style="aspect-ratio:1;object-fit:cover">
                                        <form method="post" action="{{ route('admin.maintenance.orders.images.delete', [$selected->id, $image->id]) }}"
                                            class="position-absolute top-0 end-0">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger py-0 px-1">×</button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                            <form method="post" action="{{ route('admin.maintenance.orders.images.store', $selected->id) }}" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="images[]" class="form-control" accept="image/*" multiple required>
                                <button class="btn btn-outline-primary mt-3">رفع الصور</button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="card"><div class="card-body text-center text-muted py-5">اختر طلباً لعرض التفاصيل.</div></div>
                @endif
            </div>
        </div>
    </div>
@endsection
