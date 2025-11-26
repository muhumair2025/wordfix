<?php

namespace App\Http\Controllers;

use App\Models\ToolSuggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SuggestionSubmitted;

class SuggestionController extends Controller
{
    /**
     * Store a new tool suggestion.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tool_name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'category' => 'nullable|string|max:100',
            'use_case' => 'nullable|string|max:500',
        ]);

        $suggestion = ToolSuggestion::create([
            'user_id' => Auth::id(),
            'tool_name' => $request->tool_name,
            'description' => $request->description,
            'category' => $request->category,
            'use_case' => $request->use_case,
            'status' => 'pending',
        ]);

        // Send confirmation email
        try {
            Mail::to(Auth::user()->email)->send(new SuggestionSubmitted($suggestion));
        } catch (\Exception $e) {
            // Log error but don't fail the request
            \Log::error('Failed to send suggestion confirmation email: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Thank you! Your tool suggestion has been submitted successfully. We\'ll review it and get back to you soon.'
        ]);
    }

    /**
     * Get user's suggestions.
     */
    public function index()
    {
        $suggestions = ToolSuggestion::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($suggestions);
    }
}