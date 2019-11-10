<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 1)->create([
            'email' => 'christensen.tr@gmail.com',
            'name' => 'Todd Christensen',
            'password' =>  bcrypt('lahontan1'),
        ]);

        factory(App\User::class, 10)->create();

        factory(App\Recipe::class, 50)->create();
        
        factory(App\Flavor::class, 50)->create();
        
    }
}
