<?php

use App\Livewire\Board\BoardComponent;
use App\Livewire\Board\TimelogsComponent;
use App\Livewire\HomeComponent;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/', HomeComponent::class)->name('home');
    Route::get('boards/{board}', BoardComponent::class)->name('boards.show');
    Route::get('boards/{board}/timelogs', TimelogsComponent::class)->name('boards.timelogs');
});
