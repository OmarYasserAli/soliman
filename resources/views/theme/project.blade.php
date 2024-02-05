@extends('theme.layout')
@section('layout')
    @include('theme.inc.helper')

    @push('head_scripts')
        {{-- Head script for a specific resource --}}
        @include('enhance.theme.partials._headScript', ['model' => $project])
    @endpush

    <section class="soliman-product-about">
        <div class="container">

            @include('enhance.theme.partials._socialMediaButtons')

            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                    <div class="row">
                        <div class="col-12">
                            <div class="soliman-product-about-img wow fadeInDown">
                                @if ($project->by_ocoda_dev == true)
                                    <img src="{{url('uploads')}}/{{@$project->getImagePath('logo', $lang)}}" alt="{{@$project->getImageAlt('logo', $lang)}}" title="{{@$project->getImageTitle('logo', $lang)}}">
                                @else
                                    <img src="{{url('uploads/projects')}}/{{@$project->logo}}" alt="{{@$project->name->$lang}}">
                                @endif
                            </div>
                        </div>
                        @php
                            $companies = [
                                'owner' => (int) @$project->owner,
                                'developer' => (int) @$project->developer,
                                'contractor' => (int) @$project->contractor,
                            ];
                            foreach ($companies as $key => $id) {
                                if ($id) {
                                    $co = App\Models\Company::find($id);
                                    if (!empty($co)) {
                                        $companies[$key] = $co;
                                        $co = null;
                                    }
                                } else {
                                    unset($companies[$key]);
                                }
                            }
                        @endphp
                        @foreach ($companies as $k => $company)
                            <div class="col">
                                <div class="soliman-product-about-owner   wow fadeInRight">
                                    <div class="soliman-product-about-owner-img">
                                        <img src="{{ url('uploads/companies') }}/{{ @$company->image }}"
                                            alt="{{ @$company->title->$lang }}">
                                    </div>
                                    <h3>{{ __('site.projects.comp.' . $k) }}</h3>
                                    <span>{{ @$company->title->$lang }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                    <div class="soliman-product-about-co wow  zoomIn">
                        <h1>{{ @$project->name->$lang }}</h1>
                        <p>{{ @$project->breif->$lang }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="soliman-product-info">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="soliman-product-info-item wow fadeInUp">
                        <p>{{ __('site.sizes.area') }}</p>
                        <h3>{{ @$project->sizes->area }}</h3>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="soliman-product-info-item wow fadeInDown">
                        <p>{{ __('site.sizes.flat') }}</p>
                        <h3>{{ @$project->sizes->flat }}</h3>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="soliman-product-info-item wow fadeInUp">
                        <p>{{ __('site.sizes.units') }}</p>
                        <h3>{{ @$project->sizes->units }}</h3>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="soliman-product-info-item wow fadeInDown">
                        <p>{{ __('site.sizes.value') }}</p>
                        <h3>{{ @$project->sizes->value }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('theme.inc.rgallery', ['galleries' => @$project->gallery, 'folder' => 'projects'])

    @if (@$project->map)
        <section class="soliman-product-map">
            <div class="soliman-product-map-info">
                <h2>{{ __('site.projects.location') }}</h2>

                <a target="_blank" href="{{ @$project->profile }}">{{ __('site.projects.download') }}</a>
            </div>
            <div class="soliman-product-map-co">
                {!! @$project->map !!}
            </div>
        </section>
    @endif

    @include('theme.inc.rprojects', [
        'rprojects' => $rprojects,
        'folder' => 'projects',
        'route' => 'project',
    ])

    @include('theme.inc.sgallery')
@endsection

@push('footer')
        {{-- Footer script for a specific resource --}}
        @include('enhance.theme.partials._footerScript', ['model' => $project])
@endpush

<script>
    window.dataLayer = window.dataLayer || [];
    dataLayer.push({
        'event': 'view_item',
        'project_url': "{{ request()->url() }}",
        'project_name': "{{ @$project->name->$lang || '' }}",
        'language': "{{ $lang }}"
    });
</script>
