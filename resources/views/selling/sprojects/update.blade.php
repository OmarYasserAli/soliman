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

                        <div class="col-md-12">
                            <x-image title="Cover" name="cover" val="{!! !empty($cover=@$result->cover) ? 'sprojects/'.$cover : '' !!}" />
                        </div>

                        <div class="col-md-12">
                            <x-image title="Logo" name="logo" val="{!! !empty($logo=@$result->logo) ? 'sprojects/'.$logo : '' !!}" />
                        </div>

                        <div class="col-md-6">
                          <x-input title="Name" name="name" arval="{{ old('name.ar', @$result->name->ar) }}" enval="{{ old('name.en', @$result->name->en) }}" />
                          </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label">Slug</label>
                            <input type="text" class="form-control" value="{{ old('slug',@$result->slug) }}" name="slug" placeholder="Slug">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Type</label>
                            <select name="type" id="type" class="form-control custom-select">
                              <option value="0">Apartment</option>
                              <option value="1">Building</option>
                              <option value="2">Villas</option>
                                
                            </select>
                        </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label">Project ID</label>
                            <input type="text" class="form-control" value="{{ old('original_id',@$result->original_id) }}" name="original_id" placeholder="Project ID">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>City</label>
                            <select name="city_id" id="city" class="form-control custom-select">
                              <option value="0" selected disabled>choose city</option>
                                @foreach($cities as $city)
                                <option @if($city->id == old('city_id',@$result->city_id)) selected @endif value="{{$city->id}}">{{$city->name->en}}</option>
                                @endforeach
                            </select>
                        </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Area</label>
                            <select name="area_id" id="area" class="form-control custom-select">
                              <option value="0" selected disabled>choose area</option>
                                
                            </select>
                        </div>
                        </div>


                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label">Units count</label>
                            <input type="text" class="form-control" value="{{ old('ucount',@$result->ucount) }}" name="ucount" placeholder="Units count">
                          </div>
                        </div>


                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label">Buildings count</label>
                            <input type="text" class="form-control" value="{{ old('buildings_count',@$result->buildings_count) }}" name="buildings_count" placeholder="Buildings count">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label">Floors count</label>
                            <input type="text" class="form-control" value="{{ old('floors_max',@$result->floors_max) }}" name="floors_max" placeholder="Floors count">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label">Tour 360</label>
                            <input type="text" class="form-control" value="{{ old('url360',@$result->url360) }}" name="url360" placeholder="Tour 360">
                          </div>
                        </div>

                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label class="control-label">Profile</label>
                                @if(@$result->profile)
                                    <input type="text" class="form-control disabled" disabled value="{{ old('profile', @$result->profile ) }}">
                                @endif
                                <input type="hidden" class="form-control" value="{{ old('profile',  @$result->profile  ) }}" name="profile" placeholder="Profile">
                                <input type="file" class="form-control"  name="profile_file">
                            </div>


                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label">Location</label>
                            <input type="text" class="form-control" value="{{ old('location',@$result->location) }}" name="location" placeholder="Location">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Status</label>
                            <select name="status" id="status" class="form-control custom-select">
                              <option value="0">Sale</option>
                              {{-- <option value="1">Hold</option> --}}
                              <option value="2">Sold</option>
                              <option value="3">Soon</option>
                                
                            </select>
                        </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Activation</label>
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


                        

                        @include('admin.inc.gallery', [
                            'name' => 'gallery',
                            'i' => 1,
                            'folder' => 'uploads/sprojects/',
                            'results' => old('gallery',@$result->gallery)
                        ])

                        @include('admin.inc.gallery', [
                          'title' => 'Construction stages',
                            'i' => 2,
                          'name' => 'igallery',
                          'folder' => 'uploads/sprojects/',
                          'results' => old('igallery',@$result->igallery)
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

@push('script')
{{-- <script> --}}
  
  $('#city').on('change', function(){
    var id = $('option:selected', this).val();
    $.ajax({
      url: '{{ route('areas.list') }}',
      type: 'GET',
      data: {
        id: id
      },
      beforeSend: () => {
          $(this).prop('disabled', true)
          $('#area').prop('disabled', true).html('<option value="0" >loading...</option>')
      },
      error: (jqXHR, textStatus, errorThrown)=>{
          $(this).prop('disabled', false)
          $('#area').prop('disabled', false).html('<option value="0" >No Areas</option>')
      },
      success: (data)=>{
        console.log(data)
        $(this).prop('disabled', false)
        $('#area').prop('disabled', false).html(data.list)
        @if(@$update)
        $('#area').val({{@$result->area_id}});
        @endif
          {{-- if(data.status == 'success'){
              form.trigger('reset')
          }
          $(this).html('<small>'+data.msg+'</small>')
          setTimeout(()=>{
              $(this).prop('disabled', false)
              $(this).text('سجل اهتمامك')
          }, 4000) --}}
      }
  })
  })
  @if(@$update)
  $('#city').trigger('change');
  $('#status').val({{@$result->status}});
  $('#type').val({{@$result->type}});
  @endif
{{-- </script> --}}
@endpush

@endsection
