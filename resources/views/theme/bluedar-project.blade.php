@extends('theme.layout')
@section('title_txt') - {{ trans('site.bluedar') }} @endsection
@section('layout')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css">


    <style>
        @media (max-width: 600px) {
            header.inside .soliman-navc {
                background-color: #2F2F63;
            }
        }

        .iti {
            width: 100%;
            direction: ltr;
        }

        {{--@font-face {--}}
        {{--    font-family: 'harir-regular';--}}
        {{--    src: url('{{url("")}}/theme/images/blue/harir-regular.ttf');--}}
        {{--    font-display: swap;--}}
        {{--    font-weight: 400;--}}
        {{--}--}}

        {{--@font-face {--}}
        {{--    font-family: 'harir-bold';--}}
        {{--    src: url('{{url("")}}/theme/images/blue/harir-bold.ttf');--}}
        {{--    font-display: swap;--}}
        {{--    font-weight: 400;--}}
        {{--}--}}

        body {
            background-color: #F2F0EE;
            /*font-family: 'harir-regular';*/

        }

        h1, h2, h3, h4, h5, h6 {
            /*font-family: 'harir-bold';*/
        }

        footer {
            background-color: #2F2F63 !important;
        }

        .intro {
            padding: 30px 0;
            text-align: center;
        }

        .blue-d-logo {
            position: absolute;
            left: 0;
            right: 0;
            margin: auto;
            bottom: 40px;
            max-width: 100px;
            height: auto !important;
            z-index: 10;
            display: none;
        }

        .blue-d-logo2 {
            display: flex;
            align-items: center;
            justify-content: center;
            padding-bottom: 40px;
        }

        .blue-d-logo2 {
            width: 100%;
        }

        .name-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            padding-bottom: 40px;

        }

        .name-logo img {
            width: auto;
            max-width: 100%;
        }

        .intro h2 {
            font-size: 46px;
            margin-bottom: 5px;
            color: #2F2F63;
        }

        .intro p {
            font-size: 21px;
            line-height: 29px;
            color: #666;
            width: auto;
            margin: auto;
            margin-bottom: 20px;
        }

        .intro-icon {
            margin-bottom: 25px;
        }

        .intro-icon img {
            width: 80px;
        }

        .intro-icon h3 {
            font-size: 25px;
            font-weight: normal;
            /*font-family: 'harir-regular';*/
            color: #58595B;
            text-align: center;
        }

        .intro-img {
            height: 630px;
            width: 100%;
            background: url('{{url("uploads/".@$set->bluedar_about_image)}}') no-repeat;
            background-position: center;
            background-size: cover;
            position: relative;
        }

        .intro-img:after {
            position: absolute;
            left: 0;
            top: 0;
            z-index: 5;
            width: 100%;
            height: 100%;
            content: '';
            /* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#f2f0ed+0,f2f0ed+20,ffffff+100&1+0,0+20,0+100 */
            background: -moz-linear-gradient(top, rgba(242, 240, 237, 1) 0%, rgba(242, 240, 237, 0) 20%, rgba(255, 255, 255, 0) 100%); /* FF3.6-15 */
            background: -webkit-linear-gradient(top, rgba(242, 240, 237, 1) 0%, rgba(242, 240, 237, 0) 20%, rgba(255, 255, 255, 0) 100%); /* Chrome10-25,Safari5.1-6 */
            background: linear-gradient(to bottom, rgba(242, 240, 237, 1) 0%, rgba(242, 240, 237, 0) 20%, rgba(255, 255, 255, 0) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f2f0ed', endColorstr='#00ffffff', GradientType=0); /* IE6-9 */

        }

        .blue-design {
            background: #2F2F63;
            padding: 15px 0;
        }

        .blue-design h2 {
            color: #fff;
            text-align: center;
        }

        .blue-design-img {
            width: 100%;
            overflow: hidden;
        }

        .blue-design-img img {
            width: 100%;
        }

        .bgitem img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .bgitem {
            width: 300px;
            height: 300px;
            margin-bottom: 30px !important;
            margin: auto;
        }

        .blue-design-gallery {
            padding: 25px 0;
        }

        .interests-right img {
            width: 100%;
        }

        .blue-interests {
            background: #EC8460;
            padding: 20px;
            margin: 0;
        }

        .blue-interests .col-12 {
            padding: 0;
        }

        .interests-right-top img {
            width: 80px;
        }

        .blue-interests-form {
            margin: 0;
        }

        .blue-interests-form label {
            display: block;
            color: #fff;
            font-size: 12px;
            margin-bottom: 5px;
        }

        .blue-interests-form input {
            width: 100%;
            background: rgba(26, 26, 26, .09);
            color: #fff;
            border: 0;
            border-radius: 0;
            padding: 5px;
            margin-bottom: 10px;
            border-bottom: 1px solid #fff;
        }

        .blue-interests-form input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .blue-interests-form input.error {
            border-color: #f00;
        }

        .interests-right-top {
            padding: 20px 0;
        }

        .interests-right-top h3 {
            color: #fff;
            font-size: 39px;
            display: flex;
            justify-content: space-evenly;
            /*font-family: 'harir-regular';*/
            height: 100%;
            align-items: center;
            position: relative;
            line-height: 60px;
            top: -2px;
        }

        .interests-right--1 {
            height: 100%;
        }

        .interests-right--1 img {
            height: 100%;
            width: 100%;
            object-fit: cover;
        }

        .blue-interests {
            padding: 80px 0;
        }

        .blue-interests-form button {
            background: #2F2F63;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 0px;
            margin-top: 7px;
            display: block;
            width: 100%;
        }

        .soliman-footer-social {
            position: relative;
            float: left;
        }

        .soliman-footer-social-icons {
            margin-bottom: 10px;
        }

        .soliman-footer-social-icons a {
            color: #fff;
            display: inline-block;
            width: 33px;
            height: 33px;
            background: #757575;
            text-align: center;
            margin-left: 5px;
            padding-top: 7px;
            transition: all .5s;
        }

        .soliman-footer-social-icons a svg {
            width: 16px;
        }

        .soliman-footer-social-icons a:hover {
            background: #fff;
        }

        .blue-fmap {
            background: #ddd;
            width: 100%;
            height: 400px;
            margin-bottom: 30px;
            position: relative;
        }

        .blue-fmap iframe {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }

        .blue-profile a {
            background: #008FC5;
            color: #fff;
            display: block;
            padding: 10px 25px 5px;
            text-align: center;
            transition: all .5s;
        }

        .blue-profile:hover {
            background: $ hcolor;
        }

        .blue-social {
            border-top: 2px solid #989898;
            border-bottom: 2px solid #989898;
            text-align: center;
            margin: 20px 0;
            overflow: hidden;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-direction: row;
            padding-top: 15px;
        }

        .blue-social a {
            color: #fff;
            text-align: center;
            transition: all .5s;
        }

        .blue-social a svg {
            width: 20px;
        }

        .blue-menu a {
            color: #fff;
            display: inline-block;
            width: 47%;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .blue-menu {
            margin: 30px 0;
        }

        .blue-mail p {
            color: #fff;
            margin-bottom: 5px;
        }

        .blue-mail {
            margin: 25px 0;
            overflow: hidden;
        }

        .blue-mail-co {
            display: flex;
            justify-content: space-between;
        }

        .blue-mail-co input {
            background: #ddd;
            border: none;
            width: 100%;
            padding: 5px;
        }

        .blue-mail-co a {
            background: #008FC5;
            color: #fff;
            padding: 7px 20px 0;
        }

        .blue-copyright {
            color: #fff;
            text-align: center;
            position: relative;
            top: 42px;
            direction: ltr;
        }

        .blue-slide {
            width: 100%;
            padding: 80px 0;
            background: url('{{url("uploads/".@$set->bluedar_gallery_image)}}') center no-repeat;
            object-fit: cover;
            text-align: center;
            overflow: hidden;
            background-size: cover;
            min-height: 100vh;

        }

        .blue-slide h3 {
            color: #fff;
            font-size: 24px;
            width: 100%;
            text-align: center;
            padding: 47px 0 10px;
            margin-bottom: 40px;
        }

        .blue-slide-slider-item {
            height: 600px;
            max-width: 1000px;
        }

        .blue-slide-slider-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }


        /*.blue-slide img {*/
        /*    width: 80%;*/
        /*    margin: auto;*/
        /*    height: auto;*/
        /*}*/

        .blue-slide-slider {
            direction: ltr;
            padding-left: 40px;
            padding-right: 40px;
        }

        .blue-location {
            width: 100%;
            line-height: 0;
            overflow: hidden;
            position: relative;
            padding-top: 100px;
        }


        .blue-location-icon {
            position: absolute;
            top: 0;
            left: 10px;
            text-align: center;
            z-index: 10;
        }

        @if(app()->getLocale() == 'en')
       html[lang=en] .blue-location-icon {
            left: auto;
            right: 10px;
        }

        @endif

        .blue-location-icon img {
            max-width: 150px !important;
            height: auto;
        }

        .blue-location-icon span {
            display: block;
            margin-top: 16px;
            line-height: 23px;
            font-size: 16px;
            color: #58595B;
        }

        .blue-location img {
            width: 100%;
        }

        .header-bh img {
            height: 80px !important;
            width: 71px !important;
            position: relative;
            top: 85px;
            margin: 3px;
        }

        .header-bh {
            text-align: center;
            position: relative;
            top: -50px;
        }

        .header-bh p {
            font-size: 30px;
        }

        .slick-arrow {
            position: absolute;
            top: 47%;
            right: 10px;
            z-index: 1;
            width: 20px;
            height: 20px;
            color: transparent;
            border: none;
            background: transparent url('/theme/images/blue/arrow.png') no-repeat;
        }

        .slick-prev {
            left: 10px;
            transform: rotate(180deg)
        }

        .position-relative {
            position: relative;
        }

        @media (max-width: 767px) {


            .blue-slide-slider-item {
                width: 290px !important;
                height: 400px;
            }

            header .soliman-header-co {
                margin-top: 0;
                height: 100vh;
                display: flex;
                align-content: center;
                justify-content: center;
            }

            header .soliman-header-co .container {
                height: calc(100vh - 100px);
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                margin-top: 100px;
            }

            .intro-icon h3 span {
                display: block;
            }


            .blue-slide-slider {
                padding-left: 0;
                padding-right: 0;
            }

            .blue-d-logo {
                display: block;
            }

            .blue-d-logo2 {
                display: none;
            }


            .blue-location-icon {
                top: -50px;
            }

        }

        @media (max-width: 600px) {
            header.inside .soliman-header {
                height: 100vh;
            }

            .blue-location-icon img {
                max-width: 50px !important;
            }

            .name-logo img {
                width: auto;
                max-width: 200px;
            }

            .intro-icon h3 {
                font-size: 20px;
            }
        }
    </style>

    <div class="soliman-help-icons d-md-none d-lg-none">
        <div class="row">
            <div class="col-1"></div>
            <div class="col">
             </div>
            <div class="col">
            </div>
            <div class="col">
                <a href="#blue-interests" id="favor-show" style="background-color:#2F2F63 !important;"><img src="{{url('theme/images/social/3'.$lang.'.png')}}" alt=""></a>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
    <div class="intro">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="blue-d-logo2">
                        <img src="{{url("uploads/".@$set->bluedar_logo) }}"/>
                    </div>
                    <div class="name-logo">
                        <img src="{{url("")}}/theme/images/blue/name.svg"/>
                    </div>
                    <h2 class="mb-3 d-none">بلودار</h2>
                    <p>{!! app()->getLocale() == 'ar' ? @$set->bluedar_breif->ar : @$set->bluedar_breif->en !!}</p>

                </div>
                <div class="col-10 mt-5">
                    <div class="row">
                        <div class="col-6 col-md-3">
                            <div class="intro-icon"><img src="{{url('')}}/theme/images/blue/icon1.png" alt=""/>
                                <h3>منازل <span>عصرية</span></h3></div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="intro-icon"><img src="{{url('')}}/theme/images/blue/icon2.png" alt=""/>
                                <h3>مجتمع <span>متكامل</span></h3></div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="intro-icon"><img src="{{url('')}}/theme/images/blue/icon3.png" alt=""/>
                                <h3>بيئة <span>أمنه</span></h3></div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="intro-icon"><img src="{{url('')}}/theme/images/blue/icon4.png" alt=""/>
                                <h3>موقع <span>استراتيجى</span></h3></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="intro-img"></div>

    <div class="blue-design d-none">
        <h2>
            تصاميم
            معمارية
            أيقونية
        </h2>
    </div>
    <div class="blue-design-img d-none">
        <img src='{{url("")}}/theme/images/blue/bg2.jpg'/>
    </div>

    <div class="blue-slide">
        <div class="container">
            <h3> {!! app()->getLocale() == 'ar' ? @$set->bluedar_gallery_title->ar : @$set->bluedar_gallery_title->en !!} </h3>

            <div class="blue-slide-slider">
                @foreach(json_decode(@$set->bluedar_gallery) as $gimg)
                    <div class="blue-slide-slider-item">
                        <a href="{{url("uploads/site/".$gimg)}}" data-fancybox="g">
                            <img src="{{url("uploads/site/".$gimg) }}"/>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </div>




    <div class="blue-location">
        <div class="container position-relative">
            <div class="blue-location-icon">
                <img src="{{url("")}}/theme/images/blue/map-icon.svg"/>
                <span>  {!! app()->getLocale() == 'ar' ? nl2br(@$set->bluedar_map_title->ar) : nl2br(@$set->bluedar_map_title->en) !!} </span>
            </div>
        </div>
        <a href="{{ @$set->bluedar_map_link->ar }}"><img src="{{url("uploads/".@$set->bluedar_map_image)}}"/></a>
    </div>



    <div class="blue-interests" id="blue-interests">
        <div class="container">
            <div class="interests-right-top d-block d-lg-none">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h3>  {!! app()->getLocale() == 'ar' ? nl2br(@$set->bluedar_interesting_title->ar) : nl2br(@$set->bluedar_interesting_title->en) !!}  </h3>
                    </div>
                    <div><img src="{{url("")}}/theme/images/blue/logo-blue.svg"/></div>
                </div>
            </div>
            <div class="row">


                <div class="col-lg-5 mb-5 mb-lg-0 p-0 p-lg-3">
                    <div class="interests-right interests-right--1 h-100 ">
                        <img src="{{url("uploads/".@$set->bluedar_interesting_image)}}"/>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="interests-right-top  d-none d-lg-block">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h3>  {!! app()->getLocale() == 'ar' ? nl2br(@$set->bluedar_interesting_title->ar) : nl2br(@$set->bluedar_interesting_title->en) !!}  </h3>
                            </div>
                            <div><img src="{{url("")}}/theme/images/blue/logo-blue.svg"/></div>
                        </div>
                    </div>
                    <div class="blue-interests-form">
                        <form  class="blue-interests-form-tag">
                            <label>{{ trans('site.contact.name') }}</label><input id="bludar_name" class="mb-3" type="text"
                                                                                  placeholder="{{ trans('site.contact.name') }}"
                                                                                  name="name"/>
                            <label>{{ trans('site.contact.mobile') }}</label>
                            <input style="direction: ltr"
                                   id="bludar_phone"
                                   class="mb-3" type="text"
                                   name="phone"/>

                            <label>{{ trans('site.address.email') }}</label><input id="bludar_email" class="mb-3" type="text"
                                                                                   name="email"/>
                            @csrf
                            <button type="button" id="blue-interests-btn">{{ trans('site.helper.favor') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('ajs')

    <script>
        $(window).on("scroll", function () {
            if ($(window).scrollTop() > 300) {
                $(".soliman-navbar").addClass("stick");
            } else {
                $(".soliman-navbar").removeClass("stick");
            }
        });
        $('.nav-btn').on('click', function (e) {
            e.preventDefault();
            $('.soliman-nav-menu').fadeToggle(200)
            $('.soliman-navc').toggleClass('menu-active');
            if ($('header').hasClass('einside')) {
                $('header').addClass('inside')
                $('header').removeClass('einside')
            } else {

                if ($('header').hasClass('inside')) {
                    $('header').addClass('einside')
                    $('header').removeClass('inside')

                }
            }

        })
    </script>

    <!-- intlTelInput Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.min.js"></script>

    <script>


    <!-- Initialization Script -->
    var input = document.querySelector("#bludar_phone");

    // Initialize intlTelInput
    var iti = window.intlTelInput(input, {
        autoPlaceholder: "polite",
        initialCountry: "sa",
        preferredCountries: ['sa', 'ue', 'qa'],
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


    // // Example: Get full phone number on form submit
    // document.querySelector('#yourFormId').addEventListener('submit', function() {
    //     var fullNumber = iti.getNumber();
    //     // You can now use fullNumber as the phone number input with country code
    //     console.log(fullNumber); // Logs the full number with country code
    // });



        // $(document).ready(function() {
        //     var prefix = '+9665';
        //     var maxAdditionalDigits = 8;
        //     var $phoneInput = $('#bludar_phone');
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
        //
        //
        //         $('#blue-interests-btn').click(function() {
        //             var name = $('#bludar_name').val();
        //             var phone = $('#bludar_phone').val();
        //             var email = $('#bludar_email').val();
        //
        //             // Pushing data to the GTM Data Layer
        //             window.dataLayer = window.dataLayer || [];
        //             window.dataLayer.push({
        //                 'event': 'blueDarInterestsFormSubmission',
        //                 'formData': {
        //                     'blueDarInterestsName': name,
        //                     'blueDarInterestsPhone': phone,
        //                     'blueDarInterestsEmail': email
        //                 }
        //             });
        //         });
        //
        // });

        $('#favor-show').on('click', function(event) {
                event.preventDefault();

                var target = $(this.hash);

                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 1000); // Adjust the animation speed as needed

            });


    </script>

@endsection
