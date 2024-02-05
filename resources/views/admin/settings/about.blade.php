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
                            <x-image title="Image" name="about_image" val="{!! @$set->about_image !!}" />
                          </div>

                          <div class="col-md-12">
                            <x-textarea title="Image Title" name="about_title" arval="{!! @$set->about_title->ar !!}" enval="{!! @$set->about_title->en !!}" />

                            </div>

                            <div class="col-md-6">
                                <x-input title="Title" name="amtitle" arval="{!! @$set->amtitle->ar !!}" enval="{!! @$set->amtitle->en !!}" />

                          </div>
                            <div class="col-md-6">
                                <x-textarea title="Breif" name="breif" arval="{!! @$set->breif->ar !!}" enval="{!! @$set->breif->en !!}" />
                            </div>

                            <div class="col-md-6">
                              <x-textarea title="Vision" name="vision" arval="{!! @$set->vision->ar !!}" enval="{!! @$set->vision->en !!}" />
                          </div>

                            <div class="col-md-6">
                              <x-textarea title="Mession" name="mission" arval="{!! @$set->mission->ar !!}" enval="{!! @$set->mission->en !!}" />
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
