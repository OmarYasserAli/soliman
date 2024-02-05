@extends('admin.layout')

@section('body')

<!-- Row -->
<div class="row">
  <div class="col-lg-12">
      <div class="card card-outline-info">
          <div class="card-block">
              <form action="{{ @$update ? route($route.'.update', @$result->id) : route($route.'.store') }}" method="post" >
                @csrf
                @if(@$update) @method('PUT') @endif
                  <div class="form-body">

                      <div class="row p-t-20">
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">First Name</label>
                              <input type="text" class="form-control" value="{{ old('fname',@$result->fname) }}" name="fname" placeholder="First Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">Last Name</label>
                              <input type="text" class="form-control" value="{{ old('lname',@$result->lname) }}" name="lname" placeholder="Last Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">Email</label>
                              <input type="text" class="form-control" value="{{ old('email',@$result->email) }}" name="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">Password</label>
                              <input type="password" class="form-control" value="" name="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">Password Confirmation</label>
                              <input type="password" class="form-control" value="" name="password_confirmation" placeholder="Password Confirmation">
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

@endsection
