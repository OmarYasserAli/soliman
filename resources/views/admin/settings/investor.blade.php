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
                            <x-image title="Image" name="investor_image" val="{!! @$set->investor_image !!}" />
                          </div>

                          <div class="col-md-12">
                            <x-textarea title="Image Title" name="investor_title" arval="{!! @$set->investor_title->ar !!}" enval="{!! @$set->investor_title->en !!}" />

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
