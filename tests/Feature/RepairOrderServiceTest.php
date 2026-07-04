<?php

namespace Tests\Feature;

use App\Models\MaintenanceService;
use App\Services\RepairOrderService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RepairOrderServiceTest extends TestCase
{
    use RefreshDatabase;

    private function service(): RepairOrderService
    {
        return app(RepairOrderService::class);
    }

    public function test_order_number_is_sequential_and_prefixed(): void
    {
        $svc = MaintenanceService::create(['name' => 'فحص', 'price' => 30, 'is_active' => true]);

        $first = $this->service()->createOrder($this->maintenancePayload($svc->id));
        $second = $this->service()->createOrder($this->maintenancePayload($svc->id));

        $this->assertStringStartsWith('MNT-', $first->order_number);
        $this->assertNotSame($first->order_number, $second->order_number);
        $this->assertNotSame($first->tracking_token, $second->tracking_token);
    }

    public function test_total_counts_services_plus_approved_extras_only(): void
    {
        $svc = MaintenanceService::create(['name' => 'فحص', 'price' => 30, 'is_active' => true]);
        $order = $this->service()->createOrder($this->maintenancePayload($svc->id));

        $order->extras()->create(['name' => 'موافق', 'price' => 70, 'status' => 'approved']);
        $order->extras()->create(['name' => 'معلق', 'price' => 500, 'status' => 'pending']);
        $order->extras()->create(['name' => 'مرفوض', 'price' => 999, 'status' => 'rejected']);

        $this->assertSame(100, $order->fresh()->total); // 30 service + 70 approved
    }

    public function test_snapshot_price_survives_catalog_change(): void
    {
        $svc = MaintenanceService::create(['name' => 'فحص', 'price' => 30, 'is_active' => true]);
        $order = $this->service()->createOrder($this->maintenancePayload($svc->id));

        $svc->update(['price' => 9999]);

        $this->assertSame(30, (int) $order->fresh()->services->first()->price);
    }

    private function maintenancePayload(int $serviceId): array
    {
        return [
            'request_type' => 'maintenance',
            'customer_name' => 'أحمد',
            'customer_phone' => '0555555555',
            'device_name' => 'PC',
            'services' => [$serviceId],
        ];
    }
}
