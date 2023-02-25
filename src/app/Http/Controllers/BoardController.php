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
}
