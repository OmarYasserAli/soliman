<div class="soliman-pag">
    <ul>
        @if($news->hasPages())
        @php
        $currentQueries = request()->query();
        $ptotal=(int)ceil($news->total()/$news->perPage())
        @endphp
        @if($news->currentPage() !== 1)
        <li><a class="prev" href="{{$news->withQueryString()->previousPageUrl()}}">
            <svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 256 512" class="svg-inline--fa fa-chevron-right fa-w-8"><path fill="currentColor" d="M17.525 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L205.947 256 10.454 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L34.495 36.465c-4.686-4.687-12.284-4.687-16.97 0z" class=""></path></svg>
        </a></li>
        <li><a class="prev_text" href="{{$news->withQueryString()->previousPageUrl()}}">السابق</a></li>
        @endif

            @for($i=1;$i<=$ptotal;$i++)
                <li><a @if($news->currentPage() == $i) class="active" @endif href="{{$news->withQueryString()->url($i)}}">{{$i}}</a></li>
            @endfor
        @if($news->currentPage() != $ptotal)
        <li><a class="next_text" href="{{$news->withQueryString()->nextPageUrl()}}">التالى</a></li>
        <li><a class="next" href="{{$news->withQueryString()->nextPageUrl()}}">
            <svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 256 512" class="svg-inline--fa fa-chevron-left fa-w-8"><path fill="currentColor" d="M238.475 475.535l7.071-7.07c4.686-4.686 4.686-12.284 0-16.971L50.053 256 245.546 60.506c4.686-4.686 4.686-12.284 0-16.971l-7.071-7.07c-4.686-4.686-12.284-4.686-16.97 0L10.454 247.515c-4.686 4.686-4.686 12.284 0 16.971l211.051 211.05c4.686 4.686 12.284 4.686 16.97-.001z" class=""></path></svg>
        </a></li>
        @endif
        @endif

    </ul>
</div>
