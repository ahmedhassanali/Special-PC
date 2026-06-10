<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Hash;

class SoftConfig extends Command {
    /**
    * The name and signature of the console command.
    *
    * @var string
    */
    protected $signature = 'app:soft-config';

    /**
    * The console command description.
    *
    * @var string
    */
    protected $description = 'Command description';

    /**
    * Execute the console command.
    */

    public function handle() {
        $role =  \App\Models\UserRole::create( [ 'role' => '', 'permission' =>  '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40' ] );
        \App\Models\User::create( [ 'first_name' => 'Admin', 'last_name' => 'Panel', 'role' => $role->id, 'email' => 'admin@admin.com', 'password' => Hash::make( '123456789' ) ] );
    }
}
