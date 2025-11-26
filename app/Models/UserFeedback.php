<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserFeedback extends Model
{
    protected $fillable = [
        'user_id',
        'tool_name',
        'feedback_type',
        'rating',
        'message',
        'browser',
        'device',
        'status',
        'admin_response',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'rating' => 'integer',
    ];

    /**
     * Get the user that submitted the feedback.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the feedback type display text.
     */
    public function getFeedbackTypeTextAttribute(): string
    {
        return match($this->feedback_type) {
            'bug_report' => 'Bug Report',
            'feature_request' => 'Feature Request',
            'improvement' => 'Improvement',
            'compliment' => 'Compliment',
            'other' => 'Other',
            default => 'Unknown',
        };
    }

    /**
     * Get the status badge color.
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'new' => 'blue',
            'in_progress' => 'yellow',
            'resolved' => 'green',
            'closed' => 'gray',
            default => 'gray',
        };
    }

    /**
     * Get the status display text.
     */
    public function getStatusTextAttribute(): string
    {
        return match($this->status) {
            'new' => 'New',
            'in_progress' => 'In Progress',
            'resolved' => 'Resolved',
            'closed' => 'Closed',
            default => 'Unknown',
        };
    }

    /**
     * Get the rating stars as HTML.
     */
    public function getRatingStarsAttribute(): string
    {
        if (!$this->rating) {
            return '<span class="text-gray-400">No rating</span>';
        }

        $stars = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $this->rating) {
                $stars .= '<span class="text-yellow-400">★</span>';
            } else {
                $stars .= '<span class="text-gray-300">★</span>';
            }
        }
        return $stars;
    }
}
