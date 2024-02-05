<?php $i = $i ?? 1 ?>
<div class="col-md-12">
<div class="gallery-list">
    <h3>{{$title ?? 'Gallery'}}</h3>
    <div class="gallery-co gallery-co{{$i}}">
        @if(!empty($results))
        @foreach($results as $result1)
        <div class="gallery-item gallery-item{{$i}}">
            <i class="fa fa-times"></i>
            <img src="{{url($folder.$result1)}}">
            <input type="hidden" name="{{$name}}[old][]" value="{{$result1}}">
        </div>
        @endforeach
        @endif
    </div>
    <button type="button" class=" gallery-btn gallery-btn{{$i}} btn btn-info">Add Item</button>
</div>
</div>

@push('script')
    $('.gallery-btn{{$i}}').on('click', function(){
        $('.gallery-co{{$i}}').find('.{{$name}}_flush').remove()
        $('.gallery-co{{$i}}').append('<div class="gallery-item gallery-item{{$i}}"><i class="fa fa-times"></i><input name="{{$name}}[new][]" class="gallery" onchange="readImgURL(this)" type="file"></div>')
    })
    $(document).on('click', '.gallery-item{{$i}} i', function(){
        $(this).closest('.gallery-item{{$i}}').remove()
        var ln = $('.gallery-item{{$i}}').length;
        if(ln == 0){
            $('.gallery-co{{$i}}').append('<input type="hidden" name="{{$name}}[flush]" class="{{$name}}_flush">')
        }
    })
@endpush
