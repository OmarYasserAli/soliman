<div class="switch-form">
    <div class="switch-form-head">
        <span data-lng="ar" class="active">Arabic</span>
        <span data-lng="en">English</span>
    </div>
    <div class="switch-form-body">
        <div class="form-group">
        <label class="control-label">{!! $title !!}</label>
        <div class="switch-form-item switch-form-item-ar">
            <input type="text" class="form-control" value="{{ old($name.'.en',@$arval) }}" name="{{$name}}[ar]">
        </div>
        <div class="switch-form-item switch-form-item-en">
            <input type="text" class="form-control" value="{{ old($name.'.ar',@$enval) }}" name="{{$name}}[en]" >
        </div>
        </div>
    </div>
</div>
