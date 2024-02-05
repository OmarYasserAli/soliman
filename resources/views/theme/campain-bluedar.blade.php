<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ @$set->campain_title }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @font-face {
            font-family: 'bahij-bold';
            src: url('{{url('')}}/theme/style/fonts/Bahij_TheSansArabic-Bold.ttf');
            font-display: swap;
            font-weight: 400;
        }

        * {
            margin: 0;
            padding: 0;
            outline: 0;
        }

        *, *:before, *:after {
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        body {

        }

        .wrap {
            max-width: 524px;
            width: 100%;
            margin: auto;
            background: #262E30 url('{{ asset('theme/images/blue/l-bg.png') }}')  center 80px no-repeat;
            min-height: 100vh;
            padding: 40px 40px 180px 40px;
            position: relative;
        }

        .cont{
            /* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#748377+0,748377+100&0.79+0,0+100 */
            background: -moz-linear-gradient(top,  rgba(116,131,119,0.79) 0%, rgba(116,131,119,0) 100%); /* FF3.6-15 */
            background: -webkit-linear-gradient(top,  rgba(116,131,119,0.79) 0%,rgba(116,131,119,0) 100%); /* Chrome10-25,Safari5.1-6 */
            background: linear-gradient(to bottom,  rgba(116,131,119,0.79) 0%,rgba(116,131,119,0) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#c9748377', endColorstr='#00748377',GradientType=0 ); /* IE6-9 */
            min-height: calc(100vh - 150px);

        }
        .botom-img{
            position: absolute;
            bottom: 0;
            left: 0;
        }
        .botom-img img{
            width: 100%;
        }
        .head-logos{
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .me-5{
            margin-left: 50px;
        }
        h1{
            white-space: pre-line;
            font-size: 29px;
            font-weight: 400;
            color:#fff;
            text-align: center;
            font-family: 'bahij-bold';
            margin-top: 30px;
        }
        h2{
            white-space: pre-line;
            font-size: 13px;
            font-weight: 400;
            color:#fff;
            text-align: center;
            font-family: 'bahij-bold';
            margin-top: 15px;
        }
        h3{
            white-space: pre-line;
            font-size: 18px;
            font-weight: 400;
            color:#fff;
            text-align: center;
            font-family: 'bahij-bold';
            margin-top: 30px;
        }
        p{
            white-space: pre-line;
            font-size: 15px;
            font-weight: 400;
            color:#fff;
            text-align: center;
            font-family: 'bahij-bold';
            margin-top: 5px;
        }
        .link{
            margin-top: 30px;
        }
        .link a{
            border:1px solid #fff;
            display: flex;
            width: 100%;
            color: #fff;
            margin-top: 15px;
            align-items: center;
            font-family: 'bahij-bold';
            font-size: 18px;
            text-decoration: none;
        }
        .link a i{
            color: #5A645A;
            font-size: 30px;
            width: 50px;
            height: 40px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .link a span{
            margin-right: 15px;
        }

        .cont{
            padding: 40px;
        }


        .copyright{
            font-size: 14px;
            color: #fff;
            white-space: pre-line;
            text-align: center;
            font-family: 'bahij-bold';
        }

        @media(max-width: 640px){
            .wrap {
                 padding: 40px 30px 180px 30px;
             }
            .botom-img {
                 bottom: 0;
             }
        }

    </style>
    <!-- Snap Pixel Code -->
    <script type='text/javascript'>
        (function (e, t, n) {
            if (e.snaptr) return;
            var a = e.snaptr = function () {
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
        !function (f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function () {
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
                   src="https://www.facebook.com/tr?id=238114738105168&ev=PageView&noscript=1"/></noscript>
    <!-- End Facebook Pixel Code -->
    <!-- Twitter universal website tag code -->
    <script>
        !function (e, t, n, s, u, a) {
            e.twq || (s = e.twq = function () {
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


<div class="wrap">
    <div class="cont">

        <div class="head-logos">
            <a href="{{url('')}}"  class="me-5">
                <img src="{{url('')}}/theme/images/blue/l-bludar-logo.svg" alt="">
            </a>

            <a href="{{url('')}}">
                <img src="{{url('')}}/theme/images/blue/l-logo.svg" alt="">
            </a>
        </div>


        <h1>تملك الآن
            بلودار كمباوند</h1>
        <h2>OWN YOUR HOME IN
            BLUEDAR COMPOUND</h2>

        <h3>استفسر مع مستشارك العقاري</h3>
        <p>Inquire with your real estate advisor</p>

        <div class="link">
            <a href="https://wa.me/966556666755"><i class="fa-brands fa-whatsapp"></i> <span>صالح</span> <span class="ltr">0556666755</span></a>
            <a href="https://wa.me/966556666755"><i class="fa-brands fa-whatsapp"></i> <span>ساره</span> <span class="ltr">0556666755</span></a>
        </div>

        <div class="copyright">
            أحدُ مشاريع شركة السليمان العقارية
            by Alsoliman Real Estate Co.

        </div>

        <div class="botom-img"><img src="{{url('')}}/theme/images/blue/l-im.png" alt=""></div>

    </div>


</div>

</body>

</html>
