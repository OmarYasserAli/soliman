@extends('theme.layout')
@section('layout')

@include('theme.inc.mnav')

@if(!$news->isEmpty())
<section class="soliman-news-list">
    <div class="container">
        <div class="row">
            @foreach ($news as $new)

                @if ($new->by_ocoda_dev == true)
                    <div class="col-12 col-col-sm-12 col-md-6 col-lg-6">
                        <div class="soliman-news-item wow fadeInUp">
                            <div class="soliman-news-item-img">
                                <img src="{{url('uploads')}}/{{@$new->getImagePath('image', $lang)}}" alt="{{@$new->getImageAlt('image', $lang)}}" title="{{@$new->getImageTitle('image', $lang)}}">
                            </div>
                            <span>{{$new->dt}}</span>
                            <a href="{{ route('newsBySlug', $lang == 'ar' ? (string) $new->slug_ar : (string) $new->slug) }}"><h2>{{$new->title->$lang}}</h2></a>
                        </div>
                    </div>
                @else
                    <div class="col-12 col-col-sm-12 col-md-6 col-lg-6">
                        <div class="soliman-news-item wow fadeInUp">
                            <div class="soliman-news-item-img">
                                <img src="{{url('uploads/news')}}/{{$new->image}}" alt="{{$new->title->$lang}}">
                            </div>
                            <span>{{$new->dt}}</span>
                            <a href="{{ route('newsBySlug', $lang == 'ar' ? (string) $new->slug_ar : (string) $new->slug) }}"><h2>{{$new->title->$lang}}</h2></a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        @include('theme.inc.pager', ['news' =>  $news])
    </div>
</section>
@endif
    @endsection
