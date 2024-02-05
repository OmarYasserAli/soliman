@extends('selling.layout')

@section('body')


<!-- Row -->
<div class="row">
    <div class="col-lg-12">
        <div class="card card-outline-info">
            <div class="card-block">
                <form  method="post" enctype="multipart/form-data" >
                  @csrf
                    <div class="form-body">
  
                        <div class="row p-t-20">

                          <div class="col-md-12">
                            <x-textarea title="Selling Title" name="selling_title" arval="{!! @$set->selling_title->ar !!}" enval="{!! @$set->selling_title->en !!}" />

                            </div>

                          <div class="col-md-12">
                              <x-image title="Selling cover" name="selling_image" val="{!! @$set->selling_image !!}" />
                            </div>

           
                      
                          <div class="col-md-12">
                            <x-textarea title="SMS Message without type <code>{PROJECT}, {UNIT}</code>" name="sms_msg2" arval="{!! @$set->sms_msg2->ar !!}" enval="{!! @$set->sms_msg2->en !!}" />
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
