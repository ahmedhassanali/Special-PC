<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('image')->nullable();
            $table->string('password')->nullable();
            $table->string('gender')->nullable();
            $table->string('code')->nullable();
            $table->integer('status')->nullable();
            $table->datetime('last_seen')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->unsignedBigInteger('role')->nullable();
            $table->foreign('role')->references('id')->on('user_roles')->onDelete('cascade');
            $table->text('fcm_token')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
                'name' => 'super admin',
                'email' => 'sadmin@sc2.com',
                'phone'=>'011242315',
                'role' => 1,
                'password'=> Hash::make('123456789'),
                'status' => '1',
                'gender' => '0',
            ],
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
