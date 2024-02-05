@extends('theme.layout')
@section('layout')

@include('theme.inc.mnav')

<section class="soliman-news-content">
  <div class="container">

        <div class="soliman-news-content-co">
          <h1>{{ $page->title->$lang }}</h1>
          <p>{!! render($page->content->$lang) !!}</p>


        </div>
        @include('theme.inc.share', ['post' => $page])

  </div>
</section>





    @endsection
