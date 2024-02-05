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

                        @foreach ( (new App\Models\Product)->getModelUniqueImageToFormInputNames() as $key)
                            @include('enhance.admin.partials._imageDetails', ['key' => $key])
                        @endforeach

                        @if ((new App\Models\Product)->hasSeoTools)
                            @include('enhance.admin.partials._seotools')
                        @endif

                        @if ((new App\Models\Product)->hasScripts)
                            @include('enhance.admin.partials._headerAndFooterScripts')
                        @endif

                        <div class="col-md-12">
                            <div class="form-group">
                              <label class="control-label">One Land Size</label>
                              <input type="text" class="form-control" value="{{ old('land_size',@$result->land_size) }}" name="land_size" placeholder="One Land Size">
                            </div>
                        </div>

                        <div class="col-md-6">


                            <div class="form-group">
                                <label class="control-label">Profile URL</label>
                                @if(@$result->profile)
                                    <input type="text" class="form-control disabled" disabled value="{{ old('profile',  @$result->profile  ) }}">
                                @endif
                                <input type="hidden" class="form-control" value="{{ old('profile',  @$result->profile  ) }}" name="profile" placeholder="Profile">
                                <input type="file" class="form-control"  name="profile_file">
                            </div>


                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">View 360 URL</label>
                              <input type="text" class="form-control" value="{{ old('f360',@$result->f360) }}" name="f360" placeholder="View 360">
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
                          @php
                            $features = collect(config('features'))->where('type', 'feature');
                            $garuntees = collect(config('features'))->where('type', 'garuntee');
                          @endphp

                        <div class="col-md-12">
                            <div class="features-list">
                                <label for="">Features</label>
                                <div class="features-list-co">
                                    @foreach($features as $key=>$feature)
                                        <div class="features-list-item">
                                            <input type="checkbox" @if(in_array($key, (array)@$result->features)) checked @endif id="key_{{$key}}" name="features[]" value="{{$key}}">
                                            <label for="key_{{$key}}">{{$feature['ar']}}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="features-list">
                                <label for="">Garuntees</label>
                                <div class="features-list-co">
                                    @foreach($garuntees as $key=>$garuntee)
                                        <div class="features-list-item">
                                            <input type="checkbox" @if(in_array($key, (array)@$result->garuntees)) checked @endif id="key_{{$key}}" name="garuntees[]" value="{{$key}}">
                                            <label for="key_{{$key}}">{{$garuntee['ar']}}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        @include('admin.inc.gallery', [
                            'name' => 'gallery',
                            'folder' => 'uploads/products/',
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
