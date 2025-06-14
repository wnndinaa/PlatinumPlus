@extends('layout')

@section('content')
    <div class="content">
        <div class="card">
            <h2>Edit Publication</h2>
            <form method="POST" action="{{ route('publication.MyPublication.update', $publication->publication_id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <label>Title</label>
                <input type="text" name="publication_title" class="form-control"
                    value="{{ $publication->publication_title }}" required>

                <label>Authors</label>
                <input type="text" name="publication_author" class="form-control"
                    value="{{ $publication->publication_author }}" required>

                <label>Date</label>
                <input type="date" name="publication_date" class="form-control"
                    value="{{ $publication->publication_date }}" required>

                <label>DOI</label>
                <input type="text" name="publication_DOI" class="form-control"
                    value="{{ $publication->publication_DOI }}" required>

                <label>Publication Type</label>
                <select name="publication_type" class="form-control" required>
                    <option value="researchPaper" {{ $publication->publication_type == 'researchPaper' ? 'selected' : '' }}>
                        Research Paper</option>
                    <option value="journal" {{ $publication->publication_type == 'journal' ? 'selected' : '' }}>Journal
                    </option>
                    <option value="conference" {{ $publication->publication_type == 'conference' ? 'selected' : '' }}>
                        Conference Paper</option>
                </select>

                <label>Replace File (PDF)</label>
                <input type="file" name="publication_file" accept="application/pdf" class="form-control">

                <button type="submit" class="btn btn-primary mt-3">Update Publication</button>
            </form>

        </div>
    </div>
@endsection
