@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Feedback for Draft Thesis: {{ $draft->title }}</h2>

    <form action="{{ route('draftThesis.updatefeedback', $draft->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mt-3">
            <label for="feedback">Feedback:</label>
            <textarea name="feedback" id="feedback" rows="5" class="form-control" required>{{ $draft->feedback }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Feedback</button>
    </form>
</div>
@endsection
