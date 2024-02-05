@extends('admin.layout')

@section('body')

<!-- Row -->
<div class="row">
  <div class="col-lg-12">
      <div class="card card-outline-info">
          <div class="card-block">
              <form action="{{ @$update ? route($route.'.update', @$result->id) : route($route.'.store') }}" method="post" enctype="multipart/form-data" >
                @csrf
                @if(@$update) @method('PUT') @endif
                  <div class="form-body">

                      <div class="row p-t-20">

                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Group</label>
                            <select name="group" class="form-control custom-select">
                              <option @if(@$result->group == 0) selected @endif value="0">Board of Directors</option>
                              <option @if(@$result->group == 1) selected @endif value="1">Review Committee</option>
                            </select>
                        </div>
                        </div>

                        <div class="col-md-12">
                            <x-input title="Name" name="name" arval="{!! @$result->name->ar !!}" enval="{!! @$result->name->en !!}" />
                        </div>

                        <div class="col-md-12">
                            <x-input title="Pre Title" name="ptitle" arval="{!! @$result->ptitle->ar !!}" enval="{!! @$result->ptitle->en !!}" />
                        </div>

                        <div class="col-md-12">
                            <x-input title="Title" name="title" arval="{!! @$result->title->ar !!}" enval="{!! @$result->title->en !!}" />
                        </div>

                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Line End</label>
                            <select name="lst" class="form-control custom-select">
                              <option @if(@$result->lst == 0) selected @endif value="0">No</option>
                              <option @if(@$result->lst == 1) selected @endif value="1">Yes</option>
                            </select>
                        </div>
                        </div>

                        @foreach ( (new App\Models\Management)->getModelUniqueImageToFormInputNames() as $key)
                            @include('enhance.admin.partials._imageDetails', ['key' => $key])
                        @endforeach

                    </div><!--/row-->

                  <div class="form-actions">
                      <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> {{ @$update ? 'Update' : 'Add' }}</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div></div>
<!-- Row -->

@endsection
