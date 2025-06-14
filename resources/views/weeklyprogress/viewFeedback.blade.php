@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header">
            <h4>Feedback for Progress ID: {{ $progress->id }}</h4>
        </div>
        <div class="card-body">
            <p><strong>Start Date:</strong> {{ $progress->startDate }}</p>
            <p><strong>End Date:</strong> {{ $progress->endDate }}</p>
            <p><strong>Progress Info:</strong> {{ $progress->progressinfo }}</p>
            <hr>
            <p><strong>Feedback:</strong></p>
            <p>{{ $progress->feedback ?? 'No feedback given yet.' }}</p>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('weeklyprogress.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
@endsection
