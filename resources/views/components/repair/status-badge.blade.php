@props(['status'])
@php
    $labels = ['waiting' => 'قيد الانتظار', 'working' => 'جاري العمل', 'done' => 'منتهي', 'delivered' => 'تم التسليم'];
@endphp
<span class="badge {{ $status }}">{{ $labels[$status] ?? $labels['waiting'] }}</span>
