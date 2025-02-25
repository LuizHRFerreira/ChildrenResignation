<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;

class ExampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $data = [];
        for ($i = 0; $i < 1000; $i++) {
            $startDate = $faker->dateTimeBetween('-1 years', '+1 years');
            $endDate = (clone $startDate)->modify('+'.rand(1, 30).' days');

            $data[] = [
                'name' => $faker->name,
                'descriptions' => $faker->sentence,
                'value' => $faker->randomFloat(2, 10, 1000),
                'start_date' => $startDate->format('Y-m-d H:i:s'),
                'end_date' => $endDate->format('Y-m-d H:i:s'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        \DB::table('examples')->insert($data);
    }
}
