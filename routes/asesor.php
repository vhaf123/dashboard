<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('asesor')->user();

    //dd($users);

    return view('asesor.home');
})->name('home');

