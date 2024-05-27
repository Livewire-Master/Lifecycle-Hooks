<?php

use App\Livewire\LifeCycle;
use Illuminate\Support\Facades\Route;

Route::get('/', LifeCycle::class)->name('page.lifecycle');
Route::get('/mount/{uuid}', LifeCycle::class)->name('page.lifecycle');
