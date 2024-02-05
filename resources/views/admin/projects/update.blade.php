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
                            <x-input title="Title" name="title" arval="{!! @$result->title->ar !!}" enval="{!! @$result->title->en !!}" />
                        </div>

                        <div class="col-md-12">
                            <x-input title="Name" name="name" arval="{!! @$result->name->ar !!}" enval="{!! @$result->name->en !!}" />
                        </div>

                        <div class="col-md-12">
                            <x-textarea title="Breif" name="breif" arval="{!! @$result->breif->ar !!}" enval="{!! @$result->breif->en !!}" />
                        </div>

                        @foreach ( (new App\Models\Project)->getModelUniqueImageToFormInputNames() as $key)
                            @include('enhance.admin.partials._imageDetails', ['key' => $key])
                        @endforeach

                        @if ((new App\Models\Project)->hasSeoTools)
                            @include('enhance.admin.partials._seotools')
                        @endif

                        @if ((new App\Models\Project)->hasScripts)
                            @include('enhance.admin.partials._headerAndFooterScripts')
                        @endif

                        <div class="col-md-12">
                            <div class="form-group">
                              <label class="control-label">Profile URL</label>
                                @if(@$result->profile)
                              <input type="text" class="form-control disabled" disabled value="{{ old('profile', @$result->profile ) }}">
                                @endif
                              <input type="hidden" class="form-control" value="{{ old('profile',  @$result->profile  ) }}" name="profile" placeholder="Profile">
                              <input type="file" class="form-control"  name="profile_file">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                              <label class="control-label">Map</label>
                              <textarea name="map" placeholder="Map" class="form-control">{!! old('map',@$result->map) !!}</textarea>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                              <label class="control-label">Area (square meter)</label>
                              <input type="text" class="form-control" value="{{ old('sizes.area',@$result->sizes->area) }}" name="sizes[area]" placeholder="Area (square meter)">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                              <label class="control-label">Building flat (square meter)</label>
                              <input type="text" class="form-control" value="{{ old('sizes.flat',@$result->sizes->flat) }}" name="sizes[flat]" placeholder="Building flat (square meter)">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                              <label class="control-label">Housing units</label>
                              <input type="text" class="form-control" value="{{ old('sizes.units',@$result->sizes->units) }}" name="sizes[units]" placeholder="Housing units">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                              <label class="control-label">Market value (million riyals)</label>
                              <input type="text" class="form-control" value="{{ old('sizes.value',@$result->sizes->value) }}" name="sizes[value]" placeholder="Market value (million riyals)">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                              <label>Owner</label>
                              <select name="owner" class="form-control custom-select">
                                <option value="0">Select Company</option>
                                @foreach($companies as $company)
                                    <option value="{{$company->id}}" @if($company->id == @$result->owner) selected @endif>{{$company->title->en}}</option>
                                @endforeach
                              </select>
                          </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Developer</label>
                              <select name="developer" class="form-control custom-select">
                                <option >Select Company</option>
                                @foreach($companies as $company)
                                    <option value="{{$company->id}}" @if($company->id == @$result->developer) selected @endif>{{$company->title->en}}</option>
                                @endforeach
                              </select>
                          </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Contractor</label>
                              <select name="contractor" class="form-control custom-select">
                                <option >Select Company</option>
                                @foreach($companies as $company)
                                    <option value="{{$company->id}}" @if($company->id == @$result->contractor) selected @endif>{{$company->title->en}}</option>
                                @endforeach
                              </select>
                          </div>
                          </div>

                        @include('admin.inc.gallery', [
                            'name' => 'gallery',
                            'folder' => 'uploads/projects/',
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
