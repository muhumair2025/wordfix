@extends('layouts.tool')

@section('title', 'Upside Down Text Generator - WordFix')

@section('tool-title', 'Upside Down Text Generator')

@section('tool-description', 'Flip your text upside down using Unicode characters')

@section('tool-content')
<x-text-converter 
    toolId="upsideDown"
    inputPlaceholder="Type your text here..."
    outputPlaceholder="Upside down text will appear here..."
    downloadFileName="upside-down.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6 mt-4">
    Flips text upside down and reverses it for reading from bottom to top.
</div>

<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">Example</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Before</p>
            <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm">Hello World</div>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">After</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-lg">plɹoM ollǝH</div>
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Upside Down Text</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Creates upside-down text using Unicode characters. The text is also reversed for proper reading.</p>
    </div>
</article>
@endsection

@push('scripts')
<script>
    const flipMap = {
        'a': 'ɐ', 'b': 'q', 'c': 'ɔ', 'd': 'p', 'e': 'ǝ', 'f': 'ɟ', 'g': 'ƃ', 'h': 'ɥ',
        'i': 'ı', 'j': 'ɾ', 'k': 'ʞ', 'l': 'l', 'm': 'ɯ', 'n': 'u', 'o': 'o', 'p': 'd',
        'q': 'b', 'r': 'ɹ', 's': 's', 't': 'ʇ', 'u': 'n', 'v': 'ʌ', 'w': 'ʍ', 'x': 'x',
        'y': 'ʎ', 'z': 'z',
        'A': '∀', 'B': 'q', 'C': 'Ɔ', 'D': 'D', 'E': 'Ǝ', 'F': 'Ⅎ', 'G': '⅁', 'H': 'H',
        'I': 'I', 'J': 'ſ', 'K': '⋊', 'L': '˥', 'M': 'W', 'N': 'N', 'O': 'O', 'P': 'Ԁ',
        'Q': 'Ό', 'R': 'ɹ', 'S': 'S', 'T': '⊥', 'U': '∩', 'V': 'Λ', 'W': 'M', 'X': 'X',
        'Y': '⅄', 'Z': 'Z',
        '0': '0', '1': 'Ɩ', '2': 'ᄅ', '3': 'Ɛ', '4': 'ㄣ', '5': 'ϛ', '6': '9', '7': 'ㄥ',
        '8': '8', '9': '6',
        '!': '¡', '?': '¿', '.': '˙'
    };
    
    function flipUpsideDown(text) {
        if (!text) return '';
        return text.split('').reverse().map(c => flipMap[c] || c).join('');
    }
    setUpsideDownConverter(flipUpsideDown);
</script>
@endpush
