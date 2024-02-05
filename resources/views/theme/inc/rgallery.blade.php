@if(!empty($galleries))
<section class="soliman-product-gallery">
    <div class="container">
        <div class="row">
            @foreach ($galleries as $gallery)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <a class="wow zoomIn" data-sgallery="{{$id ?? $folder}}" title="{{$title ?? @$project->name->$lang}}" href="{{url('uploads/'.$folder)}}/{{$gallery}}"><img src="{{url('uploads/'.$folder)}}/{{$gallery}}" alt="{{$title ?? @$project->name->$lang}}"></a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
