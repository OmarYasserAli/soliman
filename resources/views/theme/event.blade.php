@extends('theme.layout')
@section('layout')

    @include('theme.inc.mnav')

    @push('head_scripts')
        {{-- Head script for a specific resource --}}
        @include('enhance.theme.partials._headScript', ['model' => $event])
    @endpush


    <section class="soliman-events-list">
        <div class="container">
            <div class="soliman-events-gallery">
                <div class="row">
                    @if (!empty($event->gallery))
                        @foreach ($event->gallery as $ga)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                <a data-sgallery="event" title="{{ @$event->title->$lang }}"
                                    href="{{ url('uploads/events') }}/{{ $ga }}"><img
                                        src="{{ url('uploads/events') }}/{{ $ga }}"
                                        alt="{{ $event->title->$lang }}"></a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
    @include('theme.inc.sgallery')
@endsection

@push('footer')
    {{-- Footer script for a specific resource --}}
    @include('enhance.theme.partials._footerScript', ['model' => $event])
@endpush
