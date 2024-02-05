{{-- @isset ($result->by_ocoda_dev) --}}
@if (isset($result->by_ocoda_dev) || !isset($result))

    {{-- BEGIN IMAGE FILES SECTION --}}
    <div class="col-md-6">
        <x-image title="{{ucfirst($key)}} AR" name="{{$key}}_ar" val="{!! !empty($img=@$result->imageDetails->image_details[$key]['path']['ar']) ? $img : '' !!}" />
    </div>
    <div class="col-md-6">
        <x-image title="{{ucfirst($key)}} EN" name="{{$key}}_en" val="{!! !empty($img=@$result->imageDetails->image_details[$key]['path']['en']) ? $img : '' !!}" />
    </div>
    {{-- END IMAGE FILES SECTION --}}

    {{-- BEGIN IMAGE DETAILS SECTION --}}
    <div class="col-md-12">
        <x-input title="{{ucfirst($key)}} Name" name="{{$key}}_name" arval="{!! @$result->imageDetails->image_details[$key]['name']['ar'] !!}" enval="{!! @$result->imageDetails->image_details[$key]['name']['en'] !!}" />
    </div>
    <div class="col-md-12">
        <x-input title="{{ucfirst($key)}} Title" name="{{$key}}_title" arval="{!! @$result->imageDetails->image_details[$key]['title']['ar'] !!}" enval="{!! @$result->imageDetails->image_details[$key]['title']['en'] !!}" />
    </div>
    <div class="col-md-12">
        <x-input title="{{ucfirst($key)}} Alt" name="{{$key}}_alt" arval="{!! @$result->imageDetails->image_details[$key]['alt']['ar'] !!}" enval="{!! @$result->imageDetails->image_details[$key]['alt']['en'] !!}" />
    </div>
    {{-- END IMAGE DETAILS SECTION --}}

@else

    <div class="col-md-12">
        <x-image title="{{ucfirst($key)}}" name="{{$key}}" val="{!! !empty($img=@$result->$key) ? $result->filesPath . '/'.$img : '' !!}" />
    </div>
    
@endisset
