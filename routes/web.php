<?php

use App\Livewire\Board;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('boards/{board}', Board::class)->name('boards.show');
