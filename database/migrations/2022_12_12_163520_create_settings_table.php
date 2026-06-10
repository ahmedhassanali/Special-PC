<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('ar_title')->nullable();
            $table->string('en_title')->nullable();

            $table->string('server_key')->nullable();
            $table->float('service_fee')->nullable();
            $table->float('tax')->nullable();

            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('x')->nullable();
            $table->string('website')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('snapchat')->nullable();
            $table->string('whatsapp')->nullable();

            $table->text('ar_terms_conditions')->nullable();
            $table->text('en_terms_conditions')->nullable();

            $table->string('google_play_link')->nullable();
            $table->string('app_store_link')->nullable();

            $table->text('en_about_us')->nullable();
            $table->text('ar_about_us')->nullable();


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
        Schema::dropIfExists('settings');
    }
};
