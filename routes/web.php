<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// Basic Tools Routes
Route::get('/basic/upper-case', function () {
    return view('basic.upper-case');
});
Route::get('/basic/lower-case', function () {
    return view('basic.lower-case');
});
Route::get('/basic/title-case', function () {
    return view('basic.title-case');
});
Route::get('/basic/sentence-case', function () {
    return view('basic.sentence-case');
});
Route::get('/basic/capitalize-words', function () {
    return view('basic.capitalize-words');
});
Route::get('/basic/alternate-case', function () {
    return view('basic.alternate-case');
});
Route::get('/basic/invert-case', function () {
    return view('basic.invert-case');
});
Route::get('/basic/strikethrough', function () {
    return view('basic.strikethrough');
});
Route::get('/basic/underline', function () {
    return view('basic.underline');
});

// Counter Tools Routes
Route::get('/counter/character-word-counter', function () {
    return view('counter.word-counter');
});
Route::get('/counter/count-each-line', function () {
    return view('counter.count-each-line');
});
Route::get('/counter/bracket-tag-counter', function () {
    return view('counter.bracket-tag-counter');
});
