@extends('admin.layout')

@section('body')

<!-- Row -->
<div class="row">
  <div class="col-lg-12">
      <div class="card card-outline-info">
          <div class="card-block">
              <form action="{{ @$update ? route($route.'.update', @$result->id) : route($route.'.store') }}" method="post" >
                @csrf
                @if(@$update) @method('PUT') @endif
                  <div class="form-body">

                      <div class="row p-t-20">
                        <div class="col-md-12">
                            <div class="form-group">
                              <label class="control-label">Title</label>
                              <input type="text" class="form-control" value="{{ old('title',@$result->title) }}" name="title" placeholder="Title">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">English Slug</label>
                              <input type="text" class="form-control" value="{{ old('slug',@$result->slug) }}" name="slug" placeholder="English Slug">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">Arabic Slug</label>
                              <input type="text" class="form-control" value="{{ old('slug_ar',@$result->slug_ar) }}" name="slug_ar" placeholder="Arabic Slug">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                              <label class="control-label">Whats App</label>
                              <input type="text" class="form-control" value="{{ old('wapp',@$result->wapp) }}" name="wapp" placeholder="Whats App">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                              <label class="control-label">Phone</label>
                              <input type="text" class="form-control" value="{{ old('phone',@$result->phone) }}" name="phone" placeholder="Phone">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                              <label class="control-label">Map</label>
                              <input type="text" class="form-control" value="{{ old('map',@$result->map) }}" name="map" placeholder="Map">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                              <label class="control-label">Info</label>
                              <input type="text" class="form-control" value="{{ old('info',@$result->info) }}" name="info" placeholder="Info">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Status</label>
                                <div class="form-check">
                                    <label class="custom-control custom-radio">
                                        <input id="radio3" name="active" type="radio" value="1" @if(@$result->active == 1) checked @endif class="custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">Yes</span>
                                    </label>
                                    <label class="custom-control custom-radio">
                                        <input id="radio4" name="active" type="radio" @if(@$result->active == 0) checked @endif value="0" class="custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">No</span>
                                    </label>
                                </div>
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
