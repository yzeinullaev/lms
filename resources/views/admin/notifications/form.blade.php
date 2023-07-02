<ul class="nav nav-tabs" id="myTab" role="tablist">
    @foreach($langs as $item)
        <li class="nav-item" role="presentation">
            <button class="nav-link @if ($loop->first) active @endif" id="{{ $item->slug }}-tab" data-toggle="tab"
                    data-target="#{{ $item->slug }}" type="button" role="tab" aria-controls="{{ $item->slug }}"
                    aria-selected="true">{{ $item->name }}</button>
        </li>
    @endforeach
</ul>
<br>
<div class="tab-content" id="myTabContent">

    @foreach($langs as $item)
        @php
            $currentLang = $item->slug;
        @endphp
        <div class="tab-pane fade @if ($loop->first) show active @endif" id="{{ $item->slug }}" role="tabpanel"
             aria-labelledby="{{ $item->slug }}-tab">

            <div class="form-group {{ $errors->has('name.' . $item->slug) ? 'has-error' : ''}}">
                <label for="name_{{ $item->slug }}" class="control-label">{{ 'Название ' . $item->slug }}</label>
                <input class="form-control" name="name[{{ $item->slug }}]" type="text" id="name_{{ $item->slug }}"
                       value="{{ isset($data->getName) ? $data->getName->$currentLang : old('name.' . $item->slug) }}" required>
                {!! $errors->first('name.' . $item->slug, '<p class="help-block">:message</p>') !!}
            </div>

            <div class="form-group {{ $errors->has('content.' . $item->slug) ? 'has-error' : ''}}">
                <label for="content_{{ $item->slug }}" class="control-label">{{ 'Комментрия ' . $item->slug }}</label>
                <textarea class="form-control" name="content[{{ $item->slug }}]" type="text" id="content_{{ $item->slug }}" required>{{ isset($data->getContent) ? $data->getContent->$currentLang : old('content.' . $item->slug) }}</textarea>
                {!! $errors->first('content.' . $item->slug, '<p class="help-block">:message</p>') !!}
            </div>

        </div>
    @endforeach
</div>

<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="control-label">{{ 'Пользователь' }}</label>
    <select name="user_id" id="user_id" class="form-control">
        <option value="0" {{ $item->user_type == 0 ? 'selected' : '' }}>Все</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}" {{ isset($data->user_id) && $data->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
        @endforeach
    </select>
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Обновить' : 'Создать' }}">
</div>
