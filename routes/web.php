<?php

use App\Livewire\Board;
use App\Livewire\HomeComponent;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/', HomeComponent::class)->name('home');

    Route::get('boards/{board}', Board\BoardComponent::class)->name('boards.show');
    Route::get('boards/{board}/timelogs', Board\TimelogsComponent::class)->name('boards.timelogs');
});
