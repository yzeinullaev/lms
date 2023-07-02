<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'ФИО' }}</label>
    <input class="form-control" name="name" type="text" id="name"
           value="{{ isset($data->name) ? $data->name : old('name')}}">
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
    <label for="phone" class="control-label">{{ 'Телефон' }}</label>
    <input class="form-control" name="phone" type="text" id="phone"
           value="{{ isset($data->phone) ? $data->phone : old('phone')}}">
    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="control-label">{{ 'Email' }}</label>
    <input class="form-control" name="email" type="text" id="email"
           value="{{ isset($data->email) ? $data->email : old('email')}}">
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
    <label for="password" class="control-label">{{ 'Пароль' }}</label>
    <input class="form-control" name="password" type="text" id="password" value="">
    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('role_id') ? 'has-error' : ''}}">
    <label for="role_id" class="control-label">{{ 'Роль' }}</label>
    <select class="form-control" name="role_id" id="role_id">
        @foreach($rolesMap as $key=>$item)
            <option
                value="{{ $key }}" {{ isset($data->role_id) && $data->role_id == $key ? 'selected' : ''}}>{{ $item }}</option>
        @endforeach
    </select>
    {!! $errors->first('role_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('sex') ? 'has-error' : ''}}">
    <label for="sex" class="control-label">{{ 'Пол' }}</label>
    <select class="form-control" name="sex" id="sex">
        <option value="0" {{ isset($data->sex) && $data->sex == 0 ? 'selected' : ''}}>{{ 'Женщина' }}</option>
        <option value="1" {{ isset($data->sex) && $data->sex == 1 ? 'selected' : ''}}>{{ 'Мужщина' }}</option>
    </select>
    {!! $errors->first('sex', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('deactivate') ? 'has-error' : ''}}">
    <label for="deactivate" class="control-label">{{ 'Деактивация пользователя' }}</label>
    <select class="form-control" name="deactivate" id="deactivate">
        <option value="0" {{ isset($data->deactivate) && $data->deactivate == 0 ? 'selected' : ''}}>{{ 'Активен' }}</option>
        <option value="1" {{ isset($data->deactivate) && $data->deactivate == 1 ? 'selected' : ''}}>{{ 'Деактивирован' }}</option>
    </select>
    {!! $errors->first('deactivate', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Обновить' : 'Создать' }}">
</div>
