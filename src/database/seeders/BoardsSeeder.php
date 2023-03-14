<?php

namespace Database\Seeders;

use App\Models\Board;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BoardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Board::create([
            'title' => 'テスト掲示板1',
            'text' => 'テキストテキストテキストテキストテキストテキストテキストテキストテキスト',
        ]);

        Board::create([
            'title' => 'テスト掲示板2',
            'text' => 'テキストテキストテキストテキストテキストテキストテキストテキストテキスト',
        ]);

        Board::create([
            'title' => 'テスト掲示板3',
            'text' => 'テキストテキストテキストテキストテキストテキストテキストテキストテキスト',
        ]);
    }
}
