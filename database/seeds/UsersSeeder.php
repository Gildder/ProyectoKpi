<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use ProyectoKpi\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->createAdmin();
        // $this->createUsers(30);
    }

    public function createAdmin()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => \Hash::make('123456'),
            'remember_token' => \Hash::make('123456'),
            'type' => '1', //1 admin, 2 normal
            'active' => true
        ]);
    }

    public function createUsers($total)
    {
        $faker = Faker::create();
        for($i=1; $i <$total ; $i++)
        {
            User::create([
                'name' => $faker->unique()->userName(),
                'email' => $faker->unique()->email(),
                //'password' => $faker->sha256('123456'),
                'password' => \Hash::make('12345678'),
                'remember_token' => \Hash::make('123456'),
                'type' => $faker->numberBetween($min = 1, $max = 2),
                'active' => true,
            ]);

        }
    }


}
