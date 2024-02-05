<div class="col-12 col-sm-6 col-md-6 col-xl-4">
    <div class="sp-item">
        <div class="sp-item-head">
            <div class="row">
                <div class="col-7">
                    <h3>{{ @$sproject->name->$lang }}
                        @if(auth()->guard('web')->check())
                        <a target="_blank" href="{{ route('sprojects.edit', $sproject->id ) }}">({{__('site.selling.edit')}})</a>
                        @endif
                    </h3>
                    <div class="sp-item-head-a">
                        <a>{{ @$sproject->area->name->$lang }}</a>
                        @if(@$sproject->city_id) <i>|</i> @endif
                        <a>{{ @$sproject->city->name->$lang }}</a>
                    </div>
                </div>

                <div class="col-5 row">
                    <div class="sp-item-head-stat col-5" >
                        <span>{{__('site.selling.sproject')}}</span>
                        <strong>{{ $sproject->original_id }}</strong>
                    </div>

                    <div class="sp-item-head-stat col-6" style="border-right: 1px solid #ccc; margin-right:10px ">


                        <strong >{{ $sproject->ucount }}</strong>
                        <span >{{__('site.selling.runit')}} </span>

                    </div>
                </div>
            </div>
        </div>
        <a @if($sproject->status == 0) href="{{ route('selling.project', (string)$sproject->slug) }}" @endif class="sp-item-body">
            <span><em>{{ (int)$sproject->avUnits() }}</em> {{__('site.selling.avunits_new')}}</span>
            <i class="{{status($sproject->status)}}"></i>
            <img src="{{ $sproject->cover() }}"  class="{{status($sproject->status)}}-img" alt="{{ $sproject->name->$lang }}" {{img_err()}}>
        </a>

        {{-- <a @if($sproject->status == 0) href="{{ route('selling.project', (string)$sproject->slug) }}" @endif class="sp-item-body">
            <span><em>{{ (int)$sproject->avUnits() }}</em> {{__('site.selling.avunits')}}</span>
            <i class="{{status($sproject->status)}}"></i>
            <img src="{{ $sproject->cover() }}"  class="{{status($sproject->status)}}-img" alt="{{ $sproject->name->$lang }}" {{img_err()}}>
        </a> --}}
    </div>
</div>
