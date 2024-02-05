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

                      <div class="row p-t-20">
                        <div class="col-md-12">
                            <x-image title="Image" name="contact_image" val="{!! @$set->contact_image !!}" />
                          </div>

                          <div class="col-md-12">
                              <div class="form-group">
                                <label class="control-label">Profile</label>
                                <input type="text" disabled class="form-control disabled" value="{{ old('profile',@$set->profile) }}" >
                                <input type="file" class="form-control" name="profile" >
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="form-group">
                                <label class="control-label">Map</label>
                                <textarea name="map" placeholder="Map" class="form-control">{!! old('map',@$set->map) !!}</textarea>
                              </div>
                          </div>

                          <div class="col-md-12">
                            <x-textarea title="Image Title" name="contact_title" arval="{!! @$set->contact_title->ar !!}" enval="{!! @$set->contact_title->en !!}" />

                            </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">Phone</label>
                              <input type="text" class="form-control" value="{{ old('phone',@$set->phone) }}" name="phone" placeholder="Phone">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">Fevorite Email</label>
                              <input type="text" class="form-control" value="{{ old('favor_email',@$set->favor_email) }}" name="favor_email" placeholder="Fevorite Email">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">Email</label>
                              <input type="text" class="form-control" value="{{ old('email',@$set->email) }}" name="email" placeholder="Email">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">Twitter</label>
                              <input type="text" class="form-control" value="{{ old('twitter',@$set->twitter) }}" name="twitter" placeholder="Twitter">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">Instagram</label>
                              <input type="text" class="form-control" value="{{ old('instagram',@$set->instagram) }}" name="instagram" placeholder="Instagram">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">Linkedin</label>
                              <input type="text" class="form-control" value="{{ old('linkedin',@$set->linkedin) }}" name="linkedin" placeholder="Linkedin">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">YouTube</label>
                              <input type="text" class="form-control" value="{{ old('youtube',@$set->youtube) }}" name="youtube" placeholder="YouTube">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <x-textarea title="Address - Headquarters" name="address_headquarters" arval="{!! @$set->address_headquarters->ar !!}" enval="{!! @$set->address_headquarters->en !!}" />
                        </div>

                        <div class="col-md-12">
                            <x-textarea title="Address - Dhahran" name="address_dhahran" arval="{!! @$set->address_dhahran->ar !!}" enval="{!! @$set->address_dhahran->en !!}" />
                        </div>

                        <div class="col-md-12">
                            <x-textarea title="Address - Medina" name="address_medina" arval="{!! @$set->address_medina->ar !!}" enval="{!! @$set->address_medina->en !!}" />
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
