@extends('admin.layouts.admin')
@section('content')
    <div class="page-content-wrapper m-3">
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h4 class="h4 mt-3 mx-3 mb-sm-0">خدمات الصيانة</h4>
                <a href="{{ route('admin.maintenance.index') }}" class="btn btn-outline-primary mx-3 mt-3">طلبات الصيانة</a>
            </div>
        </div>

        <div class="row g-3">
            {{-- Add new service --}}
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-3">إضافة خدمة</h6>
                        <form method="post" action="{{ route('admin.maintenance.services.store') }}">
                            @csrf
                            <div class="mb-2">
                                <label class="form-label">اسم الخدمة</label>
                                <input name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-2">
                                <label class="form-label">السعر (ريال)</label>
                                <input name="price" type="number" min="0" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" required>
                                @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <button class="btn btn-primary mt-2 w-100">إضافة</button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Services list --}}
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex text-muted small fw-bold px-2 pb-2 border-bottom">
                            <div class="flex-grow-1">الاسم</div>
                            <div style="width:110px">السعر</div>
                            <div style="width:70px">مفعّل</div>
                            <div style="width:70px"></div>
                        </div>
                        @forelse($services as $service)
                            <form method="post" action="{{ route('admin.maintenance.services.update', $service->id) }}"
                                class="d-flex align-items-center gap-2 py-2 px-2 border-bottom">
                                @csrf @method('PATCH')
                                <div class="flex-grow-1">
                                    <input name="name" class="form-control form-control-sm" value="{{ $service->name }}" required>
                                </div>
                                <div style="width:110px">
                                    <input name="price" type="number" min="0" class="form-control form-control-sm" value="{{ $service->price }}" required>
                                </div>
                                <div style="width:70px">
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" name="is_active" value="1" @checked($service->is_active)>
                                    </div>
                                </div>
                                <div style="width:70px">
                                    <button class="btn btn-sm btn-primary w-100">حفظ</button>
                                </div>
                            </form>
                        @empty
                            <div class="text-center text-muted py-4">لا توجد خدمات.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
