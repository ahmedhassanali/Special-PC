@php
    $map = [
        'waiting' => ['قيد الانتظار', 'bg-warning text-dark'],
        'working' => ['جاري العمل', 'bg-info text-dark'],
        'done' => ['منتهي', 'bg-success'],
        'delivered' => ['تم التسليم', 'bg-primary'],
    ];
    $badge = $map[$status] ?? $map['waiting'];
@endphp
<span class="badge {{ $badge[1] }}">{{ $badge[0] }}</span>
