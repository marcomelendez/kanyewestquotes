<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $userAdmin = \App\Models\User::factory()->create([
            'name' => 'Marco Melendez',
            'email' => 'marcomelendezn@gmail.com',
            'role'=>'ADMIN'
        ]);

        $userAdmin->createToken(Str::random())->plainTextToken;


        $user = \App\Models\User::factory()->create([
            'email'=>'member1@example.com',
            'role'=>'MEMBER'
        ]);

        $user->createToken(Str::random())->plainTextToken;
    }
}
