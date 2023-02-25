<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Http\Resources\BoardResource;

class BoardController extends Controller
{
    public function index()
    {
        return BoardResource::collection(Board::all());
    }
}
