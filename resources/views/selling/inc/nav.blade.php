<!-- Sidebar navigation-->
<nav class="sidebar-nav">
    <ul id="sidebarnav">
        <li class="nav-small-cap">MENU</li>


        <li @if(Request::is('selling.admin')) class="active" @endif>
            <a href="{{route('selling.admin')}}" ><i class="mdi mdi-home"></i><span >Home</span></a></li>

        <li @if(Request::is('selling.setting')) class="active" @endif>
            <a href="{{route('selling.setting')}}" ><i class="mdi mdi-chip"></i><span >Setting</span></a></li>
            
        <li @if(Request::is('selling.leads')) class="active" @endif>
                <a href="{{route('selling.leads')}}" ><i class="mdi mdi-chip"></i><span >Leads</span></a></li>
    
            
        <li @if(Request::is('selling-admin/units*')) class="active" @endif>
            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-apps"></i><span class="hide-menu">Units</span></a>
            <ul aria-expanded="false" class="collapse">
                <li @if(Route::is('units.index')) class="active" @endif><a href="{{ route('units.index') }}">Units</a></li>
                <li @if(Route::is('units.create')) class="active" @endif><a href="{{ route('units.create') }}">Add New</a></li>
            </ul>
        </li>
            
        <li @if(Request::is('selling-admin/sprojects*')) class="active" @endif>
            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-flag"></i><span class="hide-menu">Projects</span></a>
            <ul aria-expanded="false" class="collapse">
                <li @if(Route::is('sprojects.index')) class="active" @endif><a href="{{ route('sprojects.index') }}">Projects</a></li>
                <li @if(Route::is('sprojects.create')) class="active" @endif><a href="{{ route('sprojects.create') }}">Add New</a></li>
            </ul>
        </li>

        <li @if(Request::is('selling-admin/types*')) class="active" @endif>
            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-filter"></i><span class="hide-menu">Types</span></a>
            <ul aria-expanded="false" class="collapse">
                <li @if(Route::is('types.index')) class="active" @endif><a href="{{ route('types.index') }}">Types</a></li>
                <li @if(Route::is('types.create')) class="active" @endif><a href="{{ route('types.create') }}">Add New</a></li>
            </ul>
        </li>

        <li @if(Request::is('selling-admin/floors*')) class="active" @endif>
            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-buffer"></i><span class="hide-menu">Floors</span></a>
            <ul aria-expanded="false" class="collapse">
                <li @if(Route::is('floors.index')) class="active" @endif><a href="{{ route('floors.index') }}">Floors</a></li>
                <li @if(Route::is('floors.create')) class="active" @endif><a href="{{ route('floors.create') }}">Add New</a></li>
            </ul>
        </li>

        {{-- <li @if(Request::is('selling-admin/specs*')) class="active" @endif>
            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-burst-mode"></i><span class="hide-menu">Specifications</span></a>
            <ul aria-expanded="false" class="collapse">
                <li @if(Route::is('specs.index')) class="active" @endif><a href="{{ route('specs.index') }}">Specifications</a></li>
                <li @if(Route::is('specs.create')) class="active" @endif><a href="{{ route('specs.create') }}">Add New</a></li>
            </ul>
        </li> --}}

        <li @if(Request::is('selling-admin/cities*')) class="active" @endif>
            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-car"></i><span class="hide-menu">Cities</span></a>
            <ul aria-expanded="false" class="collapse">
                <li @if(Route::is('cities.index')) class="active" @endif><a href="{{ route('cities.index') }}">Cities</a></li>
                <li @if(Route::is('cities.create')) class="active" @endif><a href="{{ route('cities.create') }}">Add New</a></li>
            </ul>
        </li>

        <li @if(Request::is('selling-admin/areas*')) class="active" @endif>
            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-directions-fork"></i><span class="hide-menu">Areas</span></a>
            <ul aria-expanded="false" class="collapse">
                <li @if(Route::is('areas.index')) class="active" @endif><a href="{{ route('areas.index') }}">Areas</a></li>
                <li @if(Route::is('areas.create')) class="active" @endif><a href="{{ route('areas.create') }}">Add New</a></li>
            </ul>
        </li>

        <li @if(Request::is('selling-admin/sellers*')) class="active" @endif>
            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-directions-fork"></i><span class="hide-menu">Sellers</span></a>
            <ul aria-expanded="false" class="collapse">
                <li @if(Route::is('sellers.index')) class="active" @endif><a href="{{ route('sellers.index') }}">Sellers</a></li>
                <li @if(Route::is('sellers.create')) class="active" @endif><a href="{{ route('sellers.create') }}">Add New</a></li>
            </ul>
        </li>

        <li class="nav-devider"></li>
        <li class="nav-devider"></li>
    </ul>
</nav>
<!-- End Sidebar navigation -->
