<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="control-label">{{ 'Пользователь' }}</label>
    <select name="user_id" id="user_id" class="form-control">
        @foreach($users as $user)
            <option
                value="{{ $user->id }}" {{ isset($data->user_id) && $data->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
        @endforeach
    </select>
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
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

<div class="form-group {{ $errors->has('comment') ? 'has-error' : ''}}">
    <label for="comment" class="control-label">{{ 'Комментарий' }}</label>
    <textarea class="form-control" rows="5" name="comment" type="textarea"
              id="comment">{{ $data->comment ?? ''}}</textarea>
    {!! $errors->first('comment', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('review_star') ? 'has-error' : ''}}">
    <label for="review_star" class="control-label">{{ 'Оценка' }}</label>
    <select class="form-control" name="review_star" id="review_star">
        <option value="1" {{ isset($data->review_star) && $data->review_star == 1 ? 'selected' : ''}}>1</option>
        <option value="2" {{ isset($data->review_star) && $data->review_star == 2 ? 'selected' : ''}}>2</option>
        <option value="3" {{ isset($data->review_star) && $data->review_star == 3 ? 'selected' : ''}}>3</option>
        <option value="4" {{ isset($data->review_star) && $data->review_star == 4 ? 'selected' : ''}}>4</option>
        <option value="5" {{ isset($data->review_star) && $data->review_star == 5 ? 'selected' : ''}}>5</option>
    </select>
    {!! $errors->first('review_star', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Статус' }}</label>
    <select class="form-control" name="status" id="status">
        <option value="1" {{ isset($data->status) && $data->status == 1 ? 'selected' : ''}}>Активен</option>
        <option value="0" {{ isset($data->status) && $data->status == 0 ? 'selected' : ''}}>Не активен</option>
    </select>
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Обновить' : 'Создать' }}">
</div>
