@extends('emails.layout')

@section('title', 'Suggestion Status Updated - WordFix')
@section('header-title', 'Suggestion Update')
@section('header-subtitle', 'Your tool suggestion status has been updated')

@section('content')
<p>Hello <strong>{{ $suggestion->user->name }}</strong>,</p>

<p>We have an update regarding your tool suggestion for WordFix!</p>

@if($suggestion->status === 'approved')
    <div class="success-box">
        <h3 style="margin: 0 0 12px 0; color: #065f46;">🎉 Great News - Suggestion Approved!</h3>
        <p style="margin: 0;">Your tool suggestion has been approved and will be added to our development roadmap. We'll keep you updated on the progress!</p>
    </div>
@elseif($suggestion->status === 'rejected')
    <div class="warning-box">
        <h3 style="margin: 0 0 12px 0; color: #92400e;">📝 Suggestion Status Update</h3>
        <p style="margin: 0;">After careful consideration, we've decided not to proceed with this particular suggestion at this time. Thank you for your valuable input!</p>
    </div>
@elseif($suggestion->status === 'under_review')
    <div class="info-box">
        <h3 style="margin: 0 0 12px 0; color: #1e40af;">🔍 Under Review</h3>
        <p style="margin: 0;">Your suggestion is currently under detailed review by our development team. We'll update you once we have more information.</p>
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
<div class="info-box">
    <h4 style="margin: 0 0 8px 0; color: #1e40af;">💬 Note from our team:</h4>
    <p style="margin: 0; font-style: italic;">"{{ $suggestion->admin_notes }}"</p>
</div>
@endif

@if($suggestion->status === 'approved')
<p>We're excited to work on implementing this tool! Development timelines can vary, but we'll keep you informed of major milestones.</p>

<div style="text-align: center; margin: 24px 0;">
    <a href="{{ url('/') }}" class="button">Explore Current Tools</a>
</div>
@elseif($suggestion->status === 'rejected')
<p>While we couldn't move forward with this particular idea, we encourage you to submit more suggestions in the future. Your feedback helps us understand what our users need most.</p>

<div style="text-align: center; margin: 24px 0;">
    <a href="{{ url('/') }}" class="button">Submit Another Suggestion</a>
</div>
@else
<div style="text-align: center; margin: 24px 0;">
    <a href="{{ url('/') }}" class="button">Visit WordFix</a>
</div>
@endif

<p>Thank you for helping us improve WordFix with your valuable suggestions!</p>

<p>Best regards,<br>
<strong>The WordFix Team</strong></p>
@endsection
