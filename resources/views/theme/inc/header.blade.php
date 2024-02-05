<!DOCTYPE html>
<html lang="en" class="soliman_{{ $lang }}">

<head>
    <meta charset="UTF-8">

    {{-- Canonical Link --}}
    <link href="{{ env('APP_URL') }}" rel="canonical" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="facebook-domain-verification" content="5m1rfz4iq3866nzl3n2qmgvtxlvvaw" />
    <link rel="stylesheet" href="{{ url('theme') }}/style/slick.min.css">
    <link rel="stylesheet" href="{{ url('theme') }}/style/animate.css">
    <link rel="icon" type="image/x-icon" href="{{ url('theme') }}/images/logo.svg">
    @stack('header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" integrity="sha512-nNlU0WK2QfKsuEmdcTwkeh+lhGs6uyOxuUs+n+0oXSYDok5qy0EI0lt01ZynHq6+p/tbgpZ7P+yUb+r71wqdXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ url('theme') }}/style/main.css?hash=22">
    <link rel="stylesheet" href="{{ url('theme') }}/style/selling.css?hash=32">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


@if (@$blue)
        <link rel="stylesheet" href="{{ url('theme') }}/style/blue.css">
    @endif
    @if (@$hideTitle)
    @else
        <title>{{ @$set->name->$lang }} @yield('title_txt') @if ($tagline = @$set->tagline->$lang)
                - {{ $tagline }}
            @endif
        </title>
    @endif


    <meta name="theme-color" content="#048bbd" />

    @isset($hasSeotools)
        @include('enhance.theme.partials._frontSeotools')
    @else
        <meta name="description" content="{{ @$page_desc->$lang ?? @$set->description }}" />
        <meta name="twitter:title"
            content="{{ @$page_title->$lang ?? (@$page_title2 ?? @$set->name->$lang . '-' . @$tagline) }}" />
        <meta name="twitter:site" content="{{ URL('') }}" />
        <meta name="twitter:creator" content="{{ @$set->name->$lang }}" />
        <meta name="twitter:description" content="{{ @$page_desc->$lang ?? @$set->name->$lang }}" />
        <meta name="twitter:card" content="summary_large_image" />
        <meta property="og:site_name" content="{{ @$set->name->$lang }}" />
        <meta property="og:url" content="{{ url()->current() }}" />
        <meta property="og:title"
            content="{{ @$page_title->$lang ?? (@$page_title2 ?? @$set->name->$lang . '-' . @$tagline) }}" />
        <meta name="og:description" content="{{ @$page_desc->$lang ?? @$set->desc->$lang }}" />
        <meta property="og:type" content="website" />
        <meta name="twitter:image" content="{{ @$page_img ?? '' }}" />
        <meta name="twitter:image:src" content="{{ @$page_img ?? '' }}" />
        <meta property="og:image" content="{{ @$page_img ?? '' }}" />
    @endisset

    <link rel="image_src" href="{{ @$page_img ?? '' }}">

    <style>

        .iti {
            width: 100%;
            position: relative;
            display: inline-block;
            margin-bottom: 6px;
        }

        .social-btn-sp #social-links {
            margin: 0 auto;
            max-width: 500px;
            margin-bottom: 8px;
        }

        .social-btn-sp #social-links ul li {
            display: inline-block;
        }

        .social-btn-sp #social-links ul li a {
            padding: 4px 8px;
            border: 1px solid #ccc;
            margin: 8px;
            font-size: 30px;
            color: gray;
            transition: color .3s ease-in-out
        }

        .social-btn-sp #social-links ul li a:hover {
            color: rgb(70, 70, 70)
        }

        table #social-links {
            display: inline-table;
        }

        table #social-links ul li {
            display: inline;
        }

        table #social-links ul li a {
            padding: 5px;
            border: 1px solid #ccc;
            margin: 1px;
            font-size: 15px;
            background: #e3e3ea;
        }
    </style>

{{--    <!-- Snap Pixel Code -->--}}
{{--    <script type='text/javascript'>--}}
{{--        (function(e, t, n) {--}}
{{--            if (e.snaptr) return;--}}
{{--            var a = e.snaptr = function() {--}}
{{--                a.handleRequest ? a.handleRequest.apply(a, arguments) : a.queue.push(arguments)--}}
{{--            };--}}
{{--            a.queue = [];--}}
{{--            var s = 'script';--}}
{{--            r = t.createElement(s);--}}
{{--            r.async = !0;--}}
{{--            r.src = n;--}}
{{--            var u = t.getElementsByTagName(s)[0];--}}
{{--            u.parentNode.insertBefore(r, u);--}}
{{--        })(window, document,--}}
{{--            'https://sc-static.net/scevent.min.js');--}}

