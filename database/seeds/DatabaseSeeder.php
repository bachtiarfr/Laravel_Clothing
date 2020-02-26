<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            [
                'name' => 'bachtiar',
                'email' => 'bachtiar@gmail.com',
                'password' => bcrypt('qwerty123'),
                'role' => 'Customers',
            ],

            [
                'name' => 'fatur',
                'email' => 'fatur@gmail.com',
                'password' => bcrypt('qwerty123'),
                'role' => 'Merchants',
            ]
        ]);
    }
}
