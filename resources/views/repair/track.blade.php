@extends('repair.layouts.app', ['title' => 'تتبع الطلب '.$order->order_number, 'subtitle' => 'تتبع حالة الطلب'])

@section('body')
<main>
    @php
        $statuses = ['waiting' => 'قيد الانتظار', 'working' => 'جاري العمل', 'done' => 'منتهي', 'delivered' => 'تم التسليم'];
        $keys = array_keys($statuses);
        $current = array_search($order->status, $keys, true);
        $current = $current === false ? 0 : $current;
        $qr = 'https://api.qrserver.com/v1/create-qr-code/?size=220x220&data='.urlencode($order->tracking_url);
    @endphp
    <section class="grid">
        <div class="panel span-8">
            <div class="actions" style="justify-content:space-between">
                <div>
                    <h1>{{ $order->customer_name }}</h1>
                    <p>{{ $order->device_name }} — رقم الطلب {{ $order->order_number }}</p>
                </div>
                <x-repair.status-badge :status="$order->status" />
            </div>
            <div class="timeline">
                @foreach($statuses as $key => $label)
                    <div class="step {{ array_search($key, $keys, true) <= $current ? 'active' : '' }}">
                        <strong>{{ $label }}</strong><br>
                        <small class="muted">{{ array_search($key, $keys, true) <= $current ? 'تم الوصول لهذه المرحلة' : 'لم تبدأ بعد' }}</small>
                    </div>
                @endforeach
            </div>
            <p><strong style="color:#fff">موعد التسليم:</strong> {{ $order->delivery_date ?: 'لم يحدد بعد' }}</p>
            <p><strong style="color:#fff">الملاحظات:</strong> {{ $order->problem ?: 'لا توجد ملاحظات' }}</p>

            @if($order->pc_build)
                <hr>
                <h3>مواصفات تركيب PC</h3>
                <div class="grid" style="margin-top:10px">
                    @foreach($order->pc_build as $label => $value)
                        <div class="span-6"><strong style="color:#fff">{{ $label }}</strong><p>{{ $value ?: '—' }}</p></div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="panel span-4">
            <h2>المبلغ</h2>
            @foreach($order->services as $service)
                <div class="line-item"><div><strong>{{ $service->name }}</strong><br><small class="muted">خدمة أساسية</small></div><strong>{{ number_format($service->price) }} ريال</strong><span></span></div>
            @endforeach
            @foreach($order->extras->where('status', 'approved') as $extra)
                <div class="line-item"><div><strong>{{ $extra->name }}</strong><br><small class="muted">خدمة إضافية</small></div><strong>{{ number_format($extra->price) }} ريال</strong><span></span></div>
            @endforeach
            <h1 style="margin-top:14px" class="teal">{{ number_format($order->total) }} ريال</h1>
            <hr>
            <h2>QR التتبع</h2>
            <div class="qr-box">
                <img class="qr-img" src="{{ $qr }}" alt="QR {{ $order->order_number }}">
                <a class="muted" href="{{ $order->tracking_url }}">{{ $order->tracking_url }}</a>
            </div>
        </div>

        <div class="panel span-7">
            <h2>الخدمات الإضافية</h2>
            @forelse($order->extras as $extra)
                <div class="line-item">
                    <div><strong>{{ $extra->name }}</strong><br><small class="muted">{{ $extra->note ?: 'خدمة إضافية مقترحة من الفني' }}</small></div>
                    <strong>{{ number_format($extra->price) }} ريال</strong>
                    @if($extra->status === 'pending')
                        <form class="actions" method="post" action="{{ route('repair.extras.decide', [$order->tracking_token, $extra]) }}">
                            @csrf
                            <button class="btn ok" name="decision" value="approved">موافق</button>
                            <button class="btn danger" name="decision" value="rejected">رفض</button>
                        </form>
                    @else
                        <span class="badge {{ $extra->status }}">{{ $extra->status === 'approved' ? 'تمت الموافقة' : 'مرفوض' }}</span>
                    @endif
                </div>
            @empty
                <div class="empty">لا توجد خدمات إضافية حالياً.</div>
            @endforelse
        </div>

        <div class="panel span-5">
            <h2>صور الجهاز</h2>
            @if($order->images->isEmpty())
                <div class="empty">لا توجد صور مرفوعة.</div>
            @else
                <div class="image-grid">
                    @foreach($order->images as $image)
                        <img src="{{ asset($image->path) }}" alt="{{ $image->original_name }}">
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</main>
@endsection
