<section class="soliman-about">
    <div class="container wow fadeInDown">
        <h1>{!! render(@$set->amtitle->$lang) !!}</h1>
        <p>{!! render(@$set->breif->$lang) !!}</p>
    </div>
</section>


<section class="soliman-vision">
    <div class="container">
        <div class="row wow fadeInUp">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                <div class="soliman-vision-item">
                    <h2>{{ __('site.about.vision') }}</h2>
                    <p>{!! render(@$set->vision->$lang) !!}</p>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                <div class="soliman-vision-item">
                    <h2>{{ __('site.about.message') }}</h2>
                    <p>{!! render(@$set->mission->$lang) !!}</p>
                </div>
            </div>
        </div>
    </div>
</section>
