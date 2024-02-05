@extends('admin.layout')

@section('body')

<!-- Row -->
<div class="row">
  <div class="col-lg-12">
      <div class="card card-outline-info">
          <div class="card-block">
              <form action="{{ route('admin.settings') }}" method="post" enctype="multipart/form-data" >
                @csrf
                  <div class="form-body">
                    <a href="{{ route('campain-contact') }}" target="_blank" class="btn btn-info">Go To Page</a>
                      <div class="row p-t-20">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">Page Title</label>
                              <input type="text" class="form-control" value="{{ old('campain_title',@$set->campain_title) }}" name="campain_title" placeholder="Page Title">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">ًWhatsapp</label>
                              <input type="text" class="form-control" value="{{ old('campain_whatsapp',@$set->campain_whatsapp) }}" name="campain_whatsapp" placeholder="ًWhatsapp">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">Phone</label>
                              <input type="text" class="form-control" value="{{ old('campain_phone',@$set->campain_phone) }}" name="campain_phone" placeholder="Phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">Map</label>
                              <input type="text" class="form-control" value="{{ old('campain_map',@$set->campain_map) }}" name="campain_map" placeholder="Map">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">Info</label>
                              <input type="text" class="form-control" value="{{ old('campain_info',@$set->campain_info) }}" name="campain_info" placeholder="Info">
                            </div>
                        </div>




                    </div><!--/row-->

                  <div class="form-actions">
                      <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Update</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div></div>
<!-- Row -->

@endsection
