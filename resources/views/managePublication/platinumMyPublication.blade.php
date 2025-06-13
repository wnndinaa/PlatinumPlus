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
            <h2>My Publication</h2>

            <a href="{{ route('publication.MyPublication.edit') }}">
                <button class="btn btn-primary mt-3">Edit Publication</button>
            </a>
            <a href="{{ route('publication.MyPublication.add') }}">
                <button class="btn btn-primary mt-3">Add Publication</button>
            </a>

        </div>
    </div>
@endsection
