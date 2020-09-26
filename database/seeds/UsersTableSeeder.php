<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'name' => 'Matheus Rocha',
            'email' => 'teste@teste.com',
            'email_verified_at' => now(),
            'password' => \Illuminate\Support\Facades\Hash::make('teste'), // password
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        factory(\App\User::class,4)->create();
    }
}