{{--        snaptr('init', 'e1710116-e460-4a4b-8c02-20148173229a', {--}}
{{--            'user_email': 'Info@alsoliman.com.sa'--}}
{{--        });--}}

{{--        snaptr('track', 'PAGE_VIEW');--}}
{{--    </script>--}}
{{--    <!-- End Snap Pixel Code -->--}}
{{--    <!-- Facebook Pixel Code -->--}}
{{--    <script>--}}
{{--        ! function(f, b, e, v, n, t, s) {--}}
{{--            if (f.fbq) return;--}}
{{--            n = f.fbq = function() {--}}
{{--                n.callMethod ?--}}
{{--                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)--}}
{{--            };--}}
{{--            if (!f._fbq) f._fbq = n;--}}
{{--            n.push = n;--}}
{{--            n.loaded = !0;--}}
{{--            n.version = '2.0';--}}
{{--            n.queue = [];--}}
{{--            t = b.createElement(e);--}}
{{--            t.async = !0;--}}
{{--            t.src = v;--}}
{{--            s = b.getElementsByTagName(e)[0];--}}
{{--            s.parentNode.insertBefore(t, s)--}}
{{--        }(window, document, 'script',--}}
{{--            'https://connect.facebook.net/en_US/fbevents.js');--}}
{{--        fbq('init', '238114738105168');--}}
{{--        fbq('track', 'PageView');--}}
{{--    </script>--}}
{{--    <noscript><img height="1" width="1" style="display:none"--}}
{{--            src="https://www.facebook.com/tr?id=238114738105168&ev=PageView&noscript=1" /></noscript>--}}
{{--    <!-- End Facebook Pixel Code -->--}}
    <!-- Twitter universal website tag code -->
    <script>
        ! function(e, t, n, s, u, a) {
            e.twq || (s = e.twq = function() {
                    s.exe ? s.exe.apply(s, arguments) : s.queue.push(arguments);
                }, s.version = '1.1', s.queue = [], u = t.createElement(n), u.async = !0, u.src =
                '//static.ads-twitter.com/uwt.js',
                a = t.getElementsByTagName(n)[0], a.parentNode.insertBefore(u, a))
        }(window, document, 'script');
        // Insert Twitter Pixel ID and Standard Event data below
        twq('init', 'o6yqv');
        twq('track', 'PageView');
    </script>

    <script>
        window.onload = function() {
            var isMobile = window.innerWidth <= 1000;
            if (!isMobile) {
                (function(w, d, u) {
                    var s = d.createElement('script');
                    s.async = true;
                    s.src = u + '?' + (Date.now() / 60000 | 0);
                    var h = d.getElementsByTagName('script')[0];
                    h.parentNode.insertBefore(s, h);
                })(window, document, 'https://cdn.bitrix24.com/b17713051/crm/site_button/loader_2_4tx0d7.js');
            }
        }
    </script>

    {{-- Head global script --}}
    {!! @$set->head !!}

    @stack('head_scripts')

</head>

