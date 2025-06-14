@extends('layout')

@section('content')
<div class="container mt-4">

    

    <h3>Notify {{ $platinumUser->name }} about Paper</h3>
    <p><strong>Paper Title:</strong> {{ $paper->paper_title }}</p>

    <form method="POST" action="{{ route('manageExpertDomain.sendNotification') }}">
        @csrf
        <input type="hidden" name="username" value="{{ $platinumUser->username }}">
        <input type="hidden" name="paper_id" value="{{ $paper->expertPaper_id }}">

        <div class="form-group">
            <label for="message">Message:</label>
            <textarea name="message" class="form-control" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Send Notification</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
