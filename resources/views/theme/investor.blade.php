@extends('theme.layout')
@section('layout')
    <section class="soliman-investment-list">
        <div class="container">
            @foreach ($groups as $group)
                @if(!$group->childs->isEmpty())
                <div class="soliman-investment-group">
                    <h2>{{ $group->title->$lang }}</h2>
                    <div class="soliman-investment-group-co">
                        <div class="row">
                            @foreach ($group->childs as $child)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <a data-id="soliman-investment-item-{{$child->id}}" class="soliman-investment-item wow fadeInUp @if(!$child->childs->isEmpty()) has-sub  @endif" href="{{ $child->url }}"><span>{{ $child->title->$lang }}</span></a>
                            </div>
                            @endforeach


                        </div>
                    </div>
                    <div class="soliman-investment-group-store">
                        @foreach ($group->childs as $child)
                        @if(!$child->childs->isEmpty())
                            <div class="soliman-investment-group-store-item wow fadeInUp" id="soliman-investment-item-{{$child->id}}">
                                <div class="row">
                                    @foreach ($child->childs as $ch)
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                        <a href="{{ $ch->url }}" data-id="soliman-investment-item-{{$ch->id}}" class="soliman-investment-item wow fadeInUp"><span>{{ $ch->title->$lang }}</span></a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @endforeach

                    </div>
                </div>
                @endif
            @endforeach

        </div>
    </section>

@endsection
