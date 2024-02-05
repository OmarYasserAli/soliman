
    <footer class="">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3 col-lg-2">
                    <div class="footer-menu">
                        <p>{{ __('site.footer.sitemap') }}</p>
                        <ul>
                            <li><a href="{{route('home')}}">{{ __('site.nav.home') }}</a></li>
                            <li><a href="{{route('about')}}">{{ __('site.nav.about') }}</a></li>
                            <li><a href="{{route('home')}}#services">{{ __('site.nav.services') }}</a></li>
                            <li><a href="{{route('investors')}}">{{ __('site.nav.investor') }}</a></li>
                            <li><a href="{{route('contact')}}">{{ __('site.nav.contact') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                <div class="footer-menu">
                        <p>{{ __('site.footer.rules') }}</p>
                        <ul>
                            <li><a href="{{ @$set->privecy_page }}">{{ __('site.footer.privecy') }}</a></li>
                            <li><a href="{{ @$set->terms_page }}">{{ __('site.footer.terms') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3 col-lg-3">
                <div class="footer-menu">
                        <p>{{ __('site.footer.branches') }}</p>
                        <ul>
                            <li><a >{{ __('site.footer.riyadh') }}</a></li>
                            <li><a >{{ __('site.footer.dhahran') }}</a></li>
                            <li><a >{{ __('site.footer.medina') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3 col-lg-4">
                    <div class="soliman-newsletter">
                        <p>{{ __('site.footer.subscribe_phrase') }}</p>
                        <div class="soliman-footer-newsletter-co">
                            <input type="text" placeholder="{{ __('site.footer.subscribe_input') }}" id="newsletter-input">
                            @csrf
                            <a id="newsletter-btn" class="newsletter-submit-btn" href="#"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-up" role="img" xmlns="https://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-arrow-up fa-w-14"><path fill="#fff" d="M4.465 263.536l7.07 7.071c4.686 4.686 12.284 4.686 16.971 0L207 92.113V468c0 6.627 5.373 12 12 12h10c6.627 0 12-5.373 12-12V92.113l178.494 178.493c4.686 4.686 12.284 4.686 16.971 0l7.07-7.071c4.686-4.686 4.686-12.284 0-16.97l-211.05-211.05c-4.686-4.686-12.284-4.686-16.971 0L4.465 246.566c-4.687 4.686-4.687 12.284 0 16.97z" class=""></path></svg></a>
                        </div>
                        <div class="soliman-footer-newsletter-alert"></div>
                    </div>
                </div>
            </div>

            <div class="footer-copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-2 col-lg-2 order-1 order-md-1 order-lg-1">
                            <a href="{{ url('') }}" class="flogo"><img src="{{url('theme')}}/images/logo.svg" alt="{{ @$set->name->$lang }}"></a>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-7 order-3 order-md-2 order-lg-2">
                            <span> {{ __('site.Alsoliman Real Estate Company') }} {{ now()->year }} ©</span>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 order-2 order-md-3 order-lg-3">
                        <div class="soliman-footer-social">
                            <div class="soliman-footer-social-icons">
                                <a target="_blank" href="{{ @$set->twitter }}">

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"  fill="currentColor"><!--! Font Awesome Pro 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></svg>
                                </a>
                                <a target="_blank" href="{{ @$set->instagram }}">
                                    <svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path></svg>
                                </a>
                                <a target="_blank" href="{{ @$set->youtube }}">
                                    <svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z" ></path></svg>
                                </a>
                                <a target="_blank" href="{{ @$set->linkedin }}">
                                    <svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z" ></path></svg>
                                </a>
                            </div>
                            <a target="_blank" href="{{ @$set->profile }}">{{ __('site.footer.profile') }}</a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div id="cookies-banner">
        <p>نحن نستخدم ملفات تعريف الإرتباط لمنحنك أفضل تجربة على موقعنا الإلكتروني. اقرأ المزيد سياسة ملفات تعريف الارتباط - سياسة الخصوصية</p>
        <button id="accept-cookies">موافق</button>
    </div>
    <script src="{{url('theme')}}/style/jquery-3.6.0.min.js"></script>
    <script src="{{url('theme')}}/style/slick.js"></script>
    <script src="{{url('theme')}}/style/wow.min.js"></script>
    @stack('footer')

    {!! @$set->footer_script !!}

    <script src="{{url('theme')}}/style/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
    body.coo{
        padding-top: 80px;
    }
    #cookies-banner {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        background-color: #58595B;
        color: #fff;
        padding: 10px;
        text-align: center;
        height: 80px;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        text-align: center;
        z-index: 9999999;
    }

    #accept-cookies {
        background-color: #008FC5;
        color: #fff;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        margin-top: 5px;
        width: 120px;


    }
   .coo header .soliman-navbar{
        top: 80px;
    }
    .coo  header .soliman-navbar.stick{
        top: 0;

    }
   @media(max-width: 640px){
       .coo header .soliman-navbar{
           top: 140px;
       }
       #cookies-banner {
            height: 140px;
           font-size: 12px;

       }
       .coo  header .soliman-navc {
            padding-top: 93px;
       }
   }
</style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var cookiesBanner = document.getElementById("cookies-banner");
            var acceptButton = document.getElementById("accept-cookies");
            const bodyElement = document.querySelector('body');

            bodyElement.classList.add('coo');

            acceptButton.addEventListener("click", function() {
                cookiesBanner.style.display = "none";
                setCookie("cookiesAccepted", "true", 365);
                bodyElement.classList.remove('coo');


            });

            if (getCookie("cookiesAccepted") === "true") {
                cookiesBanner.style.display = "none";
                // Remove the class from the body's classList
                bodyElement.classList.remove('coo');
            }


            // Send Newsletter GTM Datalayer
            var newsletterButton = document.getElementById('newsletter-btn');
            var newsletterInput = document.getElementById('newsletter-input');

            newsletterButton.addEventListener('click', function() {
                // Push an event to the data layer
                window.dataLayer = window.dataLayer || [];
                window.dataLayer.push({
                    'event': 'newsletter_signup',
                    'email': newsletterInput.value
                });
            });


        });

        function setCookie(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }

        function getCookie(name) {
            var nameEQ = name + "=";
            var cookies = document.cookie.split(";");
            for (var i = 0; i < cookies.length; i++) {
                var cookie = cookies[i];
                while (cookie.charAt(0) == " ") {
                    cookie = cookie.substring(1, cookie.length);
                }
                if (cookie.indexOf(nameEQ) == 0) {
                    return cookie.substring(nameEQ.length, cookie.length);
                }
            }
            return null;
        }
    </script>
    </body>


</html>