<body class="{{ @$blue }} {{ @$selling }}">


    <header
        class="{{ @$inside ? 'inside' : '' }} {{ @$eventc ? 'eventc' : '' }} {{ @$nohead ? 'nohead' : '' }} {{ @$backstat ? '' : 'molhem' }}">
        <div class="soliman-nav">
            <div class="soliman-navc ">
                <div class="container">
                    <div class="row">
                        <div class="col-2">
                            <a href="#" class="nav-btn"></a>
                        </div>
                        <div class="col-8">
                            <div class="soliman-navc-logo">
                                <a href="{{ url('') }}"></a>
                            </div>
                        </div>
                        <div class="col-2">
                            @php
                                $titleLang = ($l = strtoupper($lang) == 'EN') ? 'AR' : 'EN';
                                $slang = ($l = strtoupper($lang) == 'EN') ? 'ar' : 'en';
                            @endphp

                            <a href="{{ LaravelLocalization::getLocalizedURL($slang, null, [], true) }}"
                                class="lang-btn">{{ $titleLang }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="soliman-nav-menu">
                <ul>
                    <li><a @if (Route::is('home')) class="active" @endif
                            href="{{ route('home') }}">{{ __('site.nav.home') }}</a></li>
                    <li><a @if (Route::is('about')) class="active" @endif
                            href="{{ route('about') }}">{{ __('site.nav.about') }}</a></li>
                    <li><a href="{{ route('home') }}#services">{{ __('site.nav.services') }}</a></li>
                    <li><a class="@if (Route::is('project')) active @endif  has-menu"
                            href="#">{{ __('site.nav.projects') }}
                            <i class="menu-arrow"></i></a>
                        @if (!$projects->isEmpty())
                            <ul>
                                @foreach ($projects as $project)
                                    <li>
                                        <a
                                            href="{{ route('project', $lang == 'ar' ? (string) $project->slug_ar : (string) $project->slug) }}">{{ $project->title->$lang }}</a>
                                    </li>
                                @endforeach
                                <li><a href="{{ route('home') }}#projects">{{ __('site.nav.oprojects') }}</a></li>
                            </ul>
                        @endif
                    </li>
                    <li><a class="@if (Route::is('product')) active @endif  has-menu"
                            href="#">{{ __('site.nav.products') }}
                            <i class="menu-arrow"></i></a>
                        @if (!$products->isEmpty())
                            <ul>
                                @foreach ($products as $product)
                                    <li>
                                        <a
                                            href="{{ route('product', $lang == 'ar' ? (string) $product->slug_ar : (string) $product->slug) }}">{{ $product->title->$lang }}</a>
                                    </li>
                                @endforeach

                                @if ($lang == 'ar')
                                    <li>
                                        <a
                                            href="{{route('project.bluedar.ar')}}">{{ trans('site.bluedar') }}</a>
                                    </li>
                                @else
                                    <li>
                                        <a
                                            href="{{route('project.bluedar')}}">{{ trans('site.bluedar') }}</a>
                                    </li>
                                @endif

                            </ul>
                        @endif
                    </li>
                    <li><a @if (Route::is('selling.home')) class="active" @endif
                            href="{{ route('selling.home') }}">{{ __('site.nav.selling') }}</a></li>
                    <li>
                        <a class="@if (Route::is('news') || Route::is('events') || Route::is('files')) active @endif has-menu"
                            href="">{{ __('site.nav.media') }} <i class="menu-arrow"></i></a>
                        <ul>
                            <li><a href="{{ route('news') }}">{{ __('site.nav.news') }}</a></li>
                            <li><a href="{{ route('events') }}">{{ __('site.nav.events') }}</a></li>
                            <li><a href="{{ route('files') }}">{{ __('site.nav.files') }}</a></li>
                        </ul>
                    </li>
                    <li><a @if (Route::is('investors')) class="active" @endif
                            href="{{ route('investors') }}">{{ __('site.nav.investor') }}</a></li>
                    <li><a @if (Route::is('molhem')) class="active" @endif
                            href="{{ route('molhem') }}">{{ __('site.nav.elham') }}</a></li>
                    <li><a @if (Route::is('contact')) class="active" @endif
                            href="{{ route('contact') }}">{{ __('site.nav.contact') }}</a></li>
                </ul>
                <div class="soliman-nav-menu-social">
                    <a href="{{ @$set->twitter }}">
                        <svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor"
                                d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z">
                            </path>
                        </svg>
                    </a>
                    <a href="{{ @$set->instagram }}">
                        <svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path fill="currentColor"
                                d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z">
                            </path>
                        </svg>
                    </a>
                    <a href="{{ @$set->youtube }}">
                        <svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path fill="currentColor"
                                d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z">
                            </path>
                        </svg>
                    </a>
                    <a href="{{ @$set->linkedin }}">
                        <svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path fill="currentColor"
                                d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="soliman-navbar">
            <div class="container">
                <div class="row">
                    <div class="col-10">
                        <nav>
                            <ul>
                                <li><a @if (Route::is('home')) class="active" @endif
                                        href="{{ route('home') }}">{{ __('site.nav.home') }}</a></li>
                                <li><a @if (Route::is('about')) class="active" @endif
                                        href="{{ route('about') }}">{{ __('site.nav.about') }}</a></li>
                                <li><a href="{{ route('home') }}#services">{{ __('site.nav.services') }}</a></li>
                                <li><a @if (Route::is('project')) class="active" @endif class="has-menu"
                                        href="#">{{ __('site.nav.projects') }} <i class="menu-arrow"></i></a>
                                    @if (!$projects->isEmpty())
                                        <ul>
                                            @foreach ($projects as $project)
                                                <li>
                                                    <a
                                                        href="{{ route('project', $lang == 'ar' ? (string) $project->slug_ar : (string) $project->slug) }}">{{ $project->title->$lang }}</a>
                                                </li>
                                            @endforeach
                                            <li><a
                                                    href="{{ route('home') }}#projects">{{ __('site.nav.oprojects') }}</a>
                                            </li>
                                        </ul>
                                    @endif
                                </li>
                                <li><a @if (Route::is('selling.home')) class="active" @endif
                                        href="{{ route('selling.home') }}">{{ __('site.nav.selling') }}</a></li>
                                <li><a @if (Route::is('product')) class="active" @endif class="has-menu"
                                        href="#">{{ __('site.nav.products') }} <i class="menu-arrow"></i></a>
                                    @if (!$products->isEmpty())
                                        <ul>
                                            @foreach ($products as $product)
                                                <li>
                                                    <a
                                                        href="{{ route('product', $lang == 'ar' ? (string) $product->slug_ar : (string) $product->slug) }}">{{ $product->title->$lang }}</a>
                                                </li>
                                            @endforeach
                                            @if ($lang == 'ar')
                                                <li>
                                                    <a
                                                        href="{{route('project.bluedar.ar')}}">{{ trans('site.bluedar') }}</a>
                                                </li>
                                            @else
                                                <li>
                                                    <a
                                                        href="{{route('project.bluedar')}}">{{ trans('site.bluedar') }}</a>
                                                </li>
                                            @endif
                                        </ul>
                                    @endif
                                </li>
                                <li><a @if (Route::is('news') || Route::is('events') || Route::is('files')) class="active" @endif class="has-menu"
                                        href="">{{ __('site.nav.media') }} <i class="menu-arrow"></i></a>
                                    <ul>
                                        <li><a href="{{ route('news') }}">{{ __('site.nav.news') }}</a></li>
                                        <li><a href="{{ route('events') }}">{{ __('site.nav.events') }}</a></li>
                                        <li><a href="{{ route('files') }}">{{ __('site.nav.files') }}</a></li>
                                    </ul>
                                </li>
                                <li><a @if (Route::is('investors')) class="active" @endif
                                        href="{{ route('investors') }}">{{ __('site.nav.investor') }}</a></li>
                                <li><a @if (Route::is('molhem')) class="active" @endif
                                        href="{{ route('molhem') }}">{{ __('site.nav.elham') }}</a></li>
                                <li><a @if (Route::is('contact')) class="active" @endif
                                        href="{{ route('contact') }}">{{ __('site.nav.contact') }}</a></li>
                                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    @if ($localeCode != LaravelLocalization::getCurrentLocale())
                                        <li>
                                            <a hreflang="{{ $localeCode }}"
                                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                {{ $localeCode == 'en' ? 'EN' : $properties['native'] }}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                    <div class="col-2">
                        <a href="{{ url('') }}" class="soliman-logo">
                            <img src="{{ url('theme') }}/images/logo.svg" alt="{{ @$set->name->$lang }}">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @if (@$backstat)
            <div class="soliman-header">
                @if (@$blue)
                    <div class="soliman-header-bg"
                        style="background-image:url('{{ url('uploads') }}/{{ @$set->bluedar_image }}');@if (@$backbgpos) background-position:{{ $backbgpos }} @endif">
                    </div>
                @else
                    <div class="soliman-header-bg"
                        style="background-image:url(@if (!@$backbg2) '{{ url('uploads') }}/{{ @$backbg }}'@else'{{ @$backbg2 }}' @endif);@if (@$backbgpos) background-position:{{ $backbgpos }} @endif">
                    </div>
                @endif

                @if (@$molhem)
                    <div class="soliman-header-molehm">
                        <span>{{ $post->cat->$lang }}</span>
                        <h2>{{ $post->title->$lang }}</h2>
                        <p>{{ $post->breif->$lang }}</p>
                    </div>
                @else
                    <div class="soliman-header-co">
                        <div class="container">
                            @if (@$blue)
                                <div class="header-bh">
                                    <p> {!! app()->getLocale() == 'ar' ? nl2br(@$set->bluedar_title->ar) : nl2br(@$set->bluedar_title->en) !!} </p>
                                </div>

                                <img src="{{ url('') }}/theme/images/blue/flogo.png" class="blue-d-logo" />
                            @endif
                            <h2 class=" wow fadeInRight">{!! render(@$backtitle->ar) !!}</h2>
                            <h2 class=" wow fadeInLeft">{!! render(@$backtitle->en) !!}</h2>
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </header>
