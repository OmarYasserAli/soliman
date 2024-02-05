@extends('theme.layout')
@section('layout')
@include('theme.inc.helper')

@push('head_scripts')
    {{-- Head script for a specific resource --}}
    @include('enhance.theme.partials._headScript', ['model' => $product])
@endpush

<section class="soliman-product-about">
    <div class="container">

        @include('enhance.theme.partials._socialMediaButtons')

        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-3">
                <div class="row">
                    <div class="col-12">
                        <div class="soliman-product-about-img wow fadeInDown">
                            @if ($product->by_ocoda_dev == true)
                                <img src="{{url('uploads')}}/{{@$product->getImagePath('logo', $lang)}}" alt="{{@$product->getImageAlt('logo', $lang)}}" title="{{@$product->getImageTitle('logo', $lang)}}">
                            @else
                                <img src="{{url('uploads/products')}}/{{@$product->logo}}" alt="{{@$product->name->$lang}}">
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-9">
                <div class="soliman-product-about-co wow  zoomIn">
                    <h1>{{ @$product->name->$lang }}</h1>
                    <p>{{ @$product->breif->$lang }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="soliman-product-features">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-3">
                <div class="soliman-product-features-size">
                    <span>{{__('site.products.landsize')}}</span>
                    <strong>{{ $product->land_size }}</strong>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-9">
                <div class="soliman-product-features-co">
                    <h3>{{ __('site.products.features')}}</h3>
                    <div class="row">
                        @include('theme.inc.features', ['list' => @$product->features])
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="soliman-product-guarantee">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-3">
                <div class="soliman-product-guarantee-links">
                    <div class="row">
                        <div class="col-6 col-sm-6 col-md-12 col-mg-12">
                            <div class="soliman-product-guarantee-links-item"><a target="_blank" href="{{ @$product->profile }}"><svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 256 512" class="svg-inline--fa fa-long-arrow-down fa-w-8"><path fill="currentColor" d="M252.485 343.03l-7.07-7.071c-4.686-4.686-12.284-4.686-16.971 0L145 419.887V44c0-6.627-5.373-12-12-12h-10c-6.627 0-12 5.373-12 12v375.887l-83.444-83.928c-4.686-4.686-12.284-4.686-16.971 0l-7.07 7.071c-4.686 4.686-4.686 12.284 0 16.97l116 116.485c4.686 4.686 12.284 4.686 16.971 0l116-116.485c4.686-4.686 4.686-12.284-.001-16.97z" class=""></path></svg></a><span>{{__('site.products.profile')}}</span></div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-12 col-mg-12">
                            <div class="soliman-product-guarantee-links-item"><a target="_blank" href="{{ @$product->f360 }}"><svg version="1.1" id="Layer_1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px"
         viewBox="0 0 480 480" style="enable-background:new 0 0 480 480;" xml:space="preserve">
    <g>
        <g>
            <g>
                <path d="M391.502,210.725c-5.311-1.52-10.846,1.555-12.364,6.865c-1.519,5.31,1.555,10.846,6.864,12.364
                    C431.646,243.008,460,261.942,460,279.367c0,12.752-15.51,26.749-42.552,38.402c-29.752,12.82-71.958,22.2-118.891,26.425
                    l-40.963-0.555c-0.047,0-0.093-0.001-0.139-0.001c-5.46,0-9.922,4.389-9.996,9.865c-0.075,5.522,4.342,10.06,9.863,10.134
                    l41.479,0.562c0.046,0,0.091,0.001,0.136,0.001c0.297,0,0.593-0.013,0.888-0.039c49.196-4.386,93.779-14.339,125.538-28.024
                    C470.521,316.676,480,294.524,480,279.367C480,251.424,448.57,227.046,391.502,210.725z"/>
                <path d="M96.879,199.333c-5.522,0-10,4.477-10,10c0,5.523,4.478,10,10,10H138v41.333H96.879c-5.522,0-10,4.477-10,10
                    s4.478,10,10,10H148c5.523,0,10-4.477,10-10V148c0-5.523-4.477-10-10-10H96.879c-5.522,0-10,4.477-10,10s4.478,10,10,10H138
                    v41.333H96.879z"/>
                <path d="M188.879,280.667h61.334c5.522,0,10-4.477,10-10v-61.333c0-5.523-4.477-10-10-10h-51.334V158H240c5.523,0,10-4.477,10-10
                    s-4.477-10-10-10h-51.121c-5.523,0-10,4.477-10,10v122.667C178.879,276.19,183.356,280.667,188.879,280.667z M198.879,219.333
                    h41.334v41.333h-41.334V219.333z"/>
                <path d="M291.121,280.667h61.334c5.522,0,10-4.477,10-10V148c0-5.523-4.478-10-10-10h-61.334c-5.522,0-10,4.477-10,10v122.667
                    C281.121,276.19,285.599,280.667,291.121,280.667z M301.121,158h41.334v102.667h-41.334V158z"/>
                <path d="M182.857,305.537c-3.567-4.216-9.877-4.743-14.093-1.176c-4.217,3.567-4.743,9.876-1.177,14.093l22.366,26.44
                    c-47.196-3.599-89.941-12.249-121.37-24.65C37.708,308.06,20,293.162,20,279.367c0-16.018,23.736-33.28,63.493-46.176
                    c5.254-1.704,8.131-7.344,6.427-12.598c-1.703-5.253-7.345-8.13-12.597-6.427c-23.129,7.502-41.47,16.427-54.515,26.526
                    C7.674,252.412,0,265.423,0,279.367c0,23.104,21.178,43.671,61.242,59.48c32.564,12.849,76.227,21.869,124.226,25.758
                    l-19.944,22.104c-3.7,4.1-3.376,10.424,0.725,14.123c1.912,1.726,4.308,2.576,6.696,2.576c2.731,0,5.453-1.113,7.427-3.301
                    l36.387-40.325c1.658-1.837,2.576-4.224,2.576-6.699v-0.764c0-2.365-0.838-4.653-2.365-6.458L182.857,305.537z"/>
                <path d="M381.414,137.486h40.879c5.522,0,10-4.477,10-10V86.592c0-5.523-4.478-10-10-10h-40.879c-5.522,0-10,4.477-10,10v40.894
                    C371.414,133.009,375.892,137.486,381.414,137.486z M391.414,96.592h20.879v20.894h-20.879V96.592z"/>
            </g>
        </g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg></a><span>{{__('site.products.p360')}}</span></div>
                        </div>

                        </div>
                    </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-9">
                <div class="soliman-product-features-co">
                    <h3>{{ __('site.products.guarntee')}}</h3>
                    <div class="row">
                        @include('theme.inc.features', ['list' => @$product->garuntees])
                    </div>
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
                    <p>{{__('site.sizes.area')}}</p>
                    <h3>{{ @$product->sizes->area }}+</h3>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <div class="soliman-product-info-item wow fadeInDown">
                    <p>{{__('site.sizes.flat')}}</p>
                    <h3>{{ @$product->sizes->flat }}+</h3>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <div class="soliman-product-info-item wow fadeInUp">
                    <p>{{__('site.sizes.units')}}</p>
                    <h3>{{ @$product->sizes->units }}+</h3>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                <div class="soliman-product-info-item wow fadeInDown">
                    <p>{{__('site.sizes.value')}}</p>
                    <h3>{{ @$product->sizes->value }}+</h3>
                </div>
            </div>
        </div>
    </div>
</section>

@include('theme.inc.rgallery', ['galleries' => @$product->gallery, 'folder' => 'products'])


<section class="soliman-product-owners">
    <div class="container">
        <div class="row">
        <div class="col-12 col-sm-12 col-md-2 col-lg-2"></div>
        @php
                $companies = [
                    'owner' => (int)@$product->owner,
                    'developer' => (int)@$product->developer,
                    'contractor' => (int)@$product->contractor
                ];
                foreach ($companies as $key => $id) {
                    if($id){
                        $co = App\Models\Company::find($id);
                        if(!empty($co)){
                            $companies[$key] = $co;
                            $co=null;
                        }
                    }else{
                        unset($companies[$key]);
                    }
                }
            @endphp
            @foreach ($companies as $k=>$company)

            @if ($company->by_ocoda_dev == true)
                <div class="col">
                    <div class="soliman-product-about-owner   wow fadeInRight">
                        <div class="soliman-product-about-owner-img">
                            <img src="{{url('uploads')}}/{{@$company->getImagePath('image', $lang)}}" alt="{{@$company->getImageAlt('image', $lang)}}" title="{{@$company->getImageTitle('image', $lang)}}">
                        </div>
                        <h3>{{__('site.projects.comp.'.$k)}}</h3>
                        <span>{{@$company->title->$lang}}</span>
                    </div>
                </div>
            @else
                <div class="col">
                    <div class="soliman-product-about-owner   wow fadeInRight">
                        <div class="soliman-product-about-owner-img">
                            <img src="{{url('uploads/companies')}}/{{@$company->image}}" alt="{{@$company->title->$lang}}">
                        </div>
                        <h3>{{__('site.projects.comp.'.$k)}}</h3>
                        <span>{{@$company->title->$lang}}</span>
                    </div>
                </div>
            @endif


            @endforeach
        <div class="col-12 col-sm-12 col-md-2 col-lg-2"></div>
        </div>
    </div>
</section>

@if(@$product->map)
<section class="soliman-product-map">
    <div class="soliman-product-map-info">
        <h2>{{ __('site.projects.location')}}</h2>
    </div>
    <div class="soliman-product-map-co">
        {!! @$product->map !!}
    </div>
</section>
@endif

@include('theme.inc.rprojects', ['rprojects' => $rproducts, 'folder' => 'products', 'route' => 'product'])

@include('theme.inc.sgallery')

@endsection

@push('footer')
        {{-- Footer script for a specific resource --}}
        @include('enhance.theme.partials._footerScript', ['model' => $product])
@endpush

<script>
    window.dataLayer = window.dataLayer || [];
    dataLayer.push({
        'event': 'view_item',
        'product_url': "{{ request()->url() }}",
        'product_name': "{{ @$product->name->$lang }}",
        'language': "{{ $lang }}"
    });
</script>
