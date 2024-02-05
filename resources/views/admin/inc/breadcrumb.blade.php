<!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-6 col-8 align-self-center">
                <ol class="breadcrumb">
                    @if(isset($page_breadcrumb))
                        @foreach($page_breadcrumb as $pg)
                            <li class="breadcrumb-item @if($loop->last) active @endif"><a @if(!$loop->last) href="javascript:void(0)" @endif >{{$pg}}</a></li>
                        @endforeach
                    @endif
                </ol>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
