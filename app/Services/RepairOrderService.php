<?php

namespace App\Services;

use App\Models\MaintenanceService;
use App\Models\OrderExtra;
use App\Models\OrderImage;
use App\Models\RepairOrder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RepairOrderService
{
    /**
     * Create a repair order (maintenance or PC build) with its snapshot service lines.
     */
    public function createOrder(array $data): RepairOrder
    {
        return DB::transaction(function () use ($data) {
            $isBuild = $data['request_type'] === 'pc_build';

            $order = RepairOrder::query()->create([
                'order_number' => 'MNT-'.Str::uuid(),
                'tracking_token' => $this->uniqueToken(),
                'type' => $data['request_type'],
                'customer_name' => $data['customer_name'],
                'customer_phone' => $data['customer_phone'],
                'device_name' => $isBuild ? 'تركيب PC مخصص' : ($data['device_name'] ?? null),
                'problem' => $data['problem'] ?? null,
                'pc_build' => $isBuild ? $this->buildSpec($data) : null,
            ]);

            // Derive the human-facing number from the row's own auto-increment id
            // so it is unique and race-free (no read of max(id) before insert).
            $order->update(['order_number' => 'MNT-'.($order->id + 1000)]);

            if ($isBuild) {
                $isWater = ($data['cooling_type'] ?? null) === 'water';
                $order->services()->create([
                    'name' => $isWater ? 'تركيب PC مع مبرد مائي' : 'تركيب PC مع مبرد هوائي',
                    'price' => config('maintenance.build_pricing.'.($isWater ? 'water' : 'air')),
                ]);
            }

            $this->attachServices($order, $data['services'] ?? []);

            return $order;
        });
    }

    /**
     * Attach catalog services to an order, snapshotting name + price at time of order.
     */
    protected function attachServices(RepairOrder $order, array $serviceIds): void
    {
        if (empty($serviceIds)) {
            return;
        }

        MaintenanceService::query()
            ->whereIn('id', $serviceIds)
            ->active()
            ->get()
            ->each(fn (MaintenanceService $service) => $order->services()->create([
                'maintenance_service_id' => $service->id,
                'name' => $service->name,
                'price' => $service->price,
            ]));
    }

    /**
     * Customer approves or rejects a pending extra charge.
     */
    public function decideExtra(OrderExtra $extra, string $decision): OrderExtra
    {
        $extra->update([
            'status' => $decision,
            'decided_at' => now(),
        ]);

        return $extra;
    }

    /**
     * Admin: update order status / delivery date.
     */
    public function updateOrder(RepairOrder $order, array $data): RepairOrder
    {
        $order->update([
            'status' => $data['status'],
            'delivery_date' => $data['delivery_date'] ?? null,
        ]);

        return $order;
    }

    /**
     * Admin: add a pending extra charge to an order.
     */
    public function addExtra(RepairOrder $order, array $data): OrderExtra
    {
        return $order->extras()->create([
            'name' => $data['name'],
            'price' => $data['price'],
            'note' => $data['note'] ?? null,
            'status' => 'pending',
        ]);
    }

    /**
     * Admin: store uploaded device images for an order.
     *
     * @param  \Illuminate\Http\UploadedFile[]  $images
     */
    public function uploadImages(RepairOrder $order, array $images): void
    {
        foreach ($images as $image) {
            $service = new ImageService($image, 'storage/repair-orders/'.$order->order_number.'/');
            $path = $service->upload();

            $order->images()->create([
                'path' => $path,
                'original_name' => $image->getClientOriginalName(),
            ]);
        }
    }

    /**
     * Admin: delete a single order image (file + record).
     */
    public function deleteImage(OrderImage $image): void
    {
        ImageService::delete($image->path);
        $image->delete();
    }

    protected function buildSpec(array $data): array
    {
        $isWater = ($data['cooling_type'] ?? null) === 'water';

        return [
            'نوع المعالج' => $data['cpu_brand'] ?? null,
            'المعالج' => $data['cpu'] ?? null,
            'المذربورد' => $data['motherboard'] ?? null,
            'كرت الشاشة' => $data['gpu'] ?? null,
            'الرام' => $data['ram'] ?? null,
            'الهارديسك الأول' => $data['storage_primary'] ?? null,
            'الهارديسك الثاني' => $data['storage_secondary'] ?? null,
            'مزود الطاقة' => $data['psu'] ?? null,
            'الكيس' => $data['case'] ?? null,
            'نوع التبريد' => $isWater
                ? 'مبرد مائي - '.config('maintenance.build_pricing.water').' ريال'
                : 'مبرد هوائي - '.config('maintenance.build_pricing.air').' ريال',
            'استخدام الجهاز' => $data['usage'] ?? null,
        ];
    }

    protected function uniqueToken(): string
    {
        do {
            $token = Str::random(40);
        } while (RepairOrder::query()->where('tracking_token', $token)->exists());

        return $token;
    }
}
