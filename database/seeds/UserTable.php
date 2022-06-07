<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
        $admin->name = 'bagas alwi';
        $admin->email = 'bagasalwisetyo2@gmail.com';
        $admin->password = bcrypt('bagasalwi');
        $admin->save();
    }
}
