@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Draft Thesis Details</h3>
    <ul class="list-group">
        <li class="list-group-item"><strong>ID:</strong> {{ $draft->id }}</li>
        <li class="list-group-item"><strong>Username:</strong> {{ $draft->username }}</li>
        <li class="list-group-item"><strong>Thesis Link:</strong> <a href="{{ $draft->thesislink }}" target="_blank">{{ $draft->thesislink }}</a></li>
        <li class="list-group-item"><strong>Total Pages:</strong> {{ $draft->totalpage }}</li>
        <li class="list-group-item"><strong>Feedback:</strong> {{ $draft->feedback ?? 'No feedback yet' }}</li>
    </ul>
</div>
@endsection
