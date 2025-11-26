<?php

namespace App\Mail;

use App\Models\ToolSuggestion;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SuggestionStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $suggestion;

    /**
     * Create a new message instance.
     */
    public function __construct(ToolSuggestion $suggestion)
    {
        $this->suggestion = $suggestion;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $statusText = ucfirst(str_replace('_', ' ', $this->suggestion->status));
        
        return new Envelope(
            subject: "Tool Suggestion {$statusText} - WordFix",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            html: 'emails.suggestion-status-updated',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}