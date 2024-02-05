<div class="sbuilding-info">
    <span class="sbuilding-close ">&times;</span>
    <div class="sbuilding-title">
        <h3>{{__('site.selling.buildingp')}} ({{$type->name->$lang}})</h3>
    </div>
    <div class="sbuilding-table">
        <div class="table-responsive">
            <table >
                <thead>
                    <tr>
                        <th>{{__('site.selling.unitid')}}</th>
                        <th>{{__('site.selling.floor')}}</th>
                        <th colspan="2">{!! __('site.selling.spacem2') !!}</th>
                        <th>{{__('site.selling.sprice')}}</th>
                        <th>{{__('site.selling.status')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($type->units()->orderBy('name','asc')->get()  as $unit)
                    <tr class="@if(in_array($unit->status, [0,1])) project-btn @endif" data-id="{{$unit->id}}" data-type="unit">
                        <td class="apbg">{{$unit->name}} </td>
                        <td>{{$unit->floor->name->$lang}}</td>
                        <td>{{$unit->space}}</td>
                        <td>{{$unit->space_acc}}</td>
                        <td><strong>{{$unit->price()}}</strong></td>
                        <td><i class="{{status($unit->status)}}-color">{{status($unit->status, $lang)}}</i></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7"><span class="no-data">{{__('site.selling.nounits')}}</span></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="sbuilding-hint">
        <span>{{__('site.selling.taxdesc')}}</span>
    </div>
    <div class="close-btn-float">
        <button class="btn btn-danger closemodal-btn " data-dismiss="modal">{{ __('site.return_back') }}</button>
    </div>
</div>

