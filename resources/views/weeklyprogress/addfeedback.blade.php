@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Add Feedback for Weekly Progress ID: {{ $progress->id }}</h2>

    <form action="{{ route('weeklyprogress.storefeedback', $progress->id) }}" method="POST">
        @csrf

        <div class="form-group mt-3">
            <label for="feedback">Feedback:</label>
            <textarea name="feedback" id="feedback" rows="5" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Submit Feedback</button>
        <a href="{{ route('weeklyprogress.WPviewPlatinumProgress', $progress->username) }}" class="btn btn-secondary mt-3">Cancel</a>
    </form>
</div>
@endsection
