<div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
    <label for="phone" class="control-label">{{ 'Телефон' }}</label>
    <input class="form-control" name="phone" type="text" id="phone"
           value="{{ isset($data->phone) ? $data->phone : old('phone')}}" required>
    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="control-label">{{ 'Email' }}</label>
    <input class="form-control" name="email" type="text" id="email"
           value="{{ isset($data->email) ? $data->email : old('email')}}" required>
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    <label for="address" class="control-label">{{ 'Адрес' }}</label>
    <input class="form-control" name="address" type="text" id="address"
           value="{{ isset($data->address) ? $data->address : old('address')}}" required>
    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('map_url') ? 'has-error' : ''}}">
    <label for="map_url" class="control-label">{{ 'Ссылка для карты' }}</label>
    <input class="form-control" name="map_url" type="text" id="map_url"
           value="{{ isset($data->map_url) ? $data->map_url : old('map_url')}}" required>
    {!! $errors->first('map_url', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('is_active') ? 'has-error' : ''}}">
    <label for="is_active" class="control-label">{{ 'Статус' }}</label>
    <select class="form-control" name="is_active" id="is_active">
        <option value="1" {{ isset($data->is_active) && $data->is_active == 1 ? 'selected' : ''}}>Активен</option>
        <option value="0" {{ isset($data->is_active) && $data->is_active == 0 ? 'selected' : ''}}>Не активен</option>
    </select>
    {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Обновить' : 'Создать' }}">
</div>
