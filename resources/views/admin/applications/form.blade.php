<div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
    <label for="first_name" class="control-label">{{ 'Имя' }}</label>
    <input class="form-control" name="first_name" type="text" id="first_name" value="{{ $data->first_name ?? ''}}" />
    {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
    <label for="last_name" class="control-label">{{ 'Фамилия' }}</label>
    <input class="form-control" name="last_name" type="text" id="last_name" value="{{ $data->last_name ?? ''}}" />
    {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="control-label">{{ 'Почтк' }}</label>
    <input class="form-control" name="email" type="text" id="email" value="{{ $data->email ?? ''}}" />
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('course_id') ? 'has-error' : ''}}">
    <label for="course_id" class="control-label">{{ 'Курс' }}</label>
    <select class="form-control" name="course_id" type="number" id="course_id">
        @foreach($courses as $course)
            <option
                value="{{ $course->id }}" {{ isset($data->course_id) && $data->course_id == $course->id ? 'selected' : '' }}>{{ $course->getName->$lang }}</option>
        @endforeach
    </select>
    {!! $errors->first('course_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('is_active') ? 'has-error' : ''}}">
    <label for="is_active" class="control-label">{{ 'Статус' }}</label>
    <select class="form-control" name="is_active" id="is_active">
        <option value="1" {{ isset($data->is_active) && $data->is_active == 1 ? 'selected' : ''}}>Обработан</option>
        <option value="0" {{ isset($data->is_active) && $data->is_active == 0 ? 'selected' : ''}}>Не обработан</option>
    </select>
    {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Обновить' : 'Создать' }}">
</div>
