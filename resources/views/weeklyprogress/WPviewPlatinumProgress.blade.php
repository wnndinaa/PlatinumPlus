@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Weekly Progress for: {{ $name }}</h2>

    @if($weeklyProgress->isEmpty())
    <p class="text-center">No weekly progress submitted by this Platinum yet.</p>
    @else
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Progress Info</th>
                <th>Feedback</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($weeklyProgress as $progress)
                <tr>
                    <td>{{ $progress->id }}</td>
                    <td>{{ $progress->startDate }}</td>
                    <td>{{ $progress->endDate }}</td>
                    <td>{{ $progress->progressinfo }}</td>
                    <td>
                        @if(empty($progress->feedback))
                            <!-- Show Add Feedback button only when no feedback -->
                            <a href="{{ route('weeklyprogress.addfeedback', $progress->id) }}" class="btn btn-primary btn-sm">Add</a>
                        @else
                            <!-- Show Edit and Delete buttons if feedback exists -->
                            <a href="{{ route('weeklyprogress.editfeedback', $progress->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('weeklyprogress.deletefeedback', $progress->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this feedback?')">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @endif

    <div class="mt-3 text-center">
        <a href="{{ route('weeklyprogress.WPplatinumList') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
