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

    public function testShow()
    {
        $board = Board::factory()->create([
            'title' => 'テストタイトル',
            'text' => 'テストテキスト'
        ]);

        $response = $this->getJson(route('board.show', $board->id));

        $response->assertOk()
            ->assertJsonFragment([
                'title' => 'テストタイトル',
                'text' => 'テストテキスト'
            ]);
    }

    public function testUpdate()
    {
        $board = Board::factory()->create([
            'title' => 'テストタイトル',
            'text' => 'テストテキスト'
        ]);

        $data = [
            'title' => 'アップデート後のタイトル',
            'text' => 'アップデート後のテキスト'
        ];

        $response = $this->putJson(route('board.update', ['id' => $board->id]), $data);

        $response->assertOk()
            ->assertJson(['message' => '掲示板の更新が成功しました。']);

        $this->assertDatabaseHas('boards', [
            'id' => $board->id,
            'title' => 'アップデート後のタイトル',
            'text' => 'アップデート後のテキスト'
        ]);
    }

    public function testDestroy()
    {
        $board = Board::factory()->create([
            'title' => 'テストタイトル',
            'text' => 'テストテキスト'
        ]);

        $response = $this->deleteJson(route('board.destroy', $board->id));
        $response->assertStatus(204);

        $this->assertDatabaseMissing('boards', ['id' => $board->id]);

        $this->assertDeleted($board);
    }
}
