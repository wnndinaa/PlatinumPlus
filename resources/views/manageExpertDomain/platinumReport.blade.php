@extends('layout')

@section('content')
<div class="container mt-4">
    <h3>Platinum Expert Report</h3>

    @if ($platinums->isEmpty())
        <p>No assigned Platinum users found.</p>
    @else
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Name</th>
                    <th>Domain Expertise</th>
                    <th>Total Papers (This Domain)</th>
                    <th>Total Papers (All Domains)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($platinums as $platinum)
                    @php $rowspan = count($platinum->domains); @endphp

                    @foreach ($platinum->domains as $index => $domain)
                        <tr>
                            @if ($index === 0)
                                <td rowspan="{{ $rowspan }}">{{ $platinum->name }}<br><small>({{ $platinum->username }})</small></td>
                            @endif
                            <td>{{ $domain['domain'] }}</td>
                            <td>{{ $domain['papers'] }}</td>
                            @if ($index === 0)
                                <td rowspan="{{ $rowspan }}">{{ $platinum->totalPapers }}</td>
                            @endif
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('manageExpertDomain.platinumList') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
