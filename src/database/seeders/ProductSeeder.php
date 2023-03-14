<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'shop_id' => 1,
                'name' => 'アスピリン錠100mg',
                'price' => 100,
                'information' => '痛み止め',
                'is_selling' => true
            ],
            [
                'shop_id' => 1,
                'name' => 'カロナール250mg',
                'price' => 200,
                'information' => '解熱鎮痛剤',
                'is_selling' => false
            ],
            [
                'shop_id' => 1,
                'name' => 'ロスバスタチン錠5mg',
                'price' => 100,
                'information' => '脂質代謝薬',
                'is_selling' => true
            ],
            [
                'shop_id' => 1,
                'name' => 'アムロジピン錠2.5mg',
                'price' => 100,
                'information' => '降圧薬',
                'is_selling' => true
            ],
            [
                'shop_id' => 2,
                'name' => 'プロフェッショナリングLaravel9',
                'price' => 1000,
                'information' => 'Laravel',
                'is_selling' => true
            ],
            [
                'shop_id' => 2,
                'name' => 'シス菅系女子1',
                'price' => 1500,
                'information' => 'Linux',
                'is_selling' => false
            ],
            [
                'shop_id' => 2,
                'name' => 'プログラミングTypeScript',
                'price' => 3000,
                'information' => 'TypeScript',
                'is_selling' => true
            ],
        ]);
    }
}
