<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('ar_name');
            $table->string('en_name');
            $table->string('image')->nullable();
            $table->foreignIdFor(\App\Models\Category::class)->nullable()->constrained()->onUpdate('cascade')->nullOnDelete();
            $table->foreignIdFor(\App\Models\SubCategory::class)->nullable()->constrained()->onUpdate('cascade')->nullOnDelete();
            $table->foreignIdFor(\App\Models\Brand::class)->nullable()->constrained()->onUpdate('cascade')->nullOnDelete();
            $table->foreignIdFor(\App\Models\Unit::class)->nullable()->constrained()->onUpdate('cascade')->nullOnDelete();
            $table->foreignIdFor(\App\Models\Offer::class)->nullable()->constrained()->onUpdate('cascade')->nullOnDelete();
            $table->string('ar_description')->nullable();
            $table->string('en_description')->nullable();
            $table->integer('stock')->default(0);
            $table->double('cost')->nullable();
            $table->double('price')->nullable();
            $table->double('rate')->default(0.0);
            $table->double('tax')->default(0);
            $table->integer('status')->default(0);
            $table->integer('special_offer')->default(0);
            $table->integer('free_shipping')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
