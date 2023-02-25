<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Board;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

    public function testStore()
    {
        $list = Board::factory()->make();
        $data = [
                'title' => $list->title,
                'text' => $list->text,
        ];

        $response = $this->postJson(route('board.store'), $data)
            ->assertOk()
            ->json();

        $this->assertEquals($data, $response);
    }
}
