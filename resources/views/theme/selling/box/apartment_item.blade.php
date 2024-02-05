<div class="col-12 col-lg-6 apartment-col type-col type-{{@$item->type->id}} rooms-{{$item->rooms}} floors-{{$item->floor_id}} status-{{$item->status}} {{$item->price_class}}">
    <div class="apartment-item @if(in_array($item->status, [0,1])) project-btn @else @if(auth()->check()) project-btn @endif @endif" data-id="{{$item->id}}" data-type="unit">
        <div class="apartment-item-row">
            <span>{{__('site.selling.unitid')}}</span>
            @if(!empty($item->floor) && $project->type != 2)
            <span>{{__('site.selling.floor')}}</span>
            @endif
            @if($project->type == 0)
            <span>{{__('site.selling.thetype')}}</span>
            @endif
            <span>{{__('site.selling.space')}}</span>
            <span>{{__('site.selling.rooms')}}</span>
        </div>
        <div class="apartment-item-row">
            <span><strong>{{$item->name}}</strong></span>
            @if(!empty($item->floor) && $project->type != 2)
            <span>{{$item->floor->name->$lang}}</span>
            @endif
            @if($project->type == 0)
            <span><strong>{{@$item->type->name->$lang}}</strong></span>
            @endif
            <span><strong>{{$item->space}}</strong></span>
            <span><strong>{{$item->rooms}}</strong></span>
        </div>
        <div class="apartment-item-frow">
            {{@$item->accessories->$lang}}
            <br>
            {{@$item->specifications->$lang}}

        </div>
        <div class="apartment-item-trow">
            <div class="row">
                <div class="col-6">
                    <span class="{{status($item->status)}}-bg">{{status($item->status,$lang)}}</span>
                </div>
                <div class="col-6">
                    <div class="price {{status($item->status)}}-color"><i>{{$item->price()}}</i>{{__('site.selling.sar')}}</div>
                </div>
            </div>
        </div>
    </div>
</div>