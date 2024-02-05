@php
    $features = config('features');
@endphp
@foreach ($features as $fk => $feature)
    @php
        if(!in_array($fk, (array)$list)){
            continue;
        }
    @endphp
    <div class="col-6 col-sm-6 col-md-3 col-lg">
        <div class="feature-item"><i style="background-image: url('{{url('theme/images/icons/'.@$feature['icon'])}}')"></i><span>{{ @$feature[$lang] }}</span></div>
    </div>
@endforeach
