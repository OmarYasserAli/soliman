</div>
    <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer">
                © {{date('Y')}} Alsoliman
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->

    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    @include('admin.inc.colors')
    <form action="{{ route('admin.logout') }}" id="logout-form" method="POST" style="display:none">@csrf</form>
    <script src="{{url('back-assets')}}/js/jquery.min.js"></script>
    <script src="{{url('back-assets')}}/js/jquery-ui.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{url('back-assets')}}/js/tether.min.js"></script>
    <script src="{{url('back-assets')}}/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{url('back-assets')}}/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="{{url('back-assets')}}/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="{{url('back-assets')}}/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="{{url('back-assets')}}/js/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="{{url('back-assets')}}/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
<script>
    $(function(){


        $('.logout-hand').click(function(event) {
            event.preventDefault();
            if(confirm('Are You Sure?')){
                document.getElementById('logout-form').submit();
            }
        });

        $('.switch-form-head span').click(function() {
            var lng = $(this).attr('data-lng');
            $(this).closest('.switch-form-head').find('span').removeClass('active');
            $(this).addClass('active');
            $(this).closest('.switch-form').find('.switch-form-item').hide().closest('.switch-form').find('.switch-form-item-'+lng).show();

        });

        $("*[data-theme]").click(function (e) {
            e.preventDefault();
            var currentStyle = $(this).attr('data-theme');
            localStorage.setItem('theme', currentStyle);
            $('#theme').attr({ href: '/back-assets/css/colors/' + currentStyle + '.css' })
        });

        $('#themecolors').on('click', 'a', function () {
            $('#themecolors li a').removeClass('working');
            $(this).addClass('working')
        });

        function get(name) {
            var color = localStorage.getItem(name);
            return color ? color : 'red';
        }

        var currentTheme = get('theme');
        if (currentTheme) {
            $('#theme').attr({ href: '/back-assets/css/colors/' + currentTheme + '.css' });
        }

    })
</script>
<script>
    $(function() {
        @stack('script')
    })
        function readImgURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    if($(input).hasClass('file')){
                        $(input).prev('span').html(input.files[0].type+'<small>'+input.files[0].name+'</small>');
                        return;
                    }
                    if($(input).hasClass('gallery')){
                        if (input.files[0].type.match('image.*')) {
                            $(input).closest('.gallery-item').prepend('<img src="'+e.target.result+'"/>');
                        }
                        return;
                    }
                    if (input.files[0].type.match('image.*')) {
                        $(input).prev('img').attr('src', e.target.result);
                    }else{
                        $(input).val('');
                        $(input).prev('img').attr('src', '{{url("back-assets/images/placeholder.jpeg")}}');

                    }
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
</script>

</body>

</html>
