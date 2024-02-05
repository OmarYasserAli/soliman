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


                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">Home Phone</label>
                              <input type="text" class="form-control" value="{{ old('home_phone',@$set->home_phone) }}" name="home_phone" placeholder="Phone">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">Home Whatsapp</label>
                              <input type="text" class="form-control" value="{{ old('home_whatsapp',@$set->home_whatsapp) }}" name="home_whatsapp" placeholder="Whatsapp">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">Project Phone</label>
                              <input type="text" class="form-control" value="{{ old('project_phone',@$set->project_phone) }}" name="project_phone" placeholder="Phone">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">Project Whatsapp</label>
                              <input type="text" class="form-control" value="{{ old('project_whatsapp',@$set->project_whatsapp) }}" name="project_whatsapp" placeholder="Whatsapp">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">Product Phone</label>
                              <input type="text" class="form-control" value="{{ old('product_phone',@$set->product_phone) }}" name="product_phone" placeholder="Phone">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">Product Whatsapp</label>
                              <input type="text" class="form-control" value="{{ old('product_whatsapp',@$set->product_whatsapp) }}" name="product_whatsapp" placeholder="Whatsapp">
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
