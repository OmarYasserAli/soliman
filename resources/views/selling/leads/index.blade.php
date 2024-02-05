@extends('selling.layout')

@section('body')

<div class="card">
    <div class=" m-3">
        <a href="{{ route('selling.leads.export') }}" class="btn btn-primary">
            export data
        </a>
    </div>
    <div class="card-block">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th >Name</th>
                        <th>Email</th>
                        <th >Phone</th>
                        <th >date - time</th>
                        <th style="text-align: center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($results as $result)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td ondblclick="alert('{{ $result->resp }}')">{{ $result->name }}<br><small>{{ $result->title }}</small></td>
                        <td>{{ $result->email }}</td>
                        <td>{{ $result->phone }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($result->created_at)->format('Y-m-d') }}<br>
                            {{ \Carbon\Carbon::parse($result->created_at)->format('H:i:s') }}
                        </td>
                        <td style="text-align: center"><i class="fa @if($result->success) fa-check text-success @else fa-times text-danger @endif"></i> </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align:center">Nothing</td>
                    </tr>
                    @endforelse

                </tbody>

            </table>
            <tfoot>
                <tr>
                    <td colspan="6">
                        @if($results->hasPages())
                            @php
                                $currentQueries = request()->query();
                                $ptotal = (int)ceil($results->total() / $results->perPage());
                            @endphp
                            <ul class="pagination">
                                @php
                                $threshold = 10; // Adjust this threshold as needed
                                $startPage = max($results->currentPage() - $threshold, 1);
                                $endPage = min($results->currentPage() + $threshold, $ptotal);
                            @endphp

                                @if($results->currentPage() != 1)
                                <li class="page-item">
                                    <a class="page-link" href="{{ $results->withQueryString()->url(1) }}">««</a>
                                </li>

                                    <li class="page-item">
                                        <a class="page-link" href="{{ $results->withQueryString()->previousPageUrl() }}" aria-label="Previous">
                                            <span aria-hidden="true">«</span>
                                            <span class="sr-only">Previous</span>
                                        </a>

                                    </li>

                                @endif

                                @if ($startPage > 1)
                                    <li class="page-item"><span class="ellipsis">&nbsp;&nbsp; ... &nbsp;&nbsp;</span></li>
                                @endif

                                @for($i = $startPage; $i <= $endPage; $i++)
                                    <li class="page-item @if($results->currentPage() == $i) active @endif">
                                        <a class="page-link" href="{{ $results->withQueryString()->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                @if ($endPage < $ptotal)
                                    <li class="page-item"><span class="ellipsis">&nbsp;&nbsp; ... &nbsp;&nbsp;</span></li>
                                @endif

                                @if($results->currentPage() != $ptotal)
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $results->withQueryString()->nextPageUrl() }}" aria-label="Next">
                                            <span aria-hidden="true">»</span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $results->withQueryString()->url($ptotal) }}">»»</a>
                                    </li>
                                @endif
                            </ul>
                        @endif
                    </td>
                </tr>
            </tfoot>

        </div>
    </div>
</div>

@endsection
