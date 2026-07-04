<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMaintenanceServiceRequest;
use App\Http\Requests\UpdateMaintenanceServiceRequest;
use App\Models\MaintenanceService;
use Illuminate\Support\Facades\Log;

class MaintenanceServiceController extends Controller
{
    public function index()
    {
        try {
            $services = MaintenanceService::query()->latest()->get();

            return view('admin.maintenance.services', compact('services'));
        } catch (\Exception $e) {
            Log::error('Maintenance service action failed', ['exception' => $e]);

            return redirect()->back()->with('error', 'حدث خطأ، يرجى المحاولة مرة أخرى.');
        }
    }

    public function store(StoreMaintenanceServiceRequest $request)
    {
        try {
            MaintenanceService::query()->create($request->validated() + ['is_active' => true]);

            return redirect()->route('admin.maintenance.services.index')->with('success', 'تمت إضافة الخدمة');
        } catch (\Exception $e) {
            Log::error('Maintenance service action failed', ['exception' => $e]);

            return redirect()->back()->with('error', 'حدث خطأ، يرجى المحاولة مرة أخرى.');
        }
    }

    public function update(UpdateMaintenanceServiceRequest $request, MaintenanceService $service)
    {
        try {
            $service->update(array_merge($request->validated(), ['is_active' => $request->boolean('is_active')]));

            return redirect()->route('admin.maintenance.services.index')->with('success', 'تم تحديث الخدمة');
        } catch (\Exception $e) {
            Log::error('Maintenance service action failed', ['exception' => $e]);

            return redirect()->back()->with('error', 'حدث خطأ، يرجى المحاولة مرة أخرى.');
        }
    }
}
