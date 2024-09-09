<?php

use App\Livewire\Board\BoardComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('boards/{board}', BoardComponent::class)->name('boards.show');
});
