<?php

namespace Database\Seeders;

use App\Models\MaintenanceService;
use Illuminate\Database\Seeder;

class MaintenanceServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['name' => 'فورمات وتنصيب برامج', 'price' => 120],
            ['name' => 'تنظيف داخلي', 'price' => 80],
            ['name' => 'فحص وتشخيص', 'price' => 30],
            ['name' => 'تغيير معجون حراري', 'price' => 50],
        ];

        foreach ($services as $service) {
            MaintenanceService::query()->firstOrCreate(
                ['name' => $service['name']],
                ['price' => $service['price'], 'is_active' => true]
            );
        }
    }
}
