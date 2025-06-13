@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Feedback for Thesis ID: {{ $draft->id }}</h3>

    @if ($draft->feedback)
        <div class="alert alert-info">
            {{ $draft->feedback }}
        </div>
    @else
        <p><em>No feedback available yet.</em></p>
    @endif

    <a href="{{ route('draftThesis.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection

