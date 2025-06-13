@extends('layout')

@section('content')
<div class="container mt-4">
    <h3>Edit Paper for {{ $expert->expert_name }}</h3>

    <form method="POST" action="{{ route('manageExpertDomain.updatePaper', $paper->expertPaper_id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Paper Title</label>
            <input type="text" name="paper_title" value="{{ $paper->paper_title }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">DOI</label>
            <input type="text" name="paper_DOI" value="{{ $paper->paper_DOI }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Author</label>
            <input type="text" name="paper_author" value="{{ $paper->paper_author }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="paper_date" value="{{ $paper->paper_date }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Paper</button>
        <a href="{{ route('manageExpertDomain.paperList', $paper->expert_id) }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
