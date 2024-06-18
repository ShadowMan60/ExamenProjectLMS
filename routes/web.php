<?php

use Illuminate\Support\Facades\Route;
use App\Models\Game;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/games', function () {
    dd('test');
    $games = Game::all();
    dd($games);
    return view('games.index', compact('games'));
});
Route::post('/games', function (\Illuminate\Http\Request $request) {
    $game = $request->validate([
        'name' => 'required|string|min:5|max:20'
    ]);

    Game::create($game);
    return view('games.index');
});

Route::get('/games/create', function () {
    return view('games.create');
});

Route::get('/games/{game}', function (Game $game) {
    return view('games.show', compact('game'));
});