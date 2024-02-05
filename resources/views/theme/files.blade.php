@extends('theme.layout')
@section('layout')

@include('theme.inc.mnav')


@if(!$files->isEmpty())
<section class="soliman-files-list">
    <div class="container">
        <div class="row">
            @foreach ($files as $file)

            @if ($file->by_ocoda_dev == true)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="soliman-files-item">
                        <div class="soliman-files-item-img">
                            <img src="{{ url('uploads')}}/{{@$file->getImagePath('image', $lang)}}" alt="{{@$file->getImageAlt('image', $lang)}}" title="{{@$file->getImageTitle('image', $lang)}}">
                        </div>
                        <div class="soliman-files-item-co">
                            <h2>{{ $file->title->$lang }}</h2>
                            <a href="{{ $file->url }}" target="_blank">
                                <svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 384 512" class="svg-inline--fa fa-arrow-to-bottom fa-w-12"><path fill="currentColor" d="M348.5 264l-148 148.5c-4.7 4.7-12.3 4.7-17 0L35.5 264c-4.7-4.7-4.7-12.3 0-17l7.1-7.1c4.7-4.7 12.3-4.7 17 0l115.4 116V44c0-6.6 5.4-12 12-12h10c6.6 0 12 5.4 12 12v311.9L324.4 240c4.7-4.7 12.3-4.7 17 0l7.1 7.1c4.7 4.6 4.7 12.2 0 16.9zM384 468v-8c0-6.6-5.4-12-12-12H12c-6.6 0-12 5.4-12 12v8c0 6.6 5.4 12 12 12h360c6.6 0 12-5.4 12-12z" class=""></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="soliman-files-item">
                        <div class="soliman-files-item-img">
                            <img src="{{ url('uploads/files').'/'.$file->image }}" alt="{{ $file->title->$lang }}">
                        </div>
                        <div class="soliman-files-item-co">
                            <h2>{{ $file->title->$lang }}</h2>
                            <a href="{{ $file->url }}" target="_blank">
                                <svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 384 512" class="svg-inline--fa fa-arrow-to-bottom fa-w-12"><path fill="currentColor" d="M348.5 264l-148 148.5c-4.7 4.7-12.3 4.7-17 0L35.5 264c-4.7-4.7-4.7-12.3 0-17l7.1-7.1c4.7-4.7 12.3-4.7 17 0l115.4 116V44c0-6.6 5.4-12 12-12h10c6.6 0 12 5.4 12 12v311.9L324.4 240c4.7-4.7 12.3-4.7 17 0l7.1 7.1c4.7 4.6 4.7 12.2 0 16.9zM384 468v-8c0-6.6-5.4-12-12-12H12c-6.6 0-12 5.4-12 12v8c0 6.6 5.4 12 12 12h360c6.6 0 12-5.4 12-12z" class=""></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            @endforeach

        </div>
    </div>
</section>
@endif

    @endsection
