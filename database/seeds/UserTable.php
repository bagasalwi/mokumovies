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
        $admin->name = 'Aldmic';
        $admin->email = 'bagasalwisetyo2@gmail.com';
        $admin->password = bcrypt('123abc123');
        $admin->save();
    }
}
