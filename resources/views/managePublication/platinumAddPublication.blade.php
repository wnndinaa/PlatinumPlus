{{-- <script>
    function togglePassword() {
        const input = document.getElementById('password');
        if (input.type === 'password') {
            input.type = 'text';
        } else {
            input.type = 'password';
        }
    }
</script> --}}


@extends('layout')

@section('content')
    <div class="content">
        <div class="card">
            <h2>Add New Publication</h2>

            <form method="POST" action="#">
                @csrf

                <label>Title</label>
                <input type="text" name="title" class="form-control" required>

                <label>Authors</label>
                <input type="text" name="authors" class="form-control" required>

                <label>Year</label>
                <input type="number" name="year" class="form-control" required>

                <label>DOI</label>
                <input type="text" name="DOI" class="form-control" required>

                <label>Publication Type</label>
                <br>
                <select name="publicationType" id="">
                    <option value="researchPaper">Research Paper</option>
                    <option value="journal">Journal</option>
                    <option value="conference">Conference Paper</option>
                </select>
                <br>
                <label>Upload File (PDF)</label>
                <input type="file" name="file" accept="application/pdf" class="form-control" required>

                <button type="submit" class="btn btn-primary mt-3">Add Publication</button>
            </form>
        </div>
    </div>
@endsection
