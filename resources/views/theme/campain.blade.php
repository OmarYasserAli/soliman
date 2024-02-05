<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ @$campain->title }}</title>
    <style>
        @font-face {
            font-family: 'bahij-bold';
            src: url('{{url('')}}/theme/style/fonts/Bahij_TheSansArabic-Bold.ttf');
            font-display: swap;
            font-weight: 400;
        }
        *{
            margin: 0;
            padding: 0;
            outline: 0;
        }
        body{
            background: url('{{url('')}}/theme/images/alsoliman/Landing Page  2-07.svg') no-repeat;
            background-position: 100% 100%;
            background-size: 100% 7%;
        }
        .soliman-landpage {
            width: 500px;
            max-width: 95%;
            overflow: hidden;
            margin: auto;
            direction: rtl;
        }

        .logo {
            display: block;
            margin: 40px 0;
            text-align: center;
        }

        .logo img {
            height: 200px;
        }

        .soliman-links {
            background: #f2f2f2;
            margin-bottom: 40px;
        }

        .soliman-links a {
            display: block;
            padding: 20px 20px 10px;
            text-decoration: none;
            transition: all .5s;
            font-family: 'bahij-bold';
        }

        .soliman-links a:nth-child(odd) {
            background: rgba(222, 222, 222, 0.44);
        }

        .soliman-links a:hover {
            background: #9f9d9d;
        }

        .soliman-links a:hover span {
            color: #fff;
        }

        .soliman-links a span {
            color: #444;
            position: relative;
            margin-right: 20px;
            top: -18px;
            font-size: 29px;
            display: inline-block;
            text-align: center;
            width: 300px;
        }

        .soliman-links a img {
            height: 100px;
        }

        .soliman-develop {
            text-align: center;
            margin-bottom: 80px;
        }

        .soliman-develop img {
            width: 80%;
        }
        @media(max-width:500px){
            .soliman-links a span{
                font-size: 18px;
                top:-10px;
                width:230px;
            }
            .soliman-links a img {
                height: 60px;
            }
        }
        @media(max-width:400px){
            .soliman-links a span{
                font-size: 16px;
                width:200px;
            }
        }
        @media(max-width:350px){
            .soliman-links a span {
                font-size: 15px;
                top: -15px;
                width: 133px;
            }
            .soliman-links a img {
                height: 60px;
            }
            .logo img {
                height: 140px;
            }
        }
    </style>
    <!-- Snap Pixel Code -->
    <script type='text/javascript'>
        (function(e, t, n) {
            if (e.snaptr) return;
            var a = e.snaptr = function() {
                a.handleRequest ? a.handleRequest.apply(a, arguments) : a.queue.push(arguments)
            };
            a.queue = [];
            var s = 'script';
            r = t.createElement(s);
            r.async = !0;
            r.src = n;
            var u = t.getElementsByTagName(s)[0];
            u.parentNode.insertBefore(r, u);
        })(window, document,
            'https://sc-static.net/scevent.min.js');

        snaptr('init', 'e1710116-e460-4a4b-8c02-20148173229a', {
            'user_email': 'Info@alsoliman.com.sa'
        });

        snaptr('track', 'PAGE_VIEW');
    </script>
    <!-- End Snap Pixel Code -->
    <!-- Facebook Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '238114738105168');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=238114738105168&ev=PageView&noscript=1" /></noscript>
    <!-- End Facebook Pixel Code -->
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
    {!! @$set->head !!}
</head>

<body>


    <div class="soliman-landpage">
        <a href="{{url('')}}" class="logo">
            <img src="{{url('')}}/theme/images/alsoliman/Landing Page  2-01.svg" alt="">
        </a>
        <div class="soliman-links">
            @if(@$campain->wapp)
            <a class="wapp" href="{{ @$campain->wapp }}">
                <img src="{{url('')}}/theme/images/alsoliman/Landing Page Elements-02.svg" alt="">
                <span>اضغـط للتواصل <br> عبــر الواتســاب</span>
            </a>
            @endif
            @if(@$campain->phone)
            <a class="tel" href="{{ @$campain->phone }}">
                <img src="{{url('')}}/theme/images/alsoliman/Landing Page Elements-03.svg" alt="">
                <span>اضغـط هنا <br> للاتصــال</span>
            </a>
            @endif
            @if(@$campain->map)
            <a class="map" href="{{ @$campain->map }}">
                <img src="{{url('')}}/theme/images/alsoliman/Landing Page Elements-04.svg" alt="">
                <span>اضغـط للوصــول <br> لموقع المشروع</span>
            </a>
            @endif
            @if(@$campain->info)
            <a class="info" href="{{ @$campain->info }}">
                <img src="{{url('')}}/theme/images/alsoliman/Landing Page Elements-05.svg" alt="">
                <span>لمعلومات أكثر <br> عـن المـشروع</span>
            </a>
            @endif
        </div>
        <div class="soliman-develop">
            <img src="{{url('')}}/theme/images/alsoliman/Landing Page  2-06.svg" alt="">
        </div>
    </div>
    {!! @$set->footer_script !!}
</body>

</html>
