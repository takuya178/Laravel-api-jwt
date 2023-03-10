<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoardRequest;
use App\Models\Board;
use App\Http\Resources\BoardResource;

class BoardController extends Controller
{
    public function index()
    {
        return BoardResource::collection(Board::all());
    }

    public function store(BoardRequest $request)
    {
        Board::create($request->all());
        return response()->json($request->validated());
    }

    public function show($id)
    {
        $board = Board::findOrFail($id);
        return new BoardResource($board);
    }

    public function update(BoardRequest $request, $id)
    {
        $board = Board::find($id);

        if (!$board) {
            return response()->json(['message' => '指定された掲示板は見つかりませんでした。'], 404);
        }

        $board->update($request->validated());
        return response()->json(['message' => '掲示板の更新が成功しました。']);
    }


    public function destroy($id)
    {
        $board = Board::findOrFail($id);
        $board->delete();
        return response()->json(null, 204);
    }
}
