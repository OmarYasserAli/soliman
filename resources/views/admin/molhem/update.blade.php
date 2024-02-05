@extends('admin.layout')

@section('body')

<!-- Row -->
<div class="row">
  <div class="col-lg-12">
      <div class="card card-outline-info">
          <div class="card-block">
              <form action="{{ @$update ? route($route.'.update', @$result->id) : route($route.'.store') }}" method="post" enctype="multipart/form-data" >
                @csrf
                @if(@$update) @method('PUT') @endif
                  <div class="form-body">

                      <div class="row p-t-20">

                        <div class="col-md-12">
                            <x-input title="Category" name="cat" arval="{!! @$result->cat->ar !!}" enval="{!! @$result->cat->en !!}" />
                        </div>

                        <div class="col-md-12">
                            <x-input title="Title" name="title" arval="{!! @$result->title->ar !!}" enval="{!! @$result->title->en !!}" />
                        </div>

                        <div class="col-md-12">
                            <x-breif title="Breif" name="breif" arval="{!! @$result->breif->ar !!}" enval="{!! @$result->breif->en !!}" />
                        </div>

                        <div class="col-md-12">
                            <x-textarea title="Content" name="content" arval="{!! @$result->content->ar !!}" enval="{!! @$result->content->en !!}" />
                        </div>

                        @foreach ( (new App\Models\Molhem)->getModelUniqueImageToFormInputNames() as $key)
                            @include('enhance.admin.partials._imageDetails', ['key' => $key])
                        @endforeach

                        @if ((new App\Models\Molhem)->hasSeoTools)
                            @include('enhance.admin.partials._seotools')
                        @endif

                        @if ((new App\Models\Molhem)->hasScripts)
                            @include('enhance.admin.partials._headerAndFooterScripts')
                        @endif

                    </div><!--/row-->

                  <div class="form-actions">
                      <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> {{ @$update ? 'Update' : 'Add' }}</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div></div>
<!-- Row -->
<script src="{{url('back-assets')}}/tinymce/tinymce.min.js"></script>
<script>
    var edstyle = 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px } .tox-editor-header{top:73px}.media-post-gallery{width:100%;overflow:hidden;background:#f1f1f1}.media-post-gallery {display:inline-block;overflow: hidden;border: 5px solid #ececec;text-align: center; margin-bottom: 15px;border-radius:10px }.media-post-gallery img {margin:15px;max-width:150px;height:auto;border: 3px solid #ddd;}';

    tinymce.init({
        directionality : "rtl",
        selector: '.editor',
        content_style: edstyle,
        min_height: 500,
        statusbar: false,
        relative_urls : false,
        remove_script_host : false,
        convert_urls : true,
        object_resizing : true,
        menubar:false,
        plugins: [
            'advlist autolink lists link charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime table paste code wordcount directionality autoresize noneditable'
        ],
        toolbar1: 'undo redo | formatselect | ' +
            'bold italic forecolor backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist | ' +
            'removeformat | outdent indent | wordcount code fullscreen',
        toolbar2: "ltr rtl | customDateButton | customMediaButton customcompareImageButton customfixImageButton customInfogramButton | customvideoButton customyvideoButton customTwitterButton | customYoastButton customQuoteButton link image",

    });
</script>
@endsection
