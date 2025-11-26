@extends('emails.layout')

@section('title', 'Suggestion Status Updated - WordFix')
@section('header-title', 'Suggestion Update')
@section('header-subtitle', 'Your tool suggestion status has been updated')

@section('content')
<p class="compact-text">Hello <strong>{{ $suggestion->user->name }}</strong>,</p>

<p class="compact-text">Update on your tool suggestion:</p>

@if($suggestion->status === 'approved')
    <div class="success-box">
        <div class="admin-reply-header">
            <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Suggestion Approved!
        </div>
        <p style="margin: 0; font-size: 13px;">Great news! Your suggestion is approved and added to our roadmap.</p>
    </div>
@elseif($suggestion->status === 'rejected')
    <div class="error-box">
        <div class="admin-reply-header">
            <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                <path d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Not Proceeding
        </div>
        <p style="margin: 0; font-size: 13px;">We can't proceed with this suggestion currently. Thank you for your input!</p>
    </div>
@elseif($suggestion->status === 'under_review')
    <div class="info-box">
        <div class="admin-reply-header">
            <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            Under Review
        </div>
        <p style="margin: 0; font-size: 13px;">Your suggestion is being reviewed by our team. Updates coming soon!</p>
    </div>
@endif

<h3>Suggestion Details:</h3>
<table class="details-table">
    <tr>
        <th>Tool Name</th>
        <td>{{ $suggestion->tool_name }}</td>
    </tr>
    <tr>
        <th>Category</th>
        <td>{{ $suggestion->category ?: 'Not specified' }}</td>
    </tr>
    <tr>
        <th>Description</th>
        <td>{{ $suggestion->description }}</td>
    </tr>
    @if($suggestion->use_case)
    <tr>
        <th>Use Case</th>
        <td>{{ $suggestion->use_case }}</td>
    </tr>
    @endif
    <tr>
        <th>Current Status</th>
        <td><span class="status-badge status-{{ $suggestion->status }}">{{ ucfirst(str_replace('_', ' ', $suggestion->status)) }}</span></td>
    </tr>
    <tr>
        <th>Last Updated</th>
        <td>{{ $suggestion->updated_at->format('F j, Y \a\t g:i A') }}</td>
    </tr>
</table>

@if($suggestion->admin_notes)
<div class="admin-reply">
    <div class="admin-reply-header">
        <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
            <path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
        </svg>
        Team Note
    </div>
    <p style="margin: 0; font-size: 13px; font-style: italic;">"{{ $suggestion->admin_notes }}"</p>
</div>
@endif

<p class="compact-text">
@if($suggestion->status === 'approved')
    We're excited to implement this! We'll keep you updated on progress.
@elseif($suggestion->status === 'rejected')
    We encourage more suggestions in the future. Your input helps us understand user needs.
@else
    Thank you for helping us improve WordFix with your suggestions!
@endif
</p>

<div style="text-align: center; margin: 12px 0;">
    <a href="{{ url('/') }}" class="button">
        @if($suggestion->status === 'approved')
            Explore Current Tools
        @elseif($suggestion->status === 'rejected')
            Submit Another Suggestion
        @else
            Visit WordFix
        @endif
    </a>
</div>

<p class="compact-text">Best regards,<br><strong>WordFix Team</strong></p>
@endsection
