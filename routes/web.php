<?php

use App\Livewire\Board;
use App\Livewire\HomeComponent;
use App\Livewire\Profile;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/', HomeComponent::class)->name('home');

    Route::get('boards/{board}', Board\BoardComponent::class)->name('boards.show');
    Route::get('boards/{board}/timelogs', Board\TimelogsComponent::class)->name('boards.timelogs');

    Route::get('profile/timelogs', Profile\TimelogsComponent::class)->name('profile.timelogs');
});
