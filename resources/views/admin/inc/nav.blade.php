<!-- Sidebar navigation-->
<nav class="sidebar-nav">
    <ul id="sidebarnav">
        <li class="nav-small-cap">MENU</li>


        <li @if(Request::is('admin')) class="active" @endif>
            <a href="{{route('admin.home')}}" ><i class="mdi mdi-home"></i><span >Home</span></a></li>
        <li><a href="{{route('admin.bluedar')}}" ><i class="mdi mdi-star"></i><span >BlueDar</span></a></li>
        <li @if(Request::is('admin/settings*')) class="active" @endif>
            <a class="has-arrow " href="#" aria-expanded="false">
                <i class="mdi mdi-gauge"></i><span class="hide-menu">Settings</span></a>
            <ul aria-expanded="false" class="collapse">
                <li @if(Route::is('users.settings.form')) class="active" @endif><a href="{{ route('admin.settings.form') }}">General Settings</a></li>
                <li @if(Route::is('users.contact.form')) class="active" @endif><a href="{{ route('admin.contact.form') }}">Contact Settings</a></li>
                <li @if(Route::is('users.about.form')) class="active" @endif><a href="{{ route('admin.about.form') }}">About Settings</a></li>
                <li @if(Route::is('users.investor.form')) class="active" @endif><a href="{{ route('admin.investor.form') }}">Investor Settings</a></li>
                <li @if(Route::is('users.media.form')) class="active" @endif><a href="{{ route('admin.media.form') }}">Media Settings</a></li>
                <li @if(Route::is('users.pages.form')) class="active" @endif><a href="{{ route('admin.pages.form') }}">Pages Settings</a></li>
                <li @if(Route::is('users.numbers.form')) class="active" @endif><a href="{{ route('admin.numbers.form') }}">Numbers Settings</a></li>
                <li @if(Route::is('users.settings.campain')) class="active" @endif><a href="{{ route('admin.settings.campain') }}">Campain Settings</a></li>
                <li @if(Route::is('admin.settings.bludarform')) class="active" @endif><a href="{{ route('admin.settings.bludarform') }}">BlueDar Settings</a></li>
            </ul>
        </li>


        <li @if(Request::is('admin/seo-pages*')) class="active" @endif>
            <a class="has-arrow " href="#" aria-expanded="false">
                <i class="mdi mdi-star"></i><span class="hide-menu">SEO For Pages</span></a>
            <ul aria-expanded="false" class="collapse">
                <li @if(Route::is('admin/home/edit')) class="active" @endif><a href="{{ route('admin.seo-pages.edit', 'home') }}">Home</a></li>
                <li @if(Route::is('admin/about_us/edit')) class="active" @endif><a href="{{ route('admin.seo-pages.edit', 'about_us') }}">About Us</a></li>
                <li @if(Route::is('admin/booking_system/edit')) class="active" @endif><a href="{{ route('admin.seo-pages.edit', 'booking_system') }}">Booking System</a></li>
                <li @if(Route::is('admin/news/edit')) class="active" @endif><a href="{{ route('admin.seo-pages.edit', 'news') }}">News</a></li>
                <li @if(Route::is('admin/events/edit')) class="active" @endif><a href="{{ route('admin.seo-pages.edit', 'events') }}">Events</a></li>
                <li @if(Route::is('admin/files/edit')) class="active" @endif><a href="{{ route('admin.seo-pages.edit', 'files') }}">Files</a></li>
                <li @if(Route::is('admin/investors_relation/edit')) class="active" @endif><a href="{{ route('admin.seo-pages.edit', 'investors_relation') }}">Investors Relation</a></li>
                <li @if(Route::is('admin/molhem/edit')) class="active" @endif><a href="{{ route('admin.seo-pages.edit', 'molhem') }}">Molhem</a></li>
                <li @if(Route::is('admin/contact/edit')) class="active" @endif><a href="{{ route('admin.seo-pages.edit', 'contact') }}">Contact</a></li>
                <li @if(Route::is('admin/bluedar/edit')) class="active" @endif><a href="{{ route('admin.seo-pages.edit', 'bluedar') }}">Bluedar</a></li>
            </ul>
        </li>

        <li @if(Request::is('admin/campains*')) class="active" @endif>
            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-book"></i><span class="hide-menu">Campains</span></a>
            <ul aria-expanded="false" class="collapse">
                <li @if(Route::is('campains.index')) class="active" @endif><a href="{{ route('campains.index') }}">Campains</a></li>
                <li @if(Route::is('campains.create')) class="active" @endif><a href="{{ route('campains.create') }}">Add New</a></li>
            </ul>
        </li>
        <li @if(Request::is('admin/forms*')) class="active" @endif>
            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-book"></i><span class="hide-menu">Forms</span></a>
            <ul aria-expanded="false" class="collapse">
                <li @if(Route::is('forms.data')) class="active" @endif><a href="{{ route('admin.forms.data') }}">data</a></li>
                <li @if(Route::is('forms.index')) class="active" @endif><a href="{{ route('forms.index') }}">forms</a></li>
                <li @if(Route::is('forms.create')) class="active" @endif><a href="{{ route('forms.create') }}">Add New</a></li>
            </ul>
        </li>
        <li @if(Request::is('admin/users*')) class="active" @endif>
            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Users</span></a>
            <ul aria-expanded="false" class="collapse">
                <li @if(Route::is('users.index')) class="active" @endif><a href="{{ route('users.index') }}">Users</a></li>
                <li @if(Route::is('users.create')) class="active" @endif><a href="{{ route('users.create') }}">Add New</a></li>
            </ul>
        </li>
        <li @if(Request::is('admin/products*')) class="active" @endif>
            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-auto-fix"></i><span class="hide-menu">Products</span></a>
            <ul aria-expanded="false" class="collapse">
                <li @if(Route::is('products.index')) class="active" @endif><a href="{{ route('products.index') }}">Products</a></li>
                <li @if(Route::is('products.create')) class="active" @endif><a href="{{ route('products.create') }}">Add New</a></li>
            </ul>
        </li>
        <li @if(Request::is('admin/projects*')) class="active" @endif>
            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-format-quote"></i><span class="hide-menu">Projects</span></a>
            <ul aria-expanded="false" class="collapse">
                <li @if(Route::is('projects.index')) class="active" @endif><a href="{{ route('projects.index') }}">Projects</a></li>
                <li @if(Route::is('projects.create')) class="active" @endif><a href="{{ route('projects.create') }}">Add New</a></li>
            </ul>
        </li>
        <li @if(Request::is('admin/molhem*')) class="active" @endif>
            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-hand-pointing-right"></i><span class="hide-menu">Molhem News</span></a>
            <ul aria-expanded="false" class="collapse">
                <li @if(Route::is('molhem.index')) class="active" @endif><a href="{{ route('molhem.index') }}">Molhem News</a></li>
                <li @if(Route::is('molhem.create')) class="active" @endif><a href="{{ route('molhem.create') }}">Add New</a></li>
            </ul>
        </li>
        <li @if(Request::is('admin/logos*')) class="active" @endif>
            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-format-paint"></i><span class="hide-menu">Logos</span></a>
            <ul aria-expanded="false" class="collapse">
                <li @if(Route::is('logos.index')) class="active" @endif><a href="{{ route('logos.index') }}">Logos</a></li>
                <li @if(Route::is('logos.create')) class="active" @endif><a href="{{ route('logos.create') }}">Add New</a></li>
            </ul>
        </li>
        <li @if(Request::is('admin/slider*')) class="active" @endif>
            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-image"></i><span class="hide-menu">Slider</span></a>
            <ul aria-expanded="false" class="collapse">
                <li @if(Route::is('slider.index')) class="active" @endif><a href="{{ route('slider.index') }}">Slider</a></li>
                <li @if(Route::is('slider.create')) class="active" @endif><a href="{{ route('slider.create') }}">Add New</a></li>
            </ul>
        </li>
        <li @if(Request::is('admin/companies*')) class="active" @endif>
            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-bank"></i><span class="hide-menu">Companies</span></a>
            <ul aria-expanded="false" class="collapse">
                <li @if(Route::is('companies.index')) class="active" @endif><a href="{{ route('companies.index') }}">Companies</a></li>
                <li @if(Route::is('companies.create')) class="active" @endif><a href="{{ route('companies.create') }}">Add New</a></li>
            </ul>
        </li>
        <li @if(Request::is('admin/news*')) class="active" @endif>
            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-book-open-page-variant"></i><span class="hide-menu">News</span></a>
            <ul aria-expanded="false" class="collapse">
                <li @if(Route::is('news.index')) class="active" @endif><a href="{{ route('news.index') }}">News</a></li>
                <li @if(Route::is('news.create')) class="active" @endif><a href="{{ route('news.create') }}">Add New</a></li>
            </ul>
        </li>
        <li @if(Request::is('admin/pages*')) class="active" @endif>
            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-folder-multiple"></i><span class="hide-menu">Pages</span></a>
            <ul aria-expanded="false" class="collapse">
                <li @if(Route::is('pages.index')) class="active" @endif><a href="{{ route('pages.index') }}">Pages</a></li>
                <li @if(Route::is('pages.create')) class="active" @endif><a href="{{ route('pages.create') }}">Add New</a></li>
            </ul>
        </li>
        <li @if(Request::is('admin/services*')) class="active" @endif>
            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Services</span></a>
            <ul aria-expanded="false" class="collapse">
                <li @if(Route::is('services.index')) class="active" @endif><a href="{{ route('services.index') }}">Services</a></li>
                <li @if(Route::is('services.create')) class="active" @endif><a href="{{ route('services.create') }}">Add New</a></li>
            </ul>
        </li>
        <li @if(Request::is('admin/newsletters*')) class="active" @endif>
            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-email"></i><span class="hide-menu">Newsletters</span></a>
            <ul aria-expanded="false" class="collapse">
                <li @if(Route::is('newsletters.index')) class="active" @endif><a href="{{ route('newsletters.index') }}">Newsletters</a></li>
                <li @if(Route::is('newsletters.create')) class="active" @endif><a href="{{ route('newsletters.create') }}">Add New</a></li>
            </ul>
        </li>
        <li @if(Request::is('admin/events*')) class="active" @endif>
            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-flag-variant"></i><span class="hide-menu">Events</span></a>
            <ul aria-expanded="false" class="collapse">
                <li @if(Route::is('events.index')) class="active" @endif><a href="{{ route('events.index') }}">Events</a></li>
                <li @if(Route::is('events.create')) class="active" @endif><a href="{{ route('events.create') }}">Add New</a></li>
            </ul>
        </li>
        <li @if(Request::is('admin/files*')) class="active" @endif>
            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-file"></i><span class="hide-menu">Files</span></a>
            <ul aria-expanded="false" class="collapse">
                <li @if(Route::is('files.index')) class="active" @endif><a href="{{ route('files.index') }}">Files</a></li>
                <li @if(Route::is('files.create')) class="active" @endif><a href="{{ route('files.create') }}">Add New</a></li>
            </ul>
        </li>
        <li @if(Request::is('admin/values*')) class="active" @endif>
            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-filter"></i><span class="hide-menu">Values</span></a>
            <ul aria-expanded="false" class="collapse">
                <li @if(Route::is('values.index')) class="active" @endif><a href="{{ route('values.index') }}">Values</a></li>
                <li @if(Route::is('values.create')) class="active" @endif><a href="{{ route('values.create') }}">Add New</a></li>
            </ul>
        </li>
        <li @if(Request::is('admin/investors*')) class="active" @endif>
            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-star"></i><span class="hide-menu">Investors</span></a>
            <ul aria-expanded="false" class="collapse">
                <li @if(Route::is('investors.index')) class="active" @endif><a href="{{ route('investors.index') }}">Investors</a></li>
                <li @if(Route::is('investors.create')) class="active" @endif><a href="{{ route('investors.create') }}">Add New</a></li>
            </ul>
        </li>
        <li @if(Request::is('admin/igroups*')) class="active" @endif>
            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-folder-star"></i><span class="hide-menu">Investments Groups</span></a>
            <ul aria-expanded="false" class="collapse">
                <li @if(Route::is('igroups.index')) class="active" @endif><a href="{{ route('igroups.index') }}">Investments Groups</a></li>
                <li @if(Route::is('igroups.create')) class="active" @endif><a href="{{ route('igroups.create') }}">Add New</a></li>
            </ul>
        </li>
        <li @if(Request::is('admin/managements*')) class="active" @endif>
            <a class="has-arrow " href="#" aria-expanded="false"><i class="mdi mdi-account-multiple-plus"></i><span class="hide-menu">Managements</span></a>
            <ul aria-expanded="false" class="collapse">
                <li @if(Route::is('managements.index')) class="active" @endif><a href="{{ route('managements.index') }}">Managements</a></li>
                <li @if(Route::is('managements.create')) class="active" @endif><a href="{{ route('managements.create') }}">Add New</a></li>
            </ul>
        </li>

        <li class="nav-devider"></li>
        <li class="nav-devider"></li>
    </ul>
</nav>
<!-- End Sidebar navigation -->
