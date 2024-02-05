@extends('theme.layout')
@section('layout')

@if(!$posts->isEmpty())
<section class="soliman-molehm-list {{@$inside ? 'inside' : ''}}">
    <div class="container">
        <div class="row">
            @php $i=0 @endphp
            @foreach($posts as $post)

                @if ($post->by_ocoda_dev == true)
                    <div class="{{ ($i%3) ? 'col-12 col-sm-6 col-md-6 col-lg-6' : 'col-12' }}">
                        <a href="{{ route('smolhem', $lang == 'ar' ? (string) $post->slug_ar : (string) $post->slug) }}" class="soliman-molehm-item wow fadeInUp">
                            <img src="{{url('uploads')}}/{{@$post->getImagePath('image', $lang)}}" alt="{{@$post->getImageAlt('image', $lang)}}" title="{{@$post->getImageTitle('image', $lang)}}">
                            <span class="soliman-molehm-item-co">
                                <span>{{$post->cat->$lang}}</span>
                                <h2>{{$post->title->$lang}}</h2>
                                <P>{{$post->breif->$lang}}</P>
                            </span>
                        </a>
                    </div>
                @else
                    <div class="{{ ($i%3) ? 'col-12 col-sm-6 col-md-6 col-lg-6' : 'col-12' }}">
                        <a href="{{ route('smolhem', $lang == 'ar' ? (string) $post->slug_ar : (string) $post->slug) }}" class="soliman-molehm-item wow fadeInUp">
                            <img src="{{url('uploads/molhem')}}/{{$post->image}}" alt="{{$post->title->$lang}}">
                            <span class="soliman-molehm-item-co">
                                <span>{{$post->cat->$lang}}</span>
                                <h2>{{$post->title->$lang}}</h2>
                                <P>{{$post->breif->$lang}}</P>
                            </span>
                        </a>
                    </div>
                @endif
            @php $i++; @endphp
            @endforeach
        </div>
        @include('theme.inc.pager', ['news' =>  $posts])
    </div>
</section>
@endif
@endsection
