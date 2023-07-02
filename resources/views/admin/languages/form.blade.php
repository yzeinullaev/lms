<div class="form-group {{ $errors->has('slug') ? 'has-error' : ''}}">
    <label for="slug" class="control-label">{{ 'Код' }}</label>
    <input class="form-control" name="slug" type="text" id="slug" value="{{ isset($data->slug) ? $data->slug : ''}}" >
    {!! $errors->first('slug', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Наименование' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($data->name) ? $data->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    <label for="image" class="control-label">{{ 'Изображение' }}</label>
    <input class="form-control" name="image" type="file" id="image" value="{{ $data->image ?? ''}}" >
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
</div>

@if (isset($data->image))
    <div class="form-group">
        <img src="/uploads/{{ $data->image }}" alt="" style="max-width: 300px;">
    </div>
@endif


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Обновить' : 'Создать' }}">
</div>
