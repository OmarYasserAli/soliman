<section class="soliman-media-nav">
    <a @if(Route::is('news')) class="active" @endif href="{{ route('news') }}">{{__('site.nav.news')}}</a>
    <a @if(Route::is('events')) class="active" @endif href="{{ route('events') }}">{{__('site.nav.events')}}</a>
    <a @if(Route::is('files')) class="active" @endif href="{{ route('files') }}">{{__('site.nav.files')}}</a>
</section>
