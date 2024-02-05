@extends('theme.layout')
@section('layout')
    @include('theme.inc.mnav')

    @if (!$events->isEmpty())
        <section class="soliman-events-list">
            <div class="container">
                <div class="row">
                    @foreach ($events as $event)
                        @if ($event->by_ocoda_dev == true)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="soliman-events-item wow fadeInUp">
                                    <a href="{{ route('event', $lang == 'ar' ? (string) $event->slug_ar : (string) $event->slug) }}" class="soliman-events-item-img">
                                        <img src="{{ url('uploads') }}/{{ @$event->getImagePath('image', $lang) }}"
                                            alt="{{ @$event->getImageAlt('image', $lang) }}"
                                            title="{{ @$event->getImageTitle('image', $lang) }}">
                                    </a>
                                    <span>{{ $event->dt }}</span>
                                    <h2>{{ $event->title->$lang }}</h2>
                                </div>
                            </div>
                        @else
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="soliman-events-item wow fadeInUp">
                                    <a href="{{ route('event', $lang == 'ar' ? (string) $event->slug_ar : (string) $event->slug) }}" class="soliman-events-item-img">
                                        <img src="{{ url('uploads/events') }}/{{ $event->image }}"
                                            alt="{{ $event->title->$lang }}">
                                    </a>
                                    <span>{{ $event->dt }}</span>
                                    <h2>{{ $event->title->$lang }}</h2>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                @include('theme.inc.pager', ['news' => $events])
        </section>
    @endif
@endsection
