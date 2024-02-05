<div class="form-group imagefile-group">
    <label class="control-label">{{$title}}</label>
    <div class="custom-image custom-file">
        @if(@$val)
        <span>{{@$val}}</span>
        @else
        <span>UPLOAD FILE </span>
        @endif
        <input type="file" name="{{$name}}" class="file" onchange="readImgURL(this)">
    </div>
</div>
