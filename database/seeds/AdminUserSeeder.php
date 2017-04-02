<?php

use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->states('admin')->create([
            'name' => 'admin',
            'password' => bcrypt('admin'),
            'email' => 'flamisz@gmail.com'
        ]);
    }
}
