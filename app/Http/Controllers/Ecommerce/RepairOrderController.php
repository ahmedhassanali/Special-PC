<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRepairOrderRequest;
use App\Models\MaintenanceService;
use App\Services\RepairOrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RepairOrderController extends Controller
{
    public function __construct(private RepairOrderService $service)
    {
    }

    public function create(): View
    {
        return view('repair.create', [
            'services' => MaintenanceService::query()->active()->orderBy('name')->get(),
            'components' => config('maintenance.components'),
        ]);
    }

    public function store(StoreRepairOrderRequest $request): RedirectResponse
    {
        $order = $this->service->createOrder($request->validated());

        return redirect()->route('repair.track', $order->tracking_token);
    }
}
