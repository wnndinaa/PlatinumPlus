@extends('layouts.app')

@section ('draftThesis')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<h1> Draft Thesis</h1>

@if(session('user') && session('user')->role === 'Platinum')
    <a class="btn btn-primary" href="{{ route('draftThesis.create') }}">Add Draft Thesis</a>
@endif

@endsection
