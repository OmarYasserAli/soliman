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
                        @foreach ( (new App\Models\Event)->getModelUniqueImageToFormInputNames() as $key)
                            @include('enhance.admin.partials._imageDetails', ['key' => $key])
                        @endforeach

                        @if ((new App\Models\Event)->hasSeoTools)
                            @include('enhance.admin.partials._seotools')
                        @endif

                        @if ((new App\Models\Event)->hasScripts)
                            @include('enhance.admin.partials._headerAndFooterScripts')
                        @endif

                        <div class="col-md-12">
                            <x-input title="Title" name="title" arval="{!! @$result->title->ar !!}" enval="{!! @$result->title->en !!}" />
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                              <label class="control-label">Date</label>
                              <input type="date" class="form-control" value="{{ old('dt',@$result->dt) }}" name="dt">
                            </div>
                        </div>

                        @include('admin.inc.gallery', [
                            'name' => 'gallery',
                            'folder' => 'uploads/events/',
                            'results' => old('gallery',@$result->gallery)
                        ])

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
