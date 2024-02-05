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
                            <x-image title="Header BG Image" name="bluedar_image" val="{!! @$set->bluedar_image !!}" />
                        </div>

                        <div class="col-md-12">
                            <x-textarea title="Header Title" name="bluedar_title" arval="{!! @$set->bluedar_title->ar !!}" enval="{!! @$set->bluedar_title->en !!}" />

                        </div>

                        <div class="col-md-12">
                            <x-image title="About Logo" name="bluedar_logo" val="{!! @$set->bluedar_logo !!}" />
                        </div>


                        <div class="col-md-12">
                            <x-textarea title="Breif" name="bluedar_breif" arval="{!! @$set->bluedar_breif->ar !!}" enval="{!! @$set->bluedar_breif->en !!}" />
                        </div>

                          <div class="col-md-12">
                              <x-image title="Breif Image" name="bluedar_about_image" val="{!! @$set->bluedar_about_image !!}" />
                          </div>


                          <div class="col-md-12">
                              <x-input title="Gallery Title" name="bluedar_gallery_title" arval="{!! @$set->bluedar_gallery_title->ar !!}" enval="{!! @$set->bluedar_gallery_title->en !!}" />
                          </div>


                          <div class="col-md-12">
                              <x-image title="Gallery BG Image" name="bluedar_gallery_image" val="{!! @$set->bluedar_gallery_image !!}" />
                          </div>

{{--{{ dd(@$set) }}--}}
                          @include('admin.inc.gallery2', [
                          'name' => 'bluedar_gallery',
                          'folder' => 'uploads/site/',
                          'results' => old('bluedar_gallery',json_decode(@$set->bluedar_gallery))
                      ])





                          <div class="col-md-12">
                              <x-image title="Map Image" name="bluedar_map_image" val="{!! @$set->bluedar_map_image !!}" />
                          </div>

                          <div class="col-md-12">
                              <x-textarea title="Map Title" name="bluedar_map_title" arval="{!! @$set->bluedar_map_title->ar !!}" enval="{!! @$set->bluedar_map_title->en !!}" />
                          </div>

                          <div class="col-md-12">
                              <x-input title="Map Link" name="bluedar_map_link" arval="{!! @$set->bluedar_map_link->ar  !!}"  />
                          </div>




                          <div class="col-md-12">
                              <x-image title="Interesting Image" name="bluedar_interesting_image" val="{!! @$set->bluedar_interesting_image !!}" />
                          </div>

                          <div class="col-md-12">
                              <x-textarea title="Interesting Title" name="bluedar_interesting_title" arval="{!! @$set->bluedar_interesting_title->ar !!}" enval="{!! @$set->bluedar_interesting_title->en !!}" />
                          </div>



                    </div><!--/row-->

                  <div class="form-actions">
                      <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>  Update </button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div></div>
<!-- Row -->

@endsection
