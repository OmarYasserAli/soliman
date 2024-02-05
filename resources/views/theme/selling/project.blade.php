@extends('theme.layout')
@section('layout')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css" />
<style>
    .iti {
        width: 100%;
        direction: ltr;
    }

</style>
    <div class="sp-overlay "></div>
<div class="ajax-co"></div>
<div class="selling-project">
    <div class="selling-project-profile">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="row rcenter">
                        <div class="col-4">
                            <div class="spp-logo">
                                <img src="{{url('uploads/sprojects/'.$sproject->logo)}}" alt="{{ $sproject->name->$lang }}"  {{img_err()}}>
                                <span>BY ALSOLIMAN</span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="spp-pid"><span>{{__('site.selling.sproject')}}</span><strong>{{ $sproject->original_id }}</strong></div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="spp-title">
                        <h3>{{ $sproject->name->$lang }}</h3>
                        <div class="spp-title-a">
                            <a href="{{ route('selling.area', @$sproject->area_id) }}">{{ @$sproject->area->name->$lang }}</a>
                            @if(@$sproject->city_id) <i>|</i> @endif
                            <a href="{{ route('selling.city', @$sproject->city_id) }}">{{ @$sproject->city->name->$lang }}</a>
                        </div>
                        <div class="spp-title-stat">
                            @if((int)$sproject->buildings_count)<span>{{__('site.selling.cbuilding')}}<i>{{ (int)$sproject->buildings_count }}</i></span>@endif
                            <span>{{__('site.selling.cunits')}}<i>{{ (int)$sproject->ucount }}</i></span>
                            <span>{{__('site.selling.avunits')}}<i>{{ (int)$sproject->avUnits() }}</i></span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="spp-imgs">
                        @if(!empty(@$sproject->gallery))<a id="gallary-btn" href="#">{{__('site.selling.pgallery')}}</a>@endif
                        @if(!empty(@$sproject->igallery))<a id="igallary-btn" href="#">{{__('site.selling.pigallery')}}</a>@endif
                    </div>
                    <div class="spp-loc">
                        @if($sproject->url360 != '')<a target="_blank" href="{{ $sproject->url360 }}"><i class="c360"></i><span>{!! __('site.selling.tour360') !!}</span></a>@endif
                        @if($sproject->profile != '')<a target="_blank" href="{{ $sproject->profile }}"><i class="profile"></i><span>{!! __('site.selling.profile') !!}</span></a>@endif
                        @if($sproject->location != '')<a target="_blank" href="{{ $sproject->location }}"><i class="loc"></i><span>{!! __('site.selling.location') !!}</span></a>@endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="gallery-hidden">
        @if(!empty(@$sproject->gallery))
        @include('theme.inc.rgallery', ['galleries' => @$sproject->gallery, 'folder' => 'sprojects', 'id' => 'pgallery', 'title' => $sproject->name->$lang])
        @endif
        @if(!empty(@$sproject->igallery))
        @include('theme.inc.rgallery', ['galleries' => @$sproject->igallery, 'folder' => 'sprojects', 'id' => 'igallery', 'title' => $sproject->name->$lang])
        @endif
    </div>

    @if($sproject->type == 0)
    <div class="selling-project-models">
        <div class="container">
            <h2>{{__('site.selling.typeslist')}}</h2>
            <h5>{{__('site.selling.unitstable')}}</h5>
            <div class="spp-mlist">
                @foreach ($types as $type)
                    <a href="#" class="project-btn" data-id="{{$sproject->id}}" data-type="type" data-typeid="{{$type->id}}">{{$type->name->$lang}}</a>
                @endforeach
            </div>
            <span>{{__('site.selling.taxdesc')}}</span>
        </div>
    </div>
    @endif


    <div class="selling-project-items">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-3">
                    @include('theme.selling.box.filter', ['filters' => $filters])
                </div>
                <div class="col-12 col-lg-9">
                    <div class="sp-apartments">
                        <div class="sp-apartments-head">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <h3>{{__('site.selling.advansedsearch')}}</h3>
                                    <h5>{{__('site.selling.searchhint')}}</h5>
                                </div>
                                @if($sproject->type == 0)
                                <div class="col-12 col-lg-6">
                                    <span>{{__('site.selling.selectunitid')}}</span>
                                    <div class="sp-apartments-head-filter">
                                        @foreach ($types as $type)
                                            <a href="#" data-id="{{$type->id}}" >{{$type->name->$lang}}</a>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div><!-- sp-apartments-head -->
                        <div class="sp-apartments-body">
                            <p class="sp-apartments-no">{{__('site.selling.nounits')}}</p>
                            <div class="row">
                                @foreach($units as $unit)
                                @include('theme.selling.box.apartment_item', ['item' => $unit, 'project' => $sproject])
                                @endforeach
                            </div>
                        </div><!-- sp-apartments-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@include('theme.inc.sgallery')
