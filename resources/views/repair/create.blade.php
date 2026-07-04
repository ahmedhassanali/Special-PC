@extends('repair.layouts.app', ['title' => 'طلب صيانة جديد — Special PC', 'subtitle' => 'صيانة الأجهزة وتركيب الكمبيوتر'])

@section('body')
<main>
    <section class="grid">
        <form class="panel span-8" method="post" action="{{ route('repair.store') }}" id="orderForm">
            @csrf
            <h1><span class="teal">طلب جديد</span></h1>
            <p>اختر نوع الطلب. إذا اخترت تركيب PC تظهر خيارات القطع تلقائياً.</p>

            <div class="request-switch" style="margin-top:16px">
                <label class="switch-card">
                    <input type="radio" name="request_type" value="maintenance" @checked(old('request_type', 'maintenance') === 'maintenance')>
                    <span><strong>🔧 صيانة جهاز</strong><small>فورمات، تنظيف، فحص، خدمات متعددة</small></span>
                </label>
                <label class="switch-card">
                    <input type="radio" name="request_type" value="pc_build" @checked(old('request_type') === 'pc_build')>
                    <span><strong>🖥 تركيب PC</strong><small>اختيار المعالج والمذربورد وكرت الشاشة والهارديسكات</small></span>
                </label>
            </div>

            <div class="grid" style="margin-top:16px">
                <div class="field span-6">
                    <label for="customer_name">اسم العميل</label>
                    <input id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required>
                    <x-repair.field-error name="customer_name" />
                </div>
                <div class="field span-6">
                    <label for="customer_phone">رقم الجوال</label>
                    <input id="customer_phone" name="customer_phone" value="{{ old('customer_phone') }}" required inputmode="tel" placeholder="05xxxxxxxx">
                    <x-repair.field-error name="customer_phone" />
                </div>
            </div>

            <div id="maintenanceFields">
                <div class="field">
                    <label for="device_name">نوع الجهاز</label>
                    <input id="device_name" name="device_name" value="{{ old('device_name') }}" placeholder="لابتوب، PC، بلايستيشن، طابعة">
                    <x-repair.field-error name="device_name" />
                </div>
                <div class="field">
                    <label>الخدمات المطلوبة</label>
                    <div class="check-grid">
                        @foreach($services as $service)
                            <label class="check-card">
                                <input type="checkbox" name="services[]" value="{{ $service->id }}" @checked(in_array($service->id, old('services', [])))>
                                <span><strong>{{ $service->name }}</strong><small>{{ number_format($service->price) }} ريال</small></span>
                            </label>
                        @endforeach
                    </div>
                    <x-repair.field-error name="services" />
                </div>
            </div>

            <div id="pcFields" class="hidden-block">
                <div class="pc-hero">
                    <h2>مواصفات تركيب PC</h2>
                    <p>اختيارات احترافية تشمل Intel و Ryzen، كروت شاشة NVIDIA و AMD، وهارديسك أول وثاني.</p>
                </div>
                <div class="grid">
                    <div class="field span-6">
                        <label for="cpu_brand">نوع المعالج</label>
                        <select id="cpu_brand" name="cpu_brand">
                            <option value="Intel" @selected(old('cpu_brand') === 'Intel')>Intel</option>
                            <option value="AMD Ryzen" @selected(old('cpu_brand') === 'AMD Ryzen')>AMD Ryzen</option>
                        </select>
                    </div>
                    <div class="field span-6 cpu-list intel-list">
                        <label for="intel_cpu">معالجات Intel</label>
                        <select id="intel_cpu" data-cpu-select>
                            @foreach($components['intel_cpu'] as $item)<option value="{{ $item }}" @selected(old('cpu') === $item)>{{ $item }}</option>@endforeach
                        </select>
                    </div>
                    <div class="field span-6 cpu-list amd-list hidden-block">
                        <label for="amd_cpu">معالجات Ryzen</label>
                        <select id="amd_cpu" data-cpu-select>
                            @foreach($components['amd_cpu'] as $item)<option value="{{ $item }}" @selected(old('cpu') === $item)>{{ $item }}</option>@endforeach
                        </select>
                    </div>
                    <input type="hidden" id="cpu" name="cpu" value="{{ old('cpu', $components['intel_cpu'][0]) }}">

                    @foreach(['motherboard' => 'المذربورد', 'gpu' => 'كرت الشاشة', 'ram' => 'الرام', 'storage_primary' => 'الهارديسك الأول', 'storage_secondary' => 'الهارديسك الثاني', 'psu' => 'مزود الطاقة', 'case' => 'الكيس'] as $key => $label)
                        <div class="field span-6">
                            <label for="{{ $key }}">{{ $label }}</label>
                            <select id="{{ $key }}" name="{{ $key }}">
                                @foreach($components[$key === 'storage_primary' || $key === 'storage_secondary' ? 'storage' : $key] as $item)
                                    <option value="{{ $item }}" @selected(old($key) === $item)>{{ $item }}</option>
                                @endforeach
                            </select>
                            <x-repair.field-error :name="$key" />
                        </div>
                    @endforeach

                    <div class="field span-6">
                        <label for="cooling_type">نوع التركيب والتبريد</label>
                        <select id="cooling_type" name="cooling_type">
                            <option value="air" @selected(old('cooling_type') === 'air')>مبرد هوائي - {{ config('maintenance.build_pricing.air') }} ريال</option>
                            <option value="water" @selected(old('cooling_type') === 'water')>مبرد مائي - {{ config('maintenance.build_pricing.water') }} ريال</option>
                        </select>
                    </div>
                    <div class="field span-6">
                        <label for="usage">استخدام الجهاز</label>
                        <select id="usage" name="usage">
                            @foreach(['ألعاب','مونتاج','تصميم 3D','ستريم','عمل مكتبي'] as $usage)
                                <option value="{{ $usage }}" @selected(old('usage') === $usage)>{{ $usage }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="field">
                <label for="problem">ملاحظات الطلب</label>
                <textarea id="problem" name="problem" placeholder="اكتب العطل أو أي ملاحظات للتركيب">{{ old('problem') }}</textarea>
                <x-repair.field-error name="problem" />
            </div>

            <button class="btn" type="submit">إنشاء الطلب</button>
        </form>

        <aside class="panel span-4">
            <h2>تتبع طلبك</h2>
            <p>بعد إنشاء الطلب ستحصل على رابط تتبع خاص و QR code لمتابعة حالة جهازك.</p>
            <div class="empty" style="margin-top:14px">🔒 لأمان أعلى، التتبع يتم برابط خاص عشوائي وليس برقم الطلب وحده.</div>
        </aside>
    </section>
</main>

<script>
const typeInputs = document.querySelectorAll('input[name="request_type"]');
const maintenanceFields = document.getElementById('maintenanceFields');
const pcFields = document.getElementById('pcFields');
const cpuBrand = document.getElementById('cpu_brand');
const cpuHidden = document.getElementById('cpu');
const intelList = document.querySelector('.intel-list');
const amdList = document.querySelector('.amd-list');
const intelCpu = document.getElementById('intel_cpu');
const amdCpu = document.getElementById('amd_cpu');

function syncType() {
  const type = document.querySelector('input[name="request_type"]:checked').value;
  maintenanceFields.classList.toggle('hidden-block', type !== 'maintenance');
  pcFields.classList.toggle('hidden-block', type !== 'pc_build');
  document.getElementById('device_name').required = type === 'maintenance';
}
function syncCpu() {
  const isIntel = cpuBrand.value === 'Intel';
  intelList.classList.toggle('hidden-block', !isIntel);
  amdList.classList.toggle('hidden-block', isIntel);
  cpuHidden.value = isIntel ? intelCpu.value : amdCpu.value;
}
typeInputs.forEach(input => input.addEventListener('change', syncType));
cpuBrand.addEventListener('change', syncCpu);
intelCpu.addEventListener('change', syncCpu);
amdCpu.addEventListener('change', syncCpu);
syncType();
syncCpu();
</script>
@endsection
