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
            ['id'=>1,'name'=>'admin','email'=>'admin@admin.com','phone'=>'01881053602','type'=>'admin','status'=>1,'image'=>'default.png','remember_token'=>'barerAdminWithSuperPower','password'=>bcrypt('12345678')],
            ['id'=>2,'name'=>'General','email'=>'general@general.com','phone'=>'01881053602','type'=>'general','status'=>1,'image'=>'default.png','remember_token'=>'barerAdminWithSuperPower','password'=>bcrypt('12345678')],
        ];
        Admin::insert($admins);
    }
}
