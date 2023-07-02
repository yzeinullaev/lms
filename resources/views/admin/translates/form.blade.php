<div class="form-group {{ $errors->has('data') ? 'has-error' : ''}}">
    <label for="data" class="control-label">{{ 'Data' }}</label>
    <textarea class="form-control" rows="5" name="data" type="textarea" id="data" >{{ isset($translate->data) ? $translate->data : ''}}</textarea>
    {!! $errors->first('data', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('language_id') ? 'has-error' : ''}}">
    <label for="language_id" class="control-label">{{ 'Language Id' }}</label>
    <input class="form-control" name="language_id" type="number" id="language_id" value="{{ isset($translate->language_id) ? $translate->language_id : ''}}" >
    {!! $errors->first('language_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
