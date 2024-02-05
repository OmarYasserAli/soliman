@extends('theme.layout')
@section('layout')

@include('theme.inc.mnav')


<section class="soliman-news-content">
  <div class="container">
        <div class="soliman-news-content-img">
          <img src="{{ !empty($img=@$post->imageDetails->image_details['image']['path']['ar']) ? url('uploads').'/'.$img : url('uploads/news').'/'.$post->image }}" alt="{{ $post->title->$lang }}" />
        </div>
        <div class="soliman-news-content-co">
          <h1>{{ $post->title->$lang }}</h1>
          <p>{!! render($post->content->$lang) !!}</p>


        </div>
        @include('theme.inc.share', ['post' => $post])
  </div>
</section>


@if(!$news->isEmpty())
<section class="soliman-news-content-related">
  <div class="container">
  <h2>{{ __('site.news.latesttitle') }}</h2>
  <div class="row">
    @foreach ($news as $new)
    <div class="col-12 col-sm-12 col-md-4 col-lg-4">
        <div class="soliman-news-content-related-item">
        <a href="{{ route('newsBySlug', (string)$new->slug) }}">
            <h3>{{$new->title->$lang}}</h3>
            <div class="soliman-news-content-related-item-img">
            <img src="{{url('uploads/news')}}/{{$new->image}}" alt="{{$new->title->$lang}}" />

          </div>
        </a>
      </div>
    </div>
    @endforeach
  </div>
</div>
</section>
@endif


    @endsection
