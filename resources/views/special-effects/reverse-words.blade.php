@extends('layouts.tool')

@section('title', 'Reverse Words Generator - WordFix')

@section('tool-title', 'Reverse Words Generator')

@section('tool-description', 'Reverse each word in your text while keeping the word order')

@section('tool-content')
<x-text-converter 
    toolId="reverseWords"
    inputPlaceholder="Type your text here..."
    outputPlaceholder="Reversed words will appear here..."
    downloadFileName="reverse-words.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6 mt-4">
    This tool reverses each word individually while maintaining the original word order.
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
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm">olleH dlroW</div>
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Reverse Words</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Reverses each word in your text individually while keeping the word order intact.</p>
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Example</h3>
        <p><code>Hello World</code> becomes <code>olleH dlroW</code></p>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function reverseWords(text) {
        if (!text) return '';
        return text.split(' ').map(word => word.split('').reverse().join('')).join(' ');
    }
    setReverseWordsConverter(reverseWords);
</script>
@endpush
