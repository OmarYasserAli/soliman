<div class="form-group">
    <label class="control-label">{{$title}}</label>
    <div class="custom-image">
        @if(@$val)
        <img src="{{url("uploads/".@$val)}}?time={{time()}}" alt="">
        @else
        <img src="{{url("back-assets/images/placeholder.jpeg")}}" alt="">
        @endif
        <input type="file" name="{{$name}}" onchange="readImgURL(this)">
    </div>
</div>
