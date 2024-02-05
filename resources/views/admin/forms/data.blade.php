@extends('admin.layout')

@section('body')

<div class="card">
    <div class="card-block">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th >#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Date</th>
                        <th>product</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($results as $result)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $result->name }}</td>
                        <td>{{ $result->email }}</td>
                        <td>{{ $result->phone }}</td>
                        <td>{{ $result->created_at }}</td>
                        <td>{{  $result->product_id == 101 ?"بلو دار": ($result->product?->slug_ar ?? "" )}}</td>


                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align:center">Nothing</td>
                    </tr>
                    @endforelse

                </tbody>

            </table>
            <br>
            @if($results->hasPages())
                @php
                    $currentQueries = request()->query();
                    $ptotal=(int)ceil($results->total()/$results->perPage())
                @endphp
                <ul class="pagination">
                    @if($results->currentPage() !== 1)
                        <li class="page-item">
                            <a class="page-link" href="{{$results->withQueryString()->previousPageUrl()}}" aria-label="Previous">
                                <span aria-hidden="true">«</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                    @endif
                    @for($i=1;$i<=$ptotal;$i++)
                        <li class="page-item @if($results->currentPage() == $i) active @endif"><a class="page-link" href="{{$results->withQueryString()->url($i)}}">{{$i}}</a></li>
                    @endfor
                    @if($results->currentPage() != $ptotal)
                        <li class="page-item">
                            <a class="page-link" href="{{$results->withQueryString()->nextPageUrl()}}" aria-label="Next">
                                <span aria-hidden="true">»</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    @endif
                </ul>
            @endif

        </div>
    </div>
</div>

@endsection
