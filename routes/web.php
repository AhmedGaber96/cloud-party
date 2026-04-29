<?php

use App\Http\Controllers\IfsoMemberController;
use App\Models\IfsoMember;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {




    return view('welcome');
});
Route::get('/ifso-members/create', [IfsoMemberController::class, 'create']);
Route::post('/ifso-members', [IfsoMemberController::class, 'store'])->name('ifso-members.store');