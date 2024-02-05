@include('theme.inc.header')
@yield('layout')
@if(@$blue)
    @include('theme.inc.blue-footer')
@else
    @include('theme.inc.footer')
@endif
@yield('ajs')