@push('footer')
    <!-- intlTelInput Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.min.js"></script>

    <script>
    $(document).on('click', '.project-btn', function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        var typeid = $(this).attr('data-typeid');
        $.ajax({
            url: '{{ route('selling.project.load') }}',
            type: 'POST',
            data: {
                id: id,
                type: type,
                typeid: typeid,
                _token: "{{csrf_token()}}"
            },
            beforeSend: () => {
                $(document).find('.sp-overlay').addClass('loading').fadeIn(100)
            },
            error: (jqXHR, textStatus, errorThrown)=>{
                $(document).find('.sp-overlay').removeClass('loading').fadeOut(100)
            },
            success: (data)=>{
                if(data.status){
                    $('.ajax-co').html(data.content)
                    $(document).find('.sproject-slick').slick();
                    $(document).find('.sp-overlay').removeClass('loading')

                    var input = document.querySelector("#phoneInput");

                    // Initialize intlTelInput
                    var iti = window.intlTelInput(input, {
                        autoPlaceholder: "polite",
                        initialCountry: "sa",
                        preferredCountries: ['sa', 'ae', 'qa'],
                        separateDialCode: true,
                        nationalMode: false,
                        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
                    });

                    // Listen to the telephone input for changes and update the input value
                    input.addEventListener('countrychange', function() {
                        var fullNumber = iti.getNumber(intlTelInputUtils.numberFormat.E164);
                        input.value = fullNumber; // Update the input value with the full number
                    });

                    input.addEventListener('change', function() {
                        var fullNumber = iti.getNumber(intlTelInputUtils.numberFormat.E164);
                        input.value = fullNumber;
                    });

                    input.addEventListener('keyup', function() {
                        var fullNumber = iti.getNumber(intlTelInputUtils.numberFormat.E164);
                        input.value = fullNumber;
                    });




                }else{
                    $(document).find('.sp-overlay').removeClass('loading').fadeOut(100)
                }
            }
        })

        // $(document).find('.sproject-info').fadeIn(200)
    })
    @if(auth()->guard('seller')->check())
    $(document).on('click', '.unit-update-btn', function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        var target = $(this).attr('data-target');
        var co = $(this).text();
        $.ajax({
            url: '{{ route('seller.unit.update') }}',
            type: 'POST',
            data: {
                id: id,
                target: target,
                _token: "{{csrf_token()}}"
            },
            beforeSend: () => {
                $(this).text('{{__("site.selling.loading")}}')
            },
            error: (jqXHR, textStatus, errorThrown)=>{
                $(this).text(co)
            },
            success: (data)=>{
                if(data.status){
                    alert('تم تحديث الوحدة بنجاح.')
                    location.reload()
                }else{
                    alert('هناك خطأ ما.')
                    $(this).text(co)
                }
            }
        })

        // $(document).find('.sproject-info').fadeIn(200)
    })
    @endif
    $(document).on('click','.sp-overlay, .sproject-close, .sbuilding-close, .closemodal-btn', function(){
        $(document).find('.ajax-co').html('')
        $(document).find('.sp-overlay').fadeOut(200)
    })

    $(document).on('click', '.sp-apartments-head-filter a', function(e){
        e.preventDefault();
        if($(this).hasClass('active')){
            $(this).removeClass('active')
            $('.type-col').fadeIn(100)
            return false;
        }
        $('.sp-apartments-head-filter a').removeClass('active')
        $(this).addClass('active')
        var id = $(this).attr('data-id');
        $('.type-col').show().not('.type-'+id).fadeOut(100);
    });

    $(document).on('submit', '.interest-form', function(e){
        e.preventDefault();
        var frm = $(document).find('.interest-form');
        var data = $(this).serializeArray();

        var errors = false;
        frm.find('input').removeAttr('style')
        var dt = {};
        data.forEach(function(e, i){
            dt[e.name] = e.value;
            if(e.value == ''){
                if(e.name == 'name' || e.name == 'phone' || e.name == 'title' ){
                    errors = true;
                    frm.find('input[name='+e.name+']').attr('style', 'background:#ff000024')
                }
            }
        })
        if(errors == true){
            return false;
        }


        $.ajax({
            url: '{{ route("selling.unit.request") }}',
            type: 'POST',
            data: {
                ...dt,
                _token: "{{csrf_token()}}"
            },
            beforeSend: () => {
                frm.find('button').attr('disabled', true).text('{{__("site.selling.loading")}}')
            },
            error: (jqXHR, textStatus, errorThrown)=>{
                frm.find('button').attr('disabled', false).text('ارسال')
            },
            success: (data)=>{
                if(data.status){
                    frm.find('button').remove()
                    frm.find('input').attr('disabled', true)
                    $(document).find('.ajax-co').html(data.content)
                }else{
                    frm.prepend('<p class="alert-danger">هناك خطأ ما ، برجاء المحاولة لاحقاً.</p>');
                }
                frm.find('button').attr('disabled', false).text('ارسال')
            }
        })
    });
    $('#gallary-btn').on('click', function(e){
        e.preventDefault();
        $('[data-sgallery="pgallery"]').first().trigger('click')
    })
    $('#igallary-btn').on('click', function(e){
        e.preventDefault();
        $('[data-sgallery="igallery"]').first().trigger('click')
    })
    $(document).on('click', '.slider-popup', function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        if(!id){
            return false;
        }
        $(document).find('[data-sgallery="pigallery-'+id+'"]').first().trigger('click')
    })
</script>
@endpush

@endsection
