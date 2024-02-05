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

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Project</label>
                            <select name="project_id" id="projects" class="form-control custom-select">
                              <option value="0" selected disabled>select project name</option>
                                @foreach($projects as $project)
                                <option @if($project->id == old('project_id',@$result->project_id)) selected @endif value="{{$project->id}}">{{$project->name->en}}</option>
                                @endforeach
                            </select>
                          </div>
                        </div>
                        
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Type</label>
                            <select name="type_id" id="types" disabled class="form-control custom-select">
                              <option value="0" selected disabled>select type</option>
                                
                            </select>
                          </div>
                        </div>
                        
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Floor</label>
                            <select name="floor_id" class="form-control custom-select">
                              <option value="0" selected disabled>select floor</option>
                                @foreach($floors as $floor)
                                <option @if($floor->id == old('floor_id',@$result->floor_id)) selected @endif value="{{$floor->id}}">{{$floor->name->en}}</option>
                                @endforeach
                            </select>
                          </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label">Unit ID</label>
                          <input type="text" class="form-control" value="{{ old('name',@$result->name) }}" name="name" placeholder="Unit ID">
                        </div>
                    </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label">Rooms</label>
                            <input type="text" class="form-control" value="{{ old('rooms',@$result->rooms) }}" name="rooms" placeholder="Rooms">
                          </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label">Space</label>
                          <input type="text" class="form-control" value="{{ old('space',@$result->space) }}" name="space" placeholder="Space">
                        </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label">Sup space</label>
                        <input type="text" class="form-control" value="{{ old('space_acc',@$result->space_acc) }}" name="space_acc" placeholder="Sup space">
                      </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Price</label>
                      <input type="text" class="form-control" value="{{ old('price',@$result->price) }}" name="price" placeholder="Price">
                    </div>
                </div>

                <div class="col-md-12">
                  <x-textarea title="Accessories" name="accessories" arval="{!! @$result->accessories->ar !!}" enval="{!! @$result->accessories->en !!}" />
              </div>

              <div class="col-md-12">
                <x-textarea title="Specifications" name="specifications" arval="{!! @$result->specifications->ar !!}" enval="{!! @$result->specifications->en !!}" />
            </div>

                @include('admin.inc.gallery', [
                    'name' => 'gallery',
                    'folder' => 'uploads/units/',
                    'results' => old('gallery',@$result->gallery)
                ])

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-control custom-select">
                      <option value="0">Sale</option>
                      <option value="1">Hold</option>
                      <option value="2">Sold</option>
                      <option value="3">Soon</option>
                        
                    </select>
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

@push('script')
{{-- <script> --}}
  
  $('#projects').on('change', function(){
    var id = $('option:selected', this).val();
    $.ajax({
      url: '{{ route('types.list') }}',
      type: 'GET',
      data: {
        id: id
      },
      beforeSend: () => {
          $(this).prop('disabled', true)
          $('#types').prop('disabled', true).html('<option value="0" >loading...</option>')
      },
      error: (jqXHR, textStatus, errorThrown)=>{
          $(this).prop('disabled', false)
          $('#types').prop('disabled', false).html('<option value="0" >No Types</option>')
      },
      success: (data)=>{
        $(this).prop('disabled', false)
        $('#types').prop('disabled', false).html(data.list)
        @if(@$update)
        $('#types').val({{@$result->type_id}});
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
  $('#projects').trigger('change');
  $('#status').val({{@$result->status}});
  @endif
{{-- </script> --}}
@endpush

@endsection
