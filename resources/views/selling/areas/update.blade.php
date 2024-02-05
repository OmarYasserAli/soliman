@extends('selling.layout')

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


                        <div class="col-md-8">
                          <div class="form-group">
                            <label>City</label>
                            <select name="city_id" class="form-control custom-select">
                              <option value="0" selected disabled>choose city</option>
                                @foreach($cities as $city)
                                <option @if($city->id == old('city_id',@$result->city_id)) selected @endif value="{{$city->id}}">{{$city->name->en}}</option>
                                @endforeach
                            </select>
                        </div>
                        </div>


                        <div class="col-md-8">
                          <x-input title="Name" name="name" arval="{{ old('name.ar', @$result->name->ar) }}" enval="{{ old('name.en', @$result->name->en) }}" />
                          </div>

                        {{-- <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label">Slug</label>
                            <input type="text" class="form-control" value="{{ old('slug',@$result->slug) }}" name="slug" placeholder="Slug">
                          </div>
                        </div> --}}

                        


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
