<?php

namespace Database\Seeders;

use App\Models\category;
use App\Models\Invoice;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($i=0; $i<30;$i++) {
            Invoice::create([
                'quantity_type' => $faker->name,
                'quantity_value' => $faker->randomDigit(),
                'category_id' => category::inRandomOrder()->first()->id,
                'user_id' => User::inRandomOrder()->first()->id,
            ]);
        }
    }
}
