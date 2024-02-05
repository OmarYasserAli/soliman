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
                              <label>Privecy Page</label>
                              <select name="privecy_page" class="form-control custom-select">
                                <option value="0">Select Page</option>
                                @foreach ($pages as $page)
                                    <option @if(@$set->privecy_page == $page->id) selected @endif value="{{$page->id}}">{{$page->title->en}}</option>
                                @endforeach
                              </select>
                          </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Terms Page</label>
                              <select name="terms_page" class="form-control custom-select">
                                <option value="0">Select Page</option>
                                    @foreach ($pages as $page)
                                        <option @if(@$set->terms_page == $page->id) selected @endif value="{{$page->id}}">{{$page->title->en}}</option>
                                    @endforeach
                              </select>
                              </select>
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
