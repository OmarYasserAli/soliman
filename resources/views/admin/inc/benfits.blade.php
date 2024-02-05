<div class="col-md-12">
    <div class="benfits">
        <h3>{{$label}}</h3>
        <div class="benfits-co">
            @if(!empty($results))
            @foreach($results as $result)
            <div class="benfit"><input name="{{$name}}[]" type="text" value="{{$result}}" placeholder="Text Here"> <i class="fa fa-times"></i></div>
            @endforeach
            @endif
        </div>
        <button type="button" class=" benfit-btn btn btn-info">Add Item</button>
    </div>
</div>

@push('script')
$('.benfit i').on('click', function(){
    $(this).closest('.benfit').remove()
})
$('.benfit-btn').on('click', function(){
    $('.benfits-co').append('<div class="benfit"><input name="{{$name}}[]" type="text" placeholder="Text Here"> <i class="fa fa-times"></i></div>')
})
@endpush
