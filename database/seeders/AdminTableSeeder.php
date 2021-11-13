<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   DB::table('admins')->delete();
        $admins=[
            ['name'=>'admin','email'=>'admin@admin.com','phone'=>'01881053602','type'=>'admin','status'=>1,'image'=>'default.png','remember_token'=>'barerAdminWithSuperPower','password'=>bcrypt('12345678')],
        ];
        Admin::insert($admins);
    }
}
