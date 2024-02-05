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
                        @foreach ( (new App\Models\Slider)->getModelUniqueImageToFormInputNames() as $key)
                            @include('enhance.admin.partials._imageDetails', ['key' => $key])
                        @endforeach

                        <div class="col-md-12">
                            <x-input title="Title" name="title" arval="{!! @$result->title->ar !!}" enval="{!! @$result->title->en !!}" />
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                              <label class="control-label">URL</label>
                              <input type="text" class="form-control" value="{{ old('url',@$result->url) }}" name="url" placeholder="URL">
                            </div>
                        </div>
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
