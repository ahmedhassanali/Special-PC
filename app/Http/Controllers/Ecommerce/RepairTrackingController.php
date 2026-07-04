<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\DecideExtraRequest;
use App\Models\OrderExtra;
use App\Models\RepairOrder;
use App\Services\RepairOrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RepairTrackingController extends Controller
{
    public function __construct(private RepairOrderService $service)
    {
    }

    public function show(string $token): View
    {
        $order = RepairOrder::query()
            ->where('tracking_token', $token)
            ->with(['services', 'extras', 'images'])
            ->firstOrFail();

        return view('repair.track', ['order' => $order]);
    }

    public function decideExtra(DecideExtraRequest $request, string $token, OrderExtra $extra): RedirectResponse
    {
        $order = RepairOrder::query()->where('tracking_token', $token)->firstOrFail();

        abort_unless($extra->repair_order_id === $order->id, 404);
        abort_unless($extra->status === 'pending', 403);

        $this->service->decideExtra($extra, $request->validated()['decision']);

        return redirect()->route('repair.track', $token);
    }
}
