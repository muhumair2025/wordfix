<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\ToolSuggestion;
use App\Models\UserFeedback;
use App\Mail\SuggestionStatusUpdated;
use App\Mail\FeedbackStatusUpdated;

class AdminController extends Controller
{

    public function dashboard()
    {
        $totalUsers = User::count();
        $newUsersToday = User::whereDate('created_at', today())->count();
        $newUsersThisWeek = User::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        
        $totalSuggestions = ToolSuggestion::count();
        $pendingSuggestions = ToolSuggestion::where('status', 'pending')->count();
        
        $totalFeedback = UserFeedback::count();
        $newFeedback = UserFeedback::where('status', 'new')->count();
        
        return view('admin.dashboard', compact(
            'totalUsers', 
            'newUsersToday', 
            'newUsersThisWeek',
            'totalSuggestions',
            'pendingSuggestions',
            'totalFeedback',
            'newFeedback'
        ));
    }

    public function users()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users', compact('users'));
    }

    public function feedback(Request $request)
    {
        $query = UserFeedback::with('user')->latest();
        
        // Filter by status if provided
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }
        
        $feedback = $query->paginate(20);
        return view('admin.feedback', compact('feedback'));
    }

    public function showFeedback(UserFeedback $feedback)
    {
        $feedback->load('user');
        return response()->json($feedback);
    }

    public function updateFeedbackStatus(Request $request, UserFeedback $feedback)
    {
        $request->validate([
            'status' => 'required|in:new,in_progress,resolved,closed',
            'admin_response' => 'nullable|string|max:1000',
        ]);

        $oldStatus = $feedback->status;
        $feedback->update([
            'status' => $request->status,
            'admin_response' => $request->admin_response,
        ]);

        // Send email notification if status changed
        if ($oldStatus !== $request->status) {
            try {
                Mail::to($feedback->user->email)->send(new FeedbackStatusUpdated($feedback));
            } catch (\Exception $e) {
                // Log error but don't fail the request
                \Log::error('Failed to send feedback status email: ' . $e->getMessage());
            }
        }

        return redirect()->route('admin.feedback')
            ->with('success', 'Feedback status updated successfully!');
    }

    public function suggestions(Request $request)
    {
        $query = ToolSuggestion::with('user')->latest();
        
        // Filter by status if provided
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }
        
        $suggestions = $query->paginate(20);
        return view('admin.suggestions', compact('suggestions'));
    }

    public function showSuggestion(ToolSuggestion $suggestion)
    {
        $suggestion->load('user');
        return response()->json($suggestion);
    }

    public function updateSuggestionStatus(Request $request, ToolSuggestion $suggestion)
    {
        $request->validate([
            'status' => 'required|in:pending,under_review,approved,rejected',
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $oldStatus = $suggestion->status;
        $suggestion->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);

        // Send email notification if status changed
        if ($oldStatus !== $request->status) {
            try {
                Mail::to($suggestion->user->email)->send(new SuggestionStatusUpdated($suggestion));
            } catch (\Exception $e) {
                // Log error but don't fail the request
                \Log::error('Failed to send suggestion status email: ' . $e->getMessage());
            }
        }

        return redirect()->route('admin.suggestions')
            ->with('success', 'Suggestion status updated successfully!');
    }
}