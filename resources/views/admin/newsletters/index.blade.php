@extends('admin.layout')

@section('body')

<div class="card">
    <div class="card-block">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($results as $result)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $result->email }}</td>
                        <td class="text-nowrap">
                            <a href="{{ route($route . '.edit', $result->id) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                            <a
                            onclick="if(confirm('Are Youe Sure?')){event.preventDefault();document.getElementById('{{$route}}-destroy-form-{{$loop->iteration}}').submit();}else{return false}"
                            href="{{ route($route . '.destroy', $result->id) }}" data-toggle="tooltip" data-original-title="Delete"> <i class="fa fa-close text-danger"></i>
                            <form action="{{ route($route.'.destroy', $result->id) }}" id="{{$route}}-destroy-form-{{$loop->iteration}}"
                                method="POST" style="display:none">@csrf @method('DELETE')</form>
                        </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" style="text-align:center">Nothing</td>
                    </tr>
                    @endforelse

                </tbody>
                <tfoot>
                    <tr>
                        <td>
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
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

@endsection
