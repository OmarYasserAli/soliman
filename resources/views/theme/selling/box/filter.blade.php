<i class="sp-filter-filter"></i>

<div class="sp-filter">
    <i class="sp-filter-close"></i>
    <div class="sp-filter-item">
        <h3>{{__('site.selling.price')}}</h3>
        <div class="sp-filter-item-co pricesc">
            <div class="filter-checkbox">
                <input type="checkbox" name="prices[]" value=".price_min">
                <i></i>
                <span>{{__('site.selling.mint')}} 1,000,000</span>
            </div><!-- item -->
            <div class="filter-checkbox">
                <input type="checkbox" name="prices[]" value=".price_max">
                <i></i>
                <span>{{__('site.selling.maxt')}} 1,000,000</span>
            </div><!-- item -->
        </div>
    </div><!-- item -->
    <div class="sp-filter-item statusc">
        <h3>{{__('site.selling.status')}}</h3>
        <div class="sp-filter-item-co">
            @foreach ($filters['status'] as $st)
            <div class="filter-checkbox"><input type="checkbox" name="status[]" value="{{$st['value']}}"><i></i><span>{{@$st[$lang]}}</span></div><!-- item -->
            @endforeach
        </div>
    </div><!-- item -->
    <div class="sp-filter-item">
        <h3>{{__('site.selling.floor')}}</h3>
        <div class="sp-filter-item-co floorsc">
            @foreach ($filters['floors'] as $floor)
            <div class="filter-checkbox"><input type="checkbox" name="floors[]" value="{{$floor['value']}}"><i></i><span>{{$floor[$lang]}}</span></div><!-- item -->
            @endforeach
        </div>
    </div><!-- item -->
    <div class="sp-filter-item">
        <h3>{{__('site.selling.crooms')}}</h3>
        <div class="sp-filter-item-co roomsc">
            @foreach ($filters['rooms'] as $room)
            <div class="filter-checkbox"><input type="checkbox" name="rooms[]" value="{{$room['value']}}"><i></i><span>{{$room[$lang]}}</span></div><!-- item -->
            @endforeach
        </div>
    </div><!-- item -->
</div>


@push('footer')
<script>
    $('.sp-filter-item input').on('change', ()=>{
        let classes = [];
        var checks = $('.sp-filter-item input:checked');
        checks.each(function(i, e){
            $('.apartment-col').hide();
            classes.push($(e).val())
            console.log(classes.toString());
            $(classes.toString()).fadeIn(100);
        })
        if(checks.length == 0){
            $('.apartment-col').fadeIn(100);
        }
        if($('.apartment-col:visible').length == 0){
            $('.sp-apartments-no').fadeIn(0)
        }else{
            $('.sp-apartments-no').fadeOut(0)
        }
    });
    $('.sp-filter-close').on('click', function(){
        $('.sp-filter').fadeOut(300)
    })
    $('.sp-filter-filter').on('click', function(){
        $('.sp-filter').fadeIn(300)
    })
</script>
@endpush