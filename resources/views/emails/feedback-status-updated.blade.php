@extends('emails.layout')

@section('title', 'Feedback Status Updated - WordFix')
@section('header-title', 'Feedback Update')
@section('header-subtitle', 'Your feedback status has been updated')

@section('content')
<p>Hello <strong>{{ $feedback->user->name }}</strong>,</p>

<p>Thank you for your feedback! We have an update regarding your recent submission to WordFix.</p>

@if($feedback->status === 'resolved')
    <div class="success-box">
        <h3 style="margin: 0 0 12px 0; color: #065f46;">✅ Issue Resolved</h3>
        <p style="margin: 0;">Great news! We've addressed your feedback and implemented the necessary changes. Thank you for helping us improve WordFix!</p>
    </div>
@elseif($feedback->status === 'in_progress')
    <div class="info-box">
        <h3 style="margin: 0 0 12px 0; color: #1e40af;">🔧 In Progress</h3>
        <p style="margin: 0;">We're actively working on addressing your feedback. We'll keep you updated on our progress!</p>
    </div>
@elseif($feedback->status === 'closed')
    <div class="warning-box">
        <h3 style="margin: 0 0 12px 0; color: #92400e;">📋 Feedback Closed</h3>
        <p style="margin: 0;">We've reviewed your feedback and have closed this item. Thank you for taking the time to share your thoughts with us!</p>
    </div>
@endif

<h3>Feedback Details:</h3>
<table class="details-table">
    <tr>
        <th>Feedback Type</th>
        <td>{{ ucfirst(str_replace('_', ' ', $feedback->feedback_type)) }}</td>
    </tr>
    @if($feedback->tool_name)
    <tr>
        <th>Tool</th>
        <td>{{ $feedback->tool_name }}</td>
    </tr>
    @endif
    @if($feedback->rating)
    <tr>
        <th>Rating</th>
        <td>
            @for($i = 1; $i <= 5; $i++)
                @if($i <= $feedback->rating)⭐@else☆@endif
            @endfor
            ({{ $feedback->rating }}/5)
        </td>
    </tr>
    @endif
    <tr>
        <th>Your Message</th>
        <td>{{ Str::limit($feedback->message, 200) }}@if(strlen($feedback->message) > 200)...@endif</td>
    </tr>
    <tr>
        <th>Current Status</th>
        <td><span class="status-badge status-{{ $feedback->status }}">{{ ucfirst(str_replace('_', ' ', $feedback->status)) }}</span></td>
    </tr>
    <tr>
        <th>Last Updated</th>
        <td>{{ $feedback->updated_at->format('F j, Y \a\t g:i A') }}</td>
    </tr>
</table>

@if($feedback->admin_response)
<div class="info-box">
    <h4 style="margin: 0 0 8px 0; color: #1e40af;">💬 Response from our team:</h4>
    <p style="margin: 0; font-style: italic;">"{{ $feedback->admin_response }}"</p>
</div>
@endif

@if($feedback->status === 'resolved')
<p>We hope our solution addresses your concerns. If you have any additional feedback or encounter other issues, please don't hesitate to reach out!</p>
@elseif($feedback->status === 'in_progress')
<p>We're committed to addressing your feedback and will update you as we make progress. Thank you for your patience!</p>
@else
<p>Your feedback is valuable to us and helps improve WordFix for everyone. We appreciate you taking the time to share your thoughts!</p>
@endif

<div style="text-align: center; margin: 24px 0;">
    <a href="{{ url('/') }}" class="button">Continue Using WordFix</a>
</div>

<p>Have more feedback? We'd love to hear from you! Feel free to submit additional feedback anytime through our website.</p>

<p>Best regards,<br>
<strong>The WordFix Team</strong></p>
@endsection
