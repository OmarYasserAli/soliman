<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css">


<div class="sproject-info">

    <span class="sproject-label {{status($unit->status)}}-bg">{{status($unit->status, $lang)}}</span>

    <span class="sproject-close ">&times;</span>

    <div class="sproject-info-slider">
        {{-- <i class="slider-popup" data-id="{{$unit->id}}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" height="32"><path d="M160 32c-35.3 0-64 28.7-64 64V320c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H160zM396 138.7l96 144c4.9 7.4 5.4 16.8 1.2 24.6S480.9 320 472 320H328 280 200c-9.2 0-17.6-5.3-21.6-13.6s-2.9-18.2 2.9-25.4l64-80c4.6-5.7 11.4-9 18.7-9s14.2 3.3 18.7 9l17.3 21.6 56-84C360.5 132 368 128 376 128s15.5 4 20 10.7zM256 128c0 17.7-14.3 32-32 32s-32-14.3-32-32s14.3-32 32-32s32 14.3 32 32zM48 120c0-13.3-10.7-24-24-24S0 106.7 0 120V344c0 75.1 60.9 136 136 136H456c13.3 0 24-10.7 24-24s-10.7-24-24-24H136c-48.6 0-88-39.4-88-88V120z"/></svg>
        </i> --}}
        <div class="sproject-slick">
            @if(!empty($gallery=$unit->gallery))
                @foreach($gallery as $g)
                    <div class="sproject-slick-item"><a href="{{url('uploads/units/'.$g)}}"
                                                        data-caption="{{$unit->name}}" data-fancybox="g"><img
                                    src="{{url('uploads/units/'.$g)}}" alt="{{$unit->name}}"></a></div>
                @endforeach
            @endif
        </div>
    </div>

    <div class="sproject-info-data">
        <div class="status-update">
            @if(auth()->guard('seller')->check())
                @if($unit->status != 0)
                    <a href="#" class="unit-update-btn" data-target="sale" data-id="{{$unit->id}}">تحديث الى متاح</a>
                @endif
                @if($unit->status != 1)
                    <a href="#" class="unit-update-btn" data-target="hold" data-id="{{$unit->id}}">تحديث الى محجوزة</a>
                @endif
                @if($unit->status != 2)
                    <a href="#" class="unit-update-btn" data-target="sold" data-id="{{$unit->id}}">تحديث الى مباعة</a>
                @endif
            @endif
            @if(auth()->guard('web')->check())
                <a target="_blank" href="{{ route('units.edit', $unit->id ) }}">تعديل</a>
            @endif
        </div>
        <div class="apartment-item-row">
            <span>{{__('site.selling.unitid')}}</span>
            @if($unit->project->type != 2)
                <span>{{__('site.selling.floor')}}</span>
            @endif
            @if($unit->project->type == 0)
                <span>{{__('site.selling.thetype')}}</span>
            @endif
            <span>{{__('site.selling.space')}}</span>
            <span>{{__('site.selling.rooms')}}</span>
        </div>
        <div class="apartment-item-row">
            <span><strong>{{$unit->name}}</strong></span>
            @if($unit->project->type != 2)
                <span>{{@$unit->floor->name->$lang}}</span>
            @endif
            @if($unit->project->type == 0)
                <span><strong>{{@$unit->type->name->$lang}}</strong></span>
            @endif
            <span><strong>{{$unit->space}}</strong></span>
            <span><strong>{{$unit->rooms}}</strong></span>
        </div>
        <div class="apartment-item-frow">
            {{@$unit->accessories->$lang}}
            <br>
            {{@$unit->specifications->$lang}}
        </div>
        <div class="apartment-item-nprice">
            <div class="price {{status($unit->status)}}-color"><i>{{$unit->price()}}</i>{{__('site.selling.sar')}}</div>
        </div>
    </div>

    <div class="sproject-info-form">
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="text">{!! __('site.selling.reginterset') !!}</div>
            </div>
            <div class="col-12 col-lg-8">
                <form action="" class="interest-form">
                    <input type="text" name="name" placeholder="{{__('site.selling.name')}}">
                    <input id="phoneInput" style="direction: ltr" type="text" name="phone" placeholder="5xxxxxxxx">
                    <input type="text" name="email" placeholder="{{__('site.selling.email')}}">
                    <input type="hidden" name="website_project_id" value="{{$unit->project_id}}">
                    <input type="hidden" name="project_id" value="{{$unit->project->original_id}}">
                    <input type="hidden" name="project_name" value="{{$unit->project->name->$lang}}">
                    <input type="hidden" name="type" value="{{@$unit->type->name->$lang}}">
                    <input type="hidden" name="project_type" value="{{$unit->project->type}}">
                    <input type="hidden" name="unit" value="{{$unit->name}}">
                    <input type="text" name="title" value="{{ptitle($unit, $lang)}}">
                    <input type="hidden" name="ulang" value="{{$lang}}">
                    <button>{{__('site.selling.send')}}</button>
                </form>
            </div>
        </div>
    </div>

</div>


<!-- intlTelInput Plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.min.js"></script>

<!-- Initialization Script -->
<script>

    window.intlTelInput(document.querySelector('#phoneNumber'), {
        autoPlaceholder: true,
        preferredCountries: ['fr', 'us', 'gb']
    });


    $(document).ready(function () {


        //
        //     var prefix = '+9665';
        //     var maxAdditionalDigits = 8;
        //     var $phoneInput = $('#phoneInput');
        //
        //     $phoneInput.val(prefix);
        //
        //     $phoneInput.on('input', function() {
        //         var value = $(this).val();
        //
        //         // Remove non-numeric characters and limit length
        //         var numericValue = value.replace(/[^\d]/g, '').substring(0, prefix.length + maxAdditionalDigits);
        //
        //         // Ensure the prefix and only allow numeric input after the prefix
        //         if (!numericValue.startsWith('9665')) {
        //             $(this).val(prefix);
        //         } else {
        //             $(this).val('+' + numericValue);
        //         }
        //     });
        //
        //     $phoneInput.on('keydown', function(event) {
        //         // Prevent backspace key if only prefix is present
        //         if (this.value === prefix && event.key === 'Backspace') {
        //             event.preventDefault();
        //         }
        //     });


    });

</script>

