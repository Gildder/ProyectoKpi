<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $faker = Faker::create();
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => \Hash::make('123456'),
            'remember_token' => \Hash::make('123456'),
            'type' => '1', //1 admin, 2 normal
            'active' => true,
        ]);

        /*
       for($i=0; $i <3 ; $i++) 
       {

            DB::table('users')->insert([
                'name' => $faker->unique()->userName(),
                'email' => $faker->unique()->email(),
                //'password' => $faker->sha256('123456'),
                'password' => \Hash::make('123456'),
                'remember_token' => \Hash::make('123456'),
                'type' => $faker->numberBetween($min = 1, $max = 2),
                'active' => true,
            ]);

       }
        */
    }
}
