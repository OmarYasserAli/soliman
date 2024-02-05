@include('selling.inc.header')

<div class=" page-titles">
    <h3 class="text-themecolor m-b-0 m-t-0">{{ @$bread_main }}</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active">{{ @$bread_desc }}</li>
    </ol>
</div>
@include('admin.inc.alert-errors')
@yield('body')

@include('admin.inc.footer')
