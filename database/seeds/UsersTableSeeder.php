<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
       for($i=0; $i <30 ; $i++) 
       {

            DB::table('users')->insert([
                'name' => $faker->unique()->userName(),
                'email' => $faker->unique()->email(),
                'password' => $faker->sha256('123456'),
                'remember_token' => \Hash::make('123456'),
                'state' => $faker->numberBetween($min = 0, $max = 1),
                'type' => $faker->numberBetween($min = 1, $max = 2),
                'active' => true,
            ]);
       }
        /*
        */
    }
}
