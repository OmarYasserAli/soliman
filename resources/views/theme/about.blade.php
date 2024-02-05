@extends('theme.layout')
@section('layout')

@include('theme.inc.about')

@if(!$values->isEmpty())
<section class="soliman-values">
    <div class="container">
        <h1>{{ __('site.about.values') }}</h1>
        <div class="row justify-content-center">
            @foreach ($values as $value)


                @if ($value->by_ocoda_dev == true)
                    <div class="col-12 col-sm-6 col-md-4 col-lg">
                        <div class="soliman-values-item wow fadeInUp">
                            <div class="soliman-values-itemimg">
                                <img src="{{url('uploads')}}/{{ @$value->getImagePath('image', $lang) }}" alt="{{ @$value->getImageAlt('image', $lang) }}" title="{{ @$value->getImageTitle('image', $lang) }}">
                            </div>
                            <h3>{{ $value->title->$lang }}</h3>
                            <p>{{ $value->breif->$lang }}</p>
                        </div>
                    </div>
                @else
                    <div class="col-12 col-sm-6 col-md-4 col-lg">
                        <div class="soliman-values-item wow fadeInUp">
                            <div class="soliman-values-itemimg">
                                <img src="{{url('')}}/uploads/values/{{ $value->image }}" alt="{{ $value->title->$lang }}">
                            </div>
                            <h3>{{ $value->title->$lang }}</h3>
                            <p>{{ $value->breif->$lang }}</p>
                        </div>
                    </div>
                @endif

            @endforeach
        </div>
    </div>
</section>
@endif

<section class="soliman-badge">
    <h1>{{ __('site.about.leaders') }}</h1>
</section>
@php
    $leaders = $managements->where('group', 0);
    $reviewers = $managements->where('group', 1);
@endphp

<section class="soliman-management">
    <div class="container">
        @if(!$leaders->isEmpty())
        <div class="soliman-management-group">
            <h2>{{ __('site.about.ceos') }}</h2>
            <div class="soliman-management-groups">
                <div class="row">
                    @foreach ($leaders as $leader)

                        @if ($leader->by_ocoda_dev == true)
                            <div class="col-6 col-sm-6 col-md-6 col-lg-3 wow  fadeInUp">
                                <div class="soliman-management-item">
                                    <div class="soliman-management-item-img">
                                        <img src="{{url('uploads')}}/{{@$leader->getImagePath('image', $lang)}}" alt="{{@$leader->getImageAlt('image', $lang)}}" title="{{@$leader->getImageTitle('image', $lang)}}">
                                    </div>
                                    <span>{{ $leader->ptitle->$lang }}</span>
                                    <h3>{{ $leader->name->$lang }}</h3>
                                    <h6>{{ $leader->title->$lang }}</h6>
                                </div>
                            </div>
                        @else
                            <div class="col-6 col-sm-6 col-md-6 col-lg-3 wow  fadeInUp">
                                <div class="soliman-management-item">
                                    <div class="soliman-management-item-img">
                                        <img src="{{url('uploads')}}/management/{{ $leader->image }}" alt="{{ $leader->name->$lang }}">
                                    </div>
                                    <span>{{ $leader->ptitle->$lang }}</span>
                                    <h3>{{ $leader->name->$lang }}</h3>
                                    <h6>{{ $leader->title->$lang }}</h6>
                                </div>
                            </div>
                        @endif

                        @if($leader->lst)
                        <div class="col-12"></div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        @endif
        @if(!$reviewers->isEmpty())
        <div class="soliman-management-group">
            <h2>{{ __('site.about.reviewrs') }}</h2>
            <div class="soliman-management-groups">
                <div class="row">
                    @foreach ($reviewers as $reviewer)


                        @if ($reviewer->by_ocoda_dev == true)
                            <div class="col-6 col-sm-6 col-md-6 col-lg-3 wow  fadeInUp">
                                <div class="soliman-management-item">
                                    <div class="soliman-management-item-img">
                                        <img src="{{url('uploads')}}/{{@$reviewer->getImagePath('image', $lang)}}" alt="{{@$reviewer->getImageAlt('image', $lang)}}" title="{{@$reviewer->getImageTitle('image', $lang)}}">
                                    </div>
                                    <span>{{ $reviewer->ptitle->$lang }}</span>
                                    <h3>{{ $reviewer->name->$lang }}</h3>
                                    <h6>{{ $reviewer->title->$lang }}</h6>
                                </div>
                            </div>
                        @else
                            <div class="col-6 col-sm-6 col-md-6 col-lg-3 wow  fadeInUp">
                                <div class="soliman-management-item">
                                    <div class="soliman-management-item-img">
                                        <img src="{{url('uploads')}}/management/{{ $reviewer->image }}" alt="{{ $reviewer->name->$lang }}">
                                    </div>
                                    <span>{{ $reviewer->ptitle->$lang }}</span>
                                    <h3>{{ $reviewer->name->$lang }}</h3>
                                    <h6>{{ $reviewer->title->$lang }}</h6>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        @endif

    </div>
</section>


    @endsection
