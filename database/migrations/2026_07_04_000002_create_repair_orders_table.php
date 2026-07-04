<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('repair_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->string('tracking_token', 64)->unique();
            $table->enum('type', ['maintenance', 'pc_build'])->default('maintenance');
            $table->string('customer_name');
            $table->string('customer_phone', 30);
            $table->string('device_name')->nullable();
            $table->text('problem')->nullable();
            $table->json('pc_build')->nullable();
            $table->enum('status', ['waiting', 'working', 'done', 'delivered'])->default('waiting');
            $table->string('delivery_date')->nullable();
            $table->timestamps();

            $table->index(['status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('repair_orders');
    }
};
