<?php

namespace App\Http\Controllers;

use App\Models\UserFeedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\FeedbackSubmitted;

class FeedbackController extends Controller
{
    /**
     * Store new user feedback.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tool_name' => 'nullable|string|max:255',
            'feedback_type' => 'required|in:bug_report,feature_request,improvement,compliment,other',
            'rating' => 'nullable|integer|min:1|max:5',
            'message' => 'required|string|max:1000',
        ]);

        // Get browser and device info from user agent
        $userAgent = $request->header('User-Agent');
        $browser = $this->getBrowserFromUserAgent($userAgent);
        $device = $this->getDeviceFromUserAgent($userAgent);

        $feedback = UserFeedback::create([
            'user_id' => Auth::id(),
            'tool_name' => $request->tool_name,
            'feedback_type' => $request->feedback_type,
            'rating' => $request->rating,
            'message' => $request->message,
            'browser' => $browser,
            'device' => $device,
            'status' => 'new',
        ]);

        // Send confirmation email
        try {
            Mail::to(Auth::user()->email)->send(new FeedbackSubmitted($feedback));
        } catch (\Exception $e) {
            // Log error but don't fail the request
            \Log::error('Failed to send feedback confirmation email: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Thank you for your feedback! We appreciate your input and will use it to improve WordFix.'
        ]);
    }

    /**
     * Get user's feedback history.
     */
    public function index()
    {
        $feedback = UserFeedback::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($feedback);
    }

    /**
     * Extract browser info from user agent.
     */
    private function getBrowserFromUserAgent($userAgent)
    {
        if (strpos($userAgent, 'Chrome') !== false) {
            return 'Chrome';
        } elseif (strpos($userAgent, 'Firefox') !== false) {
            return 'Firefox';
        } elseif (strpos($userAgent, 'Safari') !== false) {
            return 'Safari';
        } elseif (strpos($userAgent, 'Edge') !== false) {
            return 'Edge';
        } elseif (strpos($userAgent, 'Opera') !== false) {
            return 'Opera';
        }
        
        return 'Unknown';
    }

    /**
     * Extract device info from user agent.
     */
    private function getDeviceFromUserAgent($userAgent)
    {
        if (strpos($userAgent, 'Mobile') !== false || strpos($userAgent, 'Android') !== false) {
            return 'Mobile';
        } elseif (strpos($userAgent, 'Tablet') !== false || strpos($userAgent, 'iPad') !== false) {
            return 'Tablet';
        }
        
        return 'Desktop';
    }
}