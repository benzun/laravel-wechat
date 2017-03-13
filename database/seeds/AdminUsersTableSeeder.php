<?php

use Illuminate\Database\Seeder;
use App\Model\AdminUser;

class AdminUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminUser::create([
            'user_name' => 'benzun',
            'email'     => '395133701@qq.com',
            'password'  => bcrypt('benzun')
        ]);
    }
}
