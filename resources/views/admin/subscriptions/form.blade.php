<div class="form-group {{ $errors->has('tariff_id') ? 'has-error' : ''}}">
    <label for="tariff_id" class="control-label">{{ 'Тариф' }}</label>
    <select class="form-control" name="tariff_id" id="tariff_id">
        @foreach($tariffs as $tariff)
            <option value="{{ $tariff->id }}" {{ isset($data->tariff_id) && $tariff->id == $data->tariff_id ? 'selected' : ''}}>{{ $tariff->getName->$lang }}</option>
        @endforeach
    </select>
    {!! $errors->first('tariff_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('course_id') ? 'has-error' : ''}}">
    <label for="course_id" class="control-label">{{ 'Курс' }}</label>
    <select class="form-control" name="course_id" id="course_id">
        @foreach($courses as $course)
            <option value="{{ $course->id }}" {{ isset($data->course_id) && $course->id == $data->course_id ? 'selected' : ''}}>{{ $course->getName->$lang }}</option>
        @endforeach
    </select>
    {!! $errors->first('course_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="control-label">{{ 'Пользователи' }}</label>
    <select class="form-control" name="user_id" id="user_id">
        @foreach($users as $user)
            <option value="{{ $user->id }}" {{ isset($data->user_id) && $user->id == $data->user_id ? 'selected' : ''}}>{{ $user->name }}</option>
        @endforeach
    </select>
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('payment') ? 'has-error' : ''}}">
    <label for="payment" class="control-label">{{ 'Оплата' }}</label>
    <input class="form-control" name="payment" type="number" id="payment"
           value="{{ isset($data->payment_id) ? $data->getPayment->amount : old('payment') }}" required>
    @if(isset($data->payment_id))
    <input type="hidden" name="payment_id" value="{{ $data->payment_id }}">
    @else
    @endif
    {!! $errors->first('payment', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('start_subscribe') ? 'has-error' : ''}}">
    <label for="start_subscribe" class="control-label">{{ 'Начала подписки' }}</label>
    <input class="form-control" name="start_subscribe" type="date" id="start_subscribe"
           value="{{ $data->start_subscribe ?? old('start_subscribe') }}" required>
    {!! $errors->first('start_subscribe', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('end_subscribe') ? 'has-error' : ''}}">
    <label for="end_subscribe" class="control-label">{{ 'Конец подписки' }}</label>
    <input class="form-control" name="end_subscribe" type="date" id="end_subscribe"
           value="{{ $data->end_subscribe ?? old('end_subscribe') }}" required>
    {!! $errors->first('end_subscribe', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('payment_status') ? 'has-error' : ''}}">
    <label for="payment_status" class="control-label">{{ 'Статус' }}</label>
    <select class="form-control" name="payment_status" id="payment_status">
        <option value="1" {{ isset($data->payment_status) && $data->payment_status == 1 ? 'selected' : ''}}>Активен</option>
        <option value="0" {{ isset($data->payment_status) && $data->payment_status == 0 ? 'selected' : ''}}>Не активен</option>
        <option value="3" {{ isset($data->payment_status) && $data->payment_status == 3 ? 'selected' : ''}}>Ошибка оплаты</option>
    </select>
    {!! $errors->first('payment_status', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Обновить' : 'Создать' }}">
</div>
