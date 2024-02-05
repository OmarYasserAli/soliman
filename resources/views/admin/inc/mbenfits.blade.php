<div class="col-md-12">
    <div class="benfits">
        <h3>Benefits</h3>
        <div class="benfits-co">
            @if(!empty($results))
            @php $i=0 @endphp
            @foreach($results as $result)
            <div class="benfit">
                <i class="fa fa-times"></i>
                <textarea name="{{$name}}[{{$i}}][k]"  placeholder="Title Here">{{@$result->k}}</textarea>
                <textarea name="{{$name}}[{{$i}}][v]"  placeholder="Content Here">{{@$result->v}}</textarea>
            </div>
            @php $i++; @endphp
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
    var len = $(this).closest('.benfits').find('.benfit').length;
    $('.benfits-co').append('<div class="benfit"><i class="fa fa-times"></i><textarea name="{{$name}}['+len+'][k]"  placeholder="Title Here"></textarea><textarea name="{{$name}}['+len+'][v]"  placeholder="Content Here"></textarea> </div>')
})
@endpush
