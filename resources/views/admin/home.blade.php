@extends('admin.layout')

@section('body')

<div class="row">
    <!-- Column -->
    <div class="col-md-6 col-lg-4 col-xlg-4">
        <div class="card card-danger card-info">
            <div class="box bg-info text-center">
                <h1 class="font-light text-white">{{ App\Models\User::count() }}</h1>
                <h6 class="text-white">Users</h6>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-md-6 col-lg-4 col-xlg-4">
        <div class="card card-primary card-danger">
            <div class="box text-center">
                <h1 class="font-light text-white">{{ App\Models\Product::count() }}</h1>
                <h6 class="text-white">Products</h6>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-md-6 col-lg-4 col-xlg-4">
        <div class="card card-danger card-primary">
            <div class="box text-center">
                <h1 class="font-light text-white">{{ App\Models\Project::count() }}</h1>
                <h6 class="text-white">Projects</h6>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-md-6 col-lg-4 col-xlg-4">
        <div class="card card-danger card-info">
            <div class="box text-center">
                <h1 class="font-light text-white">{{ App\Models\Company::count() }}</h1>
                <h6 class="text-white">Company</h6>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-md-6 col-lg-4 col-xlg-4">
        <div class="card card-danger card-danger">
            <div class="box text-center">
                <h1 class="font-light text-white">{{ App\Models\News::count() }}</h1>
                <h6 class="text-white">News</h6>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-md-6 col-lg-4 col-xlg-4">
        <div class="card card-danger card-primary">
            <div class="box text-center">
                <h1 class="font-light text-white">{{ App\Models\Page::count() }}</h1>
                <h6 class="text-white">Page</h6>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-md-6 col-lg-4 col-xlg-4">
        <div class="card card-danger card-info">
            <div class="box text-center">
                <h1 class="font-light text-white">{{ App\Models\Service::count() }}</h1>
                <h6 class="text-white">Service</h6>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-md-6 col-lg-4 col-xlg-4">
        <div class="card card-danger card-danger">
            <div class="box text-center">
                <h1 class="font-light text-white">{{ App\Models\Newsletter::count() }}</h1>
                <h6 class="text-white">Email</h6>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-md-6 col-lg-4 col-xlg-4">
        <div class="card card-danger card-primary">
            <div class="box text-center">
                <h1 class="font-light text-white">{{ App\Models\Event::count() }}</h1>
                <h6 class="text-white">Event</h6>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-md-6 col-lg-4 col-xlg-4">
        <div class="card card-danger card-info">
            <div class="box text-center">
                <h1 class="font-light text-white">{{ App\Models\File::count() }}</h1>
                <h6 class="text-white">File</h6>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-md-6 col-lg-4 col-xlg-4">
        <div class="card card-danger card-danger">
            <div class="box text-center">
                <h1 class="font-light text-white">{{ App\Models\Value::count() }}</h1>
                <h6 class="text-white">Value</h6>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-md-6 col-lg-4 col-xlg-4">
        <div class="card card-danger card-primary">
            <div class="box text-center">
                <h1 class="font-light text-white">{{ App\Models\Investor::count() }}</h1>
                <h6 class="text-white">Investor</h6>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-md-6 col-lg-4 col-xlg-4">
        <div class="card card-danger card-warning">
            <div class="box text-center">
                <h1 class="font-light text-white">{{ App\Models\Management::count() }}</h1>
                <h6 class="text-white">Management</h6>
            </div>
        </div>
    </div>
</div>


@endsection
