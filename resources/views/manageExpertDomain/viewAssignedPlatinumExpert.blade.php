@extends('layout')

@section('content')
<div class="container mt-4">
    <h3>Expert Papers for {{ $platinumUser->name }} ({{ $platinumUser->username }})</h3>

    @if ($expertDomains->isEmpty())
        <p>No expert domains found for this Platinum user.</p>
    @else
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Domain Expertise</th>
                    <th>Paper Title</th>
                    <th>Date</th>
                    <th>DOI</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($expertDomains as $domain)
                    @foreach ($domain->papers as $paper)
                        <tr>
                            <td>{{ $loop->parent->iteration }}.{{ $loop->iteration }}</td>
                            <td>{{ $domain->domain_expertise }}</td>
                            <td>{{ $paper->paper_title }}</td>
                            <td>{{ $paper->paper_date }}</td>
                            <td>{{ $paper->paper_DOI }}</td>
                            <td>
                                <a href="{{ route('manageExpertDomain.notifyPlatinum', ['paper_id' => $paper->expertPaper_id]) }}"
                                class="btn btn-sm btn-warning">Notify</a>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('manageExpertDomain.platinumList') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
