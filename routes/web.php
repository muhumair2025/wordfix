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

// Formatter Tools Routes
Route::get('/formatter/css-beautifier', function () {
    return view('formatter.css-beautifier');
});
Route::get('/formatter/html-beautifier', function () {
    return view('formatter.html-beautifier');
});
Route::get('/formatter/javascript-beautifier', function () {
    return view('formatter.javascript-beautifier');
});
Route::get('/formatter/json-beautifier', function () {
    return view('formatter.json-beautifier');
});
Route::get('/formatter/sql-beautifier', function () {
    return view('formatter.sql-beautifier');
});

// Modify Tools Routes
Route::get('/modify/add-number-to-each-line', function () {
    return view('modify.add-number-to-each-line');
});
Route::get('/modify/add-string-after-characters', function () {
    return view('modify.add-string-after-characters');
});
Route::get('/modify/add-text-to-each-line', function () {
    return view('modify.add-text-to-each-line');
});
Route::get('/modify/column-to-comma', function () {
    return view('modify.column-to-comma');
});
Route::get('/modify/comma-to-column', function () {
    return view('modify.column-to-comma'); // Uses same file - has both features
});
Route::get('/modify/commas-between-numbers', function () {
    return view('modify.commas-between-numbers');
});
Route::get('/modify/double-space-to-single', function () {
    return view('modify.double-space-to-single');
});
Route::get('/modify/single-space-to-double', function () {
    return view('modify.double-space-to-single'); // Uses same file - has both features
});
Route::get('/modify/keep-first-characters', function () {
    return view('modify.keep-first-characters');
});
Route::get('/modify/keep-last-characters', function () {
    return view('modify.keep-last-characters');
});
Route::get('/modify/keep-lines-with-word', function () {
    return view('modify.keep-lines-with-word');
});
Route::get('/modify/keep-lines-with-words', function () {
    return view('modify.keep-lines-with-words');
});
Route::get('/modify/merge-text-lists', function () {
    return view('modify.merge-text-lists');
});
Route::get('/modify/number-to-words', function () {
    return view('modify.number-to-words');
});
Route::get('/modify/prefix-suffix', function () {
    return view('modify.prefix-suffix');
});
Route::get('/modify/position-text-addition', function () {
    return view('modify.position-text-addition');
});
Route::get('/modify/trim-text', function () {
    return view('modify.trim-text');
});

// Special Effects Tools Routes
Route::get('/special-effects/backward', function () {
    return view('special-effects.backward');
});
Route::get('/special-effects/binary-to-text', function () {
    return view('special-effects.binary-to-text');
});
Route::get('/special-effects/bold', function () {
    return view('special-effects.bold-text');
});
Route::get('/special-effects/bold-gothic', function () {
    return view('special-effects.bold-text');
});
Route::get('/special-effects/bold-italic', function () {
    return view('special-effects.bold-text');
});
Route::get('/special-effects/circled', function () {
    return view('special-effects.circled-text');
});
Route::get('/special-effects/cursive-bold', function () {
    return view('special-effects.cursive-bold');
});
Route::get('/special-effects/flip-text', function () {
    return view('special-effects.flip-text');
});
Route::get('/special-effects/flip-words', function () {
    return view('special-effects.flip-text');
});
Route::get('/special-effects/gothic', function () {
    return view('special-effects.gothic');
});
Route::get('/special-effects/italic', function () {
    return view('special-effects.italic');
});
Route::get('/special-effects/outline', function () {
    return view('special-effects.outline');
});
Route::get('/special-effects/parentheses', function () {
    return view('special-effects.parentheses');
});
Route::get('/special-effects/pascal-case', function () {
    return view('special-effects.pascal-case');
});
Route::get('/special-effects/reverse-words', function () {
    return view('special-effects.reverse-words');
});
Route::get('/special-effects/slashed', function () {
    return view('special-effects.slashed');
});
Route::get('/special-effects/snake-case', function () {
    return view('special-effects.snake-case');
});
Route::get('/special-effects/upside-down', function () {
    return view('special-effects.upside-down');
});
Route::get('/special-effects/wide-text', function () {
    return view('special-effects.wide-text');
});
