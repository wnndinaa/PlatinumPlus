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
            <h2>Edit Publication</h2>

            <a href="{{ route('publication') }}">
                <button class="btn btn-primary mt-3">Edit Publication</button>
            </a>

        </div>
    </div>
@endsection
