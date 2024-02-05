@extends('theme.layout')
@section('layout')

@push('head_scripts')
    {{-- Head script for a specific resource --}}
    @include('enhance.theme.partials._headScript', ['model' => $post])
@endpush

<section class="soliman-molhem-content">
    <div class="container">

        <div class="soliman-molhem-content-co">
            {!! $post->content->$lang !!}
        </div>
        @include('theme.inc.share', ['post' => $post])
    </div>
</section>

@endsection

@push('footer')
        {{-- Footer script for a specific resource --}}
        @include('enhance.theme.partials._footerScript', ['model' => $post])
@endpush
