@extends('admin.layout')

@section('body')

<!-- Row -->
<div class="row">
  <div class="col-lg-12">
      <div class="card card-outline-info">
          <div class="card-block">
              <form action="{{ @$update ? route($route.'.update', @$result->id) : route($route.'.store') }}" method="post" enctype="multipart/form-data" >
                @csrf
                @if(@$update) @method('PUT') @endif
                  <div class="form-body">

                      <div class="row p-t-20">

                        <div class="col-md-12">
                            <x-input title="Title" name="title" arval="{!! @$result->title->ar !!}" enval="{!! @$result->title->en !!}" />
                        </div>

                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Group</label>
                            <select name="group" class="form-control custom-select">
                                @foreach($igroups as $group)
                                <option @if($group->id == @$result->group) selected @endif value="{{$group->id}}">{{$group->title->en}}</option>
                                @endforeach
                            </select>
                        </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Parent</label>
                            <select name="parent" class="form-control custom-select">
                              <option value="0">Primary</option>
                                @foreach($parents as $parent)
                                @if($parent->id == @$result->id) @continue @endif
                                <option @if($parent->id == @$result->group) selected @endif value="{{$parent->id}}">{{$parent->title->en}}</option>
                                @endforeach
                            </select>
                        </div>
                        </div>
                        <div class="col-md-12">


                            <div class="form-group">
                                <label class="control-label">URL</label>
                                @if(@$result->url)
                                    <input type="text" class="form-control disabled" disabled value="{{ old('url', @$result->url ) }}">
                                @endif
                                <input type="hidden" class="form-control" value="{{ old('url',  @$result->url  ) }}" name="url" >
                                <input type="file" class="form-control"  name="url_file">
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
