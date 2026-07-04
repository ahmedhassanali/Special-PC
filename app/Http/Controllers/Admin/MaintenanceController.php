<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderExtraRequest;
use App\Http\Requests\UpdateRepairOrderRequest;
use App\Http\Requests\UploadOrderImagesRequest;
use App\Models\RepairOrder;
use App\Services\RepairOrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MaintenanceController extends Controller
{
    public function __construct(private RepairOrderService $service)
    {
    }

    public function index(Request $request)
    {
        try {
            $query = RepairOrder::query()->with(['services', 'extras'])->latest();

            if ($search = trim((string) $request->query('q'))) {
                $query->where(function ($query) use ($search) {
                    $query->where('order_number', 'like', "%{$search}%")
                        ->orWhere('customer_name', 'like', "%{$search}%")
                        ->orWhere('customer_phone', 'like', "%{$search}%")
                        ->orWhere('device_name', 'like', "%{$search}%");
                });
            }

            $orders = $query->paginate(15)->withQueryString();

            $selected = $request->query('order')
                ? RepairOrder::query()->with(['services', 'extras', 'images'])->where('order_number', $request->query('order'))->first()
                : RepairOrder::query()->with(['services', 'extras', 'images'])->latest()->first();

            return view('admin.maintenance.index', [
                'orders' => $orders,
                'selected' => $selected,
                'counts' => [
                    'all' => RepairOrder::query()->count(),
                    'waiting' => RepairOrder::query()->where('status', 'waiting')->count(),
                    'working' => RepairOrder::query()->where('status', 'working')->count(),
                    'done' => RepairOrder::query()->whereIn('status', ['done', 'delivered'])->count(),
                ],
            ]);
        } catch (\Exception $e) {
            Log::error('Maintenance action failed', ['exception' => $e]);

            return redirect()->back()->with('error', 'حدث خطأ، يرجى المحاولة مرة أخرى.');
        }
    }

    public function updateOrder(UpdateRepairOrderRequest $request, RepairOrder $order)
    {
        try {
            $this->service->updateOrder($order, $request->validated());

            return redirect()->route('admin.maintenance.index', ['order' => $order->order_number])
                ->with('success', 'تم تحديث الطلب بنجاح');
        } catch (\Exception $e) {
            Log::error('Maintenance action failed', ['exception' => $e]);

            return redirect()->back()->with('error', 'حدث خطأ، يرجى المحاولة مرة أخرى.');
        }
    }

    public function addExtra(StoreOrderExtraRequest $request, RepairOrder $order)
    {
        try {
            $this->service->addExtra($order, $request->validated());

            return redirect()->route('admin.maintenance.index', ['order' => $order->order_number])
                ->with('success', 'تمت إضافة التكلفة الإضافية');
        } catch (\Exception $e) {
            Log::error('Maintenance action failed', ['exception' => $e]);

            return redirect()->back()->with('error', 'حدث خطأ، يرجى المحاولة مرة أخرى.');
        }
    }

    public function uploadImages(UploadOrderImagesRequest $request, RepairOrder $order)
    {
        try {
            $this->service->uploadImages($order, $request->validated()['images']);

            return redirect()->route('admin.maintenance.index', ['order' => $order->order_number])
                ->with('success', 'تم رفع الصور');
        } catch (\Exception $e) {
            Log::error('Maintenance action failed', ['exception' => $e]);

            return redirect()->back()->with('error', 'حدث خطأ، يرجى المحاولة مرة أخرى.');
        }
    }

    public function deleteImage(RepairOrder $order, int $image)
    {
        try {
            $record = $order->images()->whereKey($image)->firstOrFail();
            $this->service->deleteImage($record);

            return redirect()->route('admin.maintenance.index', ['order' => $order->order_number])
                ->with('success', 'تم حذف الصورة');
        } catch (\Exception $e) {
            Log::error('Maintenance action failed', ['exception' => $e]);

            return redirect()->back()->with('error', 'حدث خطأ، يرجى المحاولة مرة أخرى.');
        }
    }
}
