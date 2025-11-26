@extends('emails.layout')

@section('title', 'Tool Suggestion Submitted - WordFix')
@section('header-title', 'Thank You! 🎉')
@section('header-subtitle', 'Your tool suggestion has been received')

@section('content')
<p>Hello <strong>{{ $suggestion->user->name }}</strong>,</p>

<p>Thank you for taking the time to suggest a new tool for WordFix! We really appreciate your input and ideas for improving our platform.</p>

<div class="success-box">
    <h3 style="margin: 0 0 12px 0; color: #065f46;">✅ Suggestion Received Successfully</h3>
    <p style="margin: 0;">Your suggestion has been submitted and is now under review by our team.</p>
</div>

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
        <th>Status</th>
        <td><span class="status-badge status-pending">{{ $suggestion->status }}</span></td>
    </tr>
    <tr>
        <th>Submitted On</th>
        <td>{{ $suggestion->created_at->format('F j, Y \a\t g:i A') }}</td>
    </tr>
</table>

<div class="info-box">
    <h4 style="margin: 0 0 8px 0; color: #1e40af;">📋 What happens next?</h4>
    <ul style="margin: 0; padding-left: 20px;">
        <li>Our team will review your suggestion within 2-3 business days</li>
        <li>We'll evaluate the feasibility and potential impact of the tool</li>
        <li>You'll receive an email notification when the status changes</li>
        <li>If approved, we'll add it to our development roadmap</li>
    </ul>
</div>

<p>We value every suggestion and carefully consider each one. Even if we can't implement every idea immediately, your feedback helps us understand what our users need most.</p>

<div style="text-align: center; margin: 24px 0;">
    <a href="{{ url('/') }}" class="button">Continue Using WordFix</a>
</div>

<p>Have more ideas? Feel free to submit additional suggestions anytime through our website!</p>

<p>Best regards,<br>
<strong>The WordFix Team</strong></p>
@endsection
