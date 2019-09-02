<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function index() {
        $games = Game::where('user_id',Auth::id())->get();
        return view('game/index', [
            'games'=>$games
        ]);
    }
}
