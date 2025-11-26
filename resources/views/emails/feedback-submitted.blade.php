@extends('emails.layout')

@section('title', 'Feedback Submitted - WordFix')
@section('header-title', 'Thank You! 💙')
@section('header-subtitle', 'Your feedback has been received')

@section('content')
<p>Hello <strong>{{ $feedback->user->name }}</strong>,</p>

<p>Thank you for taking the time to provide feedback about WordFix! Your input is incredibly valuable and helps us improve our platform for everyone.</p>

<div class="success-box">
    <h3 style="margin: 0 0 12px 0; color: #065f46;">✅ Feedback Received Successfully</h3>
    <p style="margin: 0;">Your feedback has been submitted and our team will review it carefully.</p>
</div>

<h3>Feedback Details:</h3>
<table class="details-table">
    <tr>
        <th>Feedback Type</th>
        <td>{{ ucfirst(str_replace('_', ' ', $feedback->feedback_type)) }}</td>
    </tr>
    @if($feedback->tool_name)
    <tr>
        <th>Related Tool</th>
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
            ({{ $feedback->rating }}/5 stars)
        </td>
    </tr>
    @endif
    <tr>
        <th>Your Message</th>
        <td>{{ $feedback->message }}</td>
    </tr>
    <tr>
        <th>Status</th>
        <td><span class="status-badge status-new">New</span></td>
    </tr>
    <tr>
        <th>Submitted On</th>
        <td>{{ $feedback->created_at->format('F j, Y \a\t g:i A') }}</td>
    </tr>
</table>

<div class="info-box">
    <h4 style="margin: 0 0 8px 0; color: #1e40af;">📋 What happens next?</h4>
    <ul style="margin: 0; padding-left: 20px;">
        @if($feedback->feedback_type === 'bug_report')
            <li>Our development team will investigate the reported issue</li>
            <li>We'll work on reproducing and fixing the bug</li>
            <li>You'll receive updates as we make progress</li>
        @elseif($feedback->feedback_type === 'feature_request')
            <li>We'll evaluate your feature request and its feasibility</li>
            <li>Popular requests are prioritized in our development roadmap</li>
            <li>You'll be notified if we decide to implement your suggestion</li>
        @elseif($feedback->feedback_type === 'improvement')
            <li>We'll review your improvement suggestions</li>
            <li>Our team will assess how to enhance the mentioned areas</li>
            <li>Updates will be shared as improvements are implemented</li>
        @elseif($feedback->feedback_type === 'compliment')
            <li>Your kind words will be shared with our team! 😊</li>
            <li>Positive feedback motivates us to keep improving</li>
            <li>Thank you for taking the time to appreciate our work</li>
        @else
            <li>Our team will review your feedback within 2-3 business days</li>
            <li>We'll respond if any clarification or follow-up is needed</li>
            <li>You'll receive updates on any actions taken</li>
        @endif
    </ul>
</div>

@if($feedback->feedback_type === 'compliment')
<p>Your positive feedback means the world to us! It's users like you who inspire us to keep building and improving WordFix every day. Thank you for being part of our community! 🙏</p>
@else
<p>We take all feedback seriously and use it to guide our development priorities. Your input directly contributes to making WordFix better for everyone.</p>
@endif

<div style="text-align: center; margin: 24px 0;">
    <a href="{{ url('/') }}" class="button">Continue Using WordFix</a>
</div>

<p>Have more feedback? We're always listening! Feel free to submit additional feedback anytime through our website.</p>

<p>Best regards,<br>
<strong>The WordFix Team</strong></p>
@endsection
