<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Board;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BoardControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testIndex()
    {
        Board::factory()->create([
            'title' => 'テストタイトル',
            'text' => 'テストテキスト'
        ]);

        $response = $this->getJson(route('board.index'));

        $response->assertOk()
            ->assertJsonCount(1)
            ->assertJsonFragment([
                'title' => 'テストタイトル',
                'text' => 'テストテキスト'
            ]);
    }
}
