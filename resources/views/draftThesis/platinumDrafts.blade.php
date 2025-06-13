@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Draft Theses Submitted by: {{ $name }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($drafts->isEmpty())
        <p>No draft theses submitted by this user.</p>
    @else
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Number</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Thesis Link</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($drafts as $draft)
                    <tr>
                        <td>{{ $draft->id }}</td>
                        <td>{{ $draft->number }}</td>
                        <td>{{ $draft->title }}</td>
                        <td>{{ $draft->description }}</td>
                        <td><a href="{{ $draft->thesislink }}" target="_blank">View</a></td>
                        <td>
                            @if(!$draft->feedback)
                                <a href="{{ route('draftThesis.addfeedback', $draft->id) }}" class="btn btn-sm btn-success">Add</a>
                            @else
                                <a href="{{ route('draftThesis.editfeedback', $draft->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                <form action="{{ route('draftthesis.deletefeedback', $draft->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>

                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('draftThesis.platinumList') }}" class="btn btn-secondary mt-3">Back to Platinum List</a>
</div>
<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this feedback?");
    }
</script>
@endsection
