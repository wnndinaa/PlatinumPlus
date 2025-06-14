@extends('layout')

@section('content')
    <div class="content">
        <div class="card">
            <h2>Add New Publication</h2>

            <form method="POST" action="{{ route('publication.store') }}" enctype="multipart/form-data">
                @csrf

                <label>Title</label>
                <input type="text" name="publication_title" class="form-control" required>

                <label>Authors</label>
                <input type="text" name="publication_author" class="form-control" required>

                <label>Publication Date</label>
                <input type="date" name="publication_date" class="form-control" required>

                <label>DOI</label>
                <input type="text" name="publication_DOI" class="form-control" required>

                <label>Publication Type</label>
                <select name="publication_type" class="form-control" required>
                    <option value="researchPaper">Research Paper</option>
                    <option value="journal">Journal</option>
                    <option value="conference">Conference Paper</option>
                </select>

                <label>Upload File (PDF)</label>
                <input type="file" name="publication_file" accept="application/pdf" class="form-control" required>

                <button type="submit" class="btn btn-primary mt-3">Add Publication</button>
            </form>

        </div>
    </div>
@endsection
