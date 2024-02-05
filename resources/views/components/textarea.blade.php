<div class="switch-form">
    <div class="switch-form-head">
        <span data-lng="ar" class="active">Arabic</span>
        <span data-lng="en">English</span>
    </div>
    <div class="switch-form-body">
        <div class="form-group">
        <label class="control-label">{!! $title !!}</label>
        <div class="switch-form-item switch-form-item-ar">
            <textarea name="{{$name}}[ar]" class="form-control editor">{!! old($name.'.ar',@$arval) !!}</textarea>
        </div>
        <div class="switch-form-item switch-form-item-en">
            <textarea name="{{$name}}[en]" class="form-control editor">{!! old($name.'.en',@$enval) !!}</textarea>
        </div>
        </div>
    </div>
</div>
