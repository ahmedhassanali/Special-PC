<?php

namespace Tests\Feature;

use App\Models\MaintenanceService;
use App\Models\OrderExtra;
use App\Models\RepairOrder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RepairOrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_submit_a_maintenance_order(): void
    {
        $service = MaintenanceService::create(['name' => 'فورمات', 'price' => 100, 'is_active' => true]);

        $response = $this->post(route('repair.store'), [
            'request_type' => 'maintenance',
            'customer_name' => 'أحمد',
            'customer_phone' => '0555555555',
            'device_name' => 'PC',
            'services' => [$service->id],
            'problem' => 'لا يعمل',
        ]);

        $order = RepairOrder::first();
        $this->assertNotNull($order);
        $this->assertSame('maintenance', $order->type);
        $this->assertSame(1, $order->services()->count());
        $response->assertRedirect(route('repair.track', $order->tracking_token));
    }

    public function test_maintenance_order_requires_at_least_one_service(): void
    {
        $response = $this->post(route('repair.store'), [
            'request_type' => 'maintenance',
            'customer_name' => 'أحمد',
            'customer_phone' => '0555555555',
            'device_name' => 'PC',
            'services' => [],
        ]);

        $response->assertSessionHasErrors('services');
        $this->assertSame(0, RepairOrder::count());
    }

    public function test_customer_can_submit_a_pc_build_order(): void
    {
        $this->post(route('repair.store'), [
            'request_type' => 'pc_build',
            'customer_name' => 'سعيد',
            'customer_phone' => '0555555555',
            'cpu_brand' => 'Intel',
            'cpu' => 'Intel Core i5-14400',
            'motherboard' => 'Intel B760',
            'gpu' => 'NVIDIA RTX 4060',
            'ram' => '32GB DDR5',
            'storage_primary' => 'NVMe 1TB',
            'psu' => '650W Gold',
            'case' => 'Mid Tower Airflow',
            'cooling_type' => 'water',
            'usage' => 'ألعاب',
        ]);

        $order = RepairOrder::first();
        $this->assertNotNull($order);
        $this->assertSame('pc_build', $order->type);
        $this->assertNotNull($order->pc_build);
        $this->assertSame(1, $order->services()->count()); // build install line
        $this->assertSame(200, (int) $order->services()->first()->price); // water cooling price
    }

    public function test_tracking_page_is_reachable_by_token(): void
    {
        $order = $this->makeOrder();

        $this->get(route('repair.track', $order->tracking_token))
            ->assertOk()
            ->assertSee($order->order_number);
    }

    public function test_customer_can_approve_an_extra(): void
    {
        $order = $this->makeOrder();
        $extra = $order->extras()->create(['name' => 'قطعة', 'price' => 50, 'status' => 'pending']);

        $this->post(route('repair.extras.decide', [$order->tracking_token, $extra]), ['decision' => 'approved']);

        $this->assertSame('approved', $extra->fresh()->status);
        $this->assertSame(150, $order->fresh()->total); // 100 service + 50 approved extra
    }

    public function test_extra_decision_rejects_mismatched_token(): void
    {
        $order = $this->makeOrder();
        $extra = $order->extras()->create(['name' => 'قطعة', 'price' => 50, 'status' => 'pending']);

        $this->post(route('repair.extras.decide', ['not-the-real-token', $extra]), ['decision' => 'approved'])
            ->assertNotFound();

        $this->assertSame('pending', $extra->fresh()->status);
    }

    private function makeOrder(): RepairOrder
    {
        $order = RepairOrder::create([
            'order_number' => 'MNT-1001',
            'tracking_token' => 'test-token-1234567890',
            'type' => 'maintenance',
            'customer_name' => 'أحمد',
            'customer_phone' => '0555555555',
            'device_name' => 'PC',
            'status' => 'waiting',
        ]);
        $order->services()->create(['name' => 'فورمات', 'price' => 100]);

        return $order;
    }
}
