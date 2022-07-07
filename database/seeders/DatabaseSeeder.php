<?php

namespace Database\Seeders;

use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $faker)
    {
        DB::table('users')->insert([
            [
                'first_name' => $faker->firstName,
                'last_name'  => $faker->lastName,
                'email'      => $faker->unique()->safeEmail,
                'phone'      => $faker->unique()->phoneNumber,
                'password'   => Hash::make('test1'),
            ],
            [
                'first_name' => $faker->firstName,
                'last_name'  => $faker->lastName,
                'email'      => $faker->unique()->safeEmail,
                'phone'      => $faker->unique()->phoneNumber,
                'password'   => Hash::make('test2'),
            ],
            [
                'first_name' => $faker->firstName,
                'last_name'  => $faker->lastName,
                'email'      => $faker->unique()->safeEmail,
                'phone'      => $faker->unique()->phoneNumber,
                'password'   => Hash::make('test3'),
            ],
            [
                'first_name' => $faker->firstName,
                'last_name'  => $faker->lastName,
                'email'      => $faker->unique()->safeEmail,
                'phone'      => $faker->unique()->phoneNumber,
                'password'   => Hash::make('test4'),
            ],
            [
                'first_name' => $faker->firstName,
                'last_name'  => $faker->lastName,
                'email'      => $faker->unique()->safeEmail,
                'phone'      => $faker->unique()->phoneNumber,
                'password'   => Hash::make('test5'),
            ],
        ]);
        DB::table('companies')->insert([
            [
                'title'       => $faker->company,
                'phone'       => $faker->unique()->phoneNumber,
                'description' => $faker->realText,
            ],
            [
                'title'       => $faker->company,
                'phone'       => $faker->unique()->phoneNumber,
                'description' => $faker->realText,
            ],
            [
                'title'       => $faker->company,
                'phone'       => $faker->unique()->phoneNumber,
                'description' => $faker->realText,
            ],
            [
                'title'       => $faker->company,
                'phone'       => $faker->unique()->phoneNumber,
                'description' => $faker->realText,
            ],
            [
                'title'       => $faker->company,
                'phone'       => $faker->unique()->phoneNumber,
                'description' => $faker->realText,
            ],
        ]);
        DB::table('company_user')->insert([
            [
                'user_id' => 1,
                'company_id' => 1,
            ],
            [
                'user_id' => 1,
                'company_id' => 2,
            ],
            [
                'user_id' => 1,
                'company_id' => 3,
            ],
            [
                'user_id' => 2,
                'company_id' => 4,
            ],
            [
                'user_id' => 2,
                'company_id' => 5,
            ],
            [
                'user_id' => 3,
                'company_id' => 1,
            ],
            [
                'user_id' => 4,
                'company_id' => 2,
            ],
            [
                'user_id' => 5,
                'company_id' => 3,
            ],
        ]);
    }
}
