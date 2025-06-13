@extends('layout')

@section('content')
<div class="container mt-4">
    <h3>Platinum Report</h3>

    <div class="card">
        <div class="card-body">
            <p><strong>Name:</strong> {{ $platinumUser->name }}</p>
            <p><strong>Username:</strong> {{ $platinumUser->username }}</p>
            <p><strong>Total Expert Papers:</strong> {{ $totalPapers }}</p>
        </div>
    </div>

    <a href="{{ route('manageExpertDomain.platinumList') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
