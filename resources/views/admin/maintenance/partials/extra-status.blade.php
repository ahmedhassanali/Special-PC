@php
    $map = [
        'pending' => ['بانتظار العميل', 'bg-secondary'],
        'approved' => ['تمت الموافقة', 'bg-success'],
        'rejected' => ['مرفوض', 'bg-danger'],
    ];
    $badge = $map[$status] ?? $map['pending'];
@endphp
<span class="badge {{ $badge[1] }}">{{ $badge[0] }}</span>
