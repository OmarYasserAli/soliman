@if (!$rprojects->isEmpty())
    <section class="soliman-product-related">
        <div class="container">
            <h2>{{ __('site.' . $folder . '.relatedp') }}</h2>
            <div class="soliman-product-accordion wow zoomIn">
                <ul>
                    @foreach ($rprojects as $rproject)
                        @if ($rproject->by_ocoda_dev == true)
                            @php $backbg = $rproject->getImagePath('image', $lang); @endphp
                            <li style="background-image: url('{{ url('uploads') }}/{{ @$backbg }}');">
                            @else
                            <li
                                style="background-image: url('{{ url('uploads/' . $folder . '/' . $rproject->image) }}');">
                        @endif
                        <div> <a href="{{ route($route, (string) $rproject->slug) }}">
                                <h3>{{ $rproject->title->$lang }}</h3>
                                <p>{{ $rproject->breif->$lang }}</p>
                            </a> </div>
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </section>
@endif
