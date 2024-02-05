@extends('theme.layout')
@section('layout')

@include('theme.inc.about')
@include('theme.inc.helper')

@if(!$sliders->isEmpty())
    <section class="soliman-products">
        <div class="soliman-products-slick">
            @foreach ($sliders as $slider)
                @if ($slider->by_ocoda_dev == true)
                    <div class="soliman-products-item">
                        <a href="{{$slider->url}}">{{$slider->title->$lang}}</a>
                        <img src="{{url('uploads')}}/{{@$slider->getImagePath('image', $lang)}}" alt="{{@$slider->getImageAlt('image', $lang)}}" title="{{@$slider->getImageTitle('image', $lang)}}">
                    </div>
                @else
                    <div class="soliman-products-item">
                        <a href="{{$slider->url}}">{{$slider->title->$lang}}</a>
                        <img src="{{url('uploads/slider')}}/{{$slider->image}}" alt="{{$slider->title->$lang}}">
                    </div>
                @endif
            @endforeach
        </div>
    </section>
@endif
    @if(!$services->isEmpty())
    <section class="soliman-services" id="services">
        <div class="container">
            <h2>{{ __('site.nav.services')}}</h2>
            <div class="soliman-services-items">
                <div class="row">
                    @foreach ($services as $service)
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                            <div class="soliman-services-item wow fadeInDown">
                                <h3>{{ $service->title->ar }}</h3>
                                <h4>{{ $service->title->en }}</h4>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
    @endif
    @if(!$logos->isEmpty())
    <section class="soliman-projects" id="projects">
        <div class="container">
            <h2>{{ __('site.nav.projects')}}</h2>
            <div class="soliman-projects-items">
                <div class="row  justify-content-center">
                    @foreach ($logos as $logo)
                        @if ($logo->by_ocoda_dev == true)
                            <div class="col-6 col-sm-6 col-md-4 col-lg-4">
                                <a href="{{$logo->url}}" class="soliman-projects-item  wow fadeInUp " >
                                    <img src="{{url('uploads')}}/{{@$logo->getImagePath('image', $lang)}}" alt="{{@$logo->getImageAlt('image', $lang)}}" title="{{@$logo->getImageTitle('image', $lang)}}">
                                </a>
                            </div>
                        @else
                            <div class="col-6 col-sm-6 col-md-4 col-lg-4">
                                <a href="{{$logo->url}}" class="soliman-projects-item  wow fadeInUp " >
                                    <img src="{{url('uploads/logos')}}/{{$logo->image}}" alt="{{$logo->title->$lang}}">
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif
@endsection
