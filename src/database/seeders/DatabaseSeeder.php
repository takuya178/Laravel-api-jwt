<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Board;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       Board::factory(100)->create();
        $this->call([
            OwnerSeeder::class,
            ShopSeeder::class,
            ProductSeeder::class,
       ]);
    }
}
