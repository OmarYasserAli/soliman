<div class="col-md-12">
    <div class="form-group">
        <label class="control-label">Head Script</label>
        <textarea name="head_script" class="form-control">{!! old('head_script', @$result->script->head_script) !!}</textarea>
    </div>
</div>

<div class="col-md-12">
    <div class="form-group">
        <label class="control-label">Footer Script</label>
        <textarea name="footer_script" class="form-control">{!! old('footer_script', @$result->script->footer_script) !!}</textarea>
    </div>
</div>
