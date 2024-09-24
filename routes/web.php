<?php

use App\Livewire\Board\BoardComponent;
use App\Livewire\HomeComponent;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/', HomeComponent::class)->name('home');

    Route::get('boards/{board}', BoardComponent::class)->name('boards.show');
});
