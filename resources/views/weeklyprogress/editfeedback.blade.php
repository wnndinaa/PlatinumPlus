@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Feedback for Weekly Progress ID: {{ $progress->id }}</h2>

    <form action="{{ route('weeklyprogress.updatefeedback', $progress->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mt-3">
            <label for="feedback">Feedback:</label>
            <textarea name="feedback" id="feedback" rows="5" class="form-control" required>{{ $progress->feedback }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Feedback</button>
        <a href="{{ route('weeklyprogress.WPviewPlatinumProgress', $progress->username) }}" class="btn btn-secondary mt-3">Cancel</a>
    </form>
</div>
@endsection
