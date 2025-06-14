@extends('layout')

@section('content')
<div class="container mt-4">
    <h3>Papers for {{ $expert->expert_name }}</h3>

    <form method="GET" class="row mb-3">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Search by paper title..." value="{{ $search ?? '' }}">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-secondary">Search</button>
        </div>
        <div class="col-auto">
            <a href="{{ route('manageExpertDomain.paperList', $expert->expert_id) }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>

    <a href="{{ route('manageExpertDomain.addPaper', $expert->expert_id) }}" class="btn btn-success mb-3">Add Paper</a>

   <table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Paper Title</th>
            <th>Author</th>
            <th>DOI</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($papers as $index => $paper)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $paper->paper_title }}</td>
                <td>{{ $paper->paper_author }}</td>
                <td>{{ $paper->paper_DOI }}</td>
                <td>{{ $paper->paper_date }}</td>
                <td>
                    <a href="{{ route('manageExpertDomain.editPaper', $paper->expertPaper_id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('manageExpertDomain.deletePaper', $paper->expertPaper_id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this paper?')">Delete</button>
                    </form>
                    <a href="{{ route('manageExpertDomain.viewNotify', $paper->expertPaper_id) }}" class="btn btn-sm btn-info">View Notify</a>
                </td>
            </tr>
        @endforeach

        @if($papers->isEmpty())
            <tr>
                <td colspan="4" class="text-center">No papers found.</td>
            </tr>
        @endif
    </tbody>
</table>

</div>

<div class="d-flex justify-content-end mt-3">
    <a href="{{ route('manageExpertDomain.index') }}" class="btn btn-outline-primary">Back</a>
</div>

@endsection
