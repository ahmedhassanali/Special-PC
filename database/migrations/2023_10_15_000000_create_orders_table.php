<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Customer::class)->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignIdFor(\App\Models\CustomerAddress::class)->nullable()->constrained()->onUpdate('cascade')->nullOnDelete();
            $table->foreignIdFor(\App\Models\Captain::class)->nullable()->constrained()->onUpdate('cascade')->nullOnDelete();
            $table->double('shipping_fees')->default(0);
            $table->double('total');
            $table->integer('status')->nullable();
            $table->timestamp('customer_receiving_time')->nullable(); // Time customer receives
            $table->timestamp('captain_delivery_time')->nullable(); // Time captain delivers to customer
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
