@extends('admin.layout')

@section('body')

<!-- Row -->
<div class="row">
  <div class="col-lg-12">
      <div class="card card-outline-info">
          <div class="card-block">
              <form action="" method="post" enctype="multipart/form-data" >
                @csrf
                  <div class="form-body">

                      <div class="row p-t-20">

                        <div class="col-md-12 mb-5">
                            <a href="{{ route('admin.sitemap') }}" class="btn btn-info">Generate Sitemap</a>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                              <label class="control-label">Upload Robots File</label>
                              {{-- <input type="text" disabled class="form-control disabled" value="{{ old('robots_file',@$set->robots_file) }}" > --}}
                              <input type="file" class="form-control" name="robots_file" >
                            </div>
                        </div>

                          <div class="col-md-6">
                                <x-input title="Name" name="name" arval="{!! @$set->name->ar !!}" enval="{!! @$set->name->en !!}" />
                            </div>

                            <div class="col-md-6">
                                <x-input title="Tagline" name="tagline" arval="{!! @$set->tagline->ar !!}" enval="{!! @$set->tagline->en !!}" />
                        </div>
                        <div class="col-md-12">
                            <x-textarea title="Description" name="desc" arval="{!! @$set->desc->ar !!}" enval="{!! @$set->desc->en !!}" />
                        </div>
                        <div class="col-md-12">
                            <x-image title="Home Background" name="homebg" val="{!! @$set->homebg !!}" />
                          </div>

                          <div class="col-md-12">
                            <x-textarea title="Main Title" name="mtitle" arval="{!! @$set->mtitle->ar !!}" enval="{!! @$set->mtitle->en !!}" />

                          </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Head</label>
                                    <textarea name="head" class="form-control editor">{!! old('head',@$set->head) !!}</textarea>
                                </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Footer Script</label>
                                    <textarea name="footer_script" class="form-control editor">{!! old('footer_script',@$set->footer_script) !!}</textarea>
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
