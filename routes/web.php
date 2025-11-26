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

// Extract Tools Routes
Route::get('/extract/emails', function () {
    return view('extract.emails');
});
Route::get('/extract/hex-colors', function () {
    return view('extract.hex-colors');
});
Route::get('/extract/image-urls', function () {
    return view('extract.image-urls');
});
Route::get('/extract/ip-address', function () {
    return view('extract.ip-address');
});
Route::get('/extract/phone-numbers', function () {
    return view('extract.phone-numbers');
});
Route::get('/extract/numbers', function () {
    return view('extract.numbers');
});
Route::get('/extract/text-between', function () {
    return view('extract.text-between');
});
Route::get('/extract/urls', function () {
    return view('extract.urls');
});
Route::get('/extract/random-lines', function () {
    return view('extract.random-lines');
});
Route::get('/extract/zip-codes', function () {
    return view('extract.zip-codes');
});

// Sorting Tools Routes
Route::get('/sorting/alphabetical', function () {
    return view('sorting.alphabetical');
});
Route::get('/sorting/length', function () {
    return view('sorting.length');
});
Route::get('/sorting/random', function () {
    return view('sorting.random');
});
Route::get('/sorting/numbers', function () {
    return view('sorting.numbers');
});

// Remove Tools Routes
Route::get('/remove/duplicate-lines', function () {
    return view('remove.duplicate-lines');
});
Route::get('/remove/empty-lines', function () {
    return view('remove.empty-lines');
});
Route::get('/remove/extra-spaces', function () {
    return view('remove.extra-spaces');
});
Route::get('/remove/line-breaks', function () {
    return view('remove.line-breaks');
});
Route::get('/remove/special-characters', function () {
    return view('remove.special-characters');
});
Route::get('/remove/numbers', function () {
    return view('remove.numbers');
});
Route::get('/remove/letters', function () {
    return view('remove.letters');
});
Route::get('/remove/urls', function () {
    return view('remove.urls');
});
Route::get('/remove/html-tags', function () {
    return view('remove.html-tags');
});
Route::get('/remove/specific-words', function () {
    return view('remove.specific-words');
});
Route::get('/remove/consonants', function () {
    return view('remove.consonants');
});
Route::get('/remove/duplicate-words', function () {
    return view('remove.duplicate-words');
});
Route::get('/remove/first-characters', function () {
    return view('remove.first-characters');
});
Route::get('/remove/html-comments', function () {
    return view('remove.html-comments');
});
Route::get('/remove/last-characters', function () {
    return view('remove.last-characters');
});
Route::get('/remove/lines-with-word', function () {
    return view('remove.lines-with-word');
});
Route::get('/remove/numbers-from-text', function () {
    return view('remove.numbers-from-text');
});
Route::get('/remove/quotes', function () {
    return view('remove.quotes');
});
Route::get('/remove/single-quotes', function () {
    return view('remove.single-quotes');
});
Route::get('/remove/spaces', function () {
    return view('remove.spaces');
});
Route::get('/remove/tabs', function () {
    return view('remove.tabs');
});
Route::get('/remove/text-between', function () {
    return view('remove.text-between');
});
Route::get('/remove/vowels', function () {
    return view('remove.vowels');
});
Route::get('/remove/trim-spaces', function () {
    return view('remove.trim-spaces');
});

// Replace Tools Routes
Route::get('/replace/newline-with-commas', function () {
    return view('replace.newline-with-commas');
});
Route::get('/replace/spaces', function () {
    return view('replace.spaces');
});
Route::get('/replace/text-between', function () {
    return view('replace.text-between');
});
Route::get('/replace/search-replace', function () {
    return view('replace.search-replace');
});

// Conversion Tools Routes
Route::get('/conversions/base64-decoder', function () {
    return view('conversions.base64-decoder');
});
Route::get('/conversions/base64-encoder', function () {
    return view('conversions.base64-encoder');
});
Route::get('/conversions/date', function () {
    return view('conversions.date');
});
Route::get('/conversions/decimal-to-string', function () {
    return view('conversions.decimal-to-string');
});
Route::get('/conversions/html-entities', function () {
    return view('conversions.html-entities');
});
Route::get('/conversions/string-to-decimal', function () {
    return view('conversions.string-to-decimal');
});
Route::get('/conversions/text-to-binary', function () {
    return view('conversions.text-to-binary');
});
Route::get('/conversions/url-decode', function () {
    return view('conversions.url-decode');
});
Route::get('/conversions/url-encode', function () {
    return view('conversions.url-encode');
});

// Generator Tools Routes
Route::get('/generators/lorem-ipsum', function () {
    return view('generators.lorem-ipsum');
});
Route::get('/generators/color', function () {
    return view('generators.color');
});
Route::get('/generators/date', function () {
    return view('generators.date');
});
Route::get('/generators/email', function () {
    return view('generators.email');
});
Route::get('/generators/ip', function () {
    return view('generators.ip');
});
Route::get('/generators/ipv6', function () {
    return view('generators.ipv6');
});
Route::get('/generators/mac', function () {
    return view('generators.mac');
});
Route::get('/generators/number', function () {
    return view('generators.number');
});
Route::get('/generators/user-agent', function () {
    return view('generators.user-agent');
});
Route::get('/generators/password', function () {
    return view('generators.password');
});
Route::get('/generators/seo-url', function () {
    return view('generators.seo-url');
});
Route::get('/generators/sequential-number', function () {
    return view('generators.sequential-number');
});
Route::get('/generators/url-slug', function () {
    return view('generators.url-slug');
});

// Studio Routes
Route::get('/studio/text-flow', function () {
    return view('studio.text-flow');
})->name('studio.text-flow');

Route::get('/generators/random-phone-number', function () {
    return view('generators.phone');
})->name('generators.phone');
