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
                <label for="name_{{ $item->slug }}"
                       class="control-label">{{ 'Наименование ' . $item->slug }}</label>
                <input class="form-control" name="name[{{ $item->slug }}]" type="text" id="name_{{ $item->slug }}"
                       value="{{ isset($data->getName) ? $data->getName->$currentLang : old('name.' . $currentLang) }}" required>
                {!! $errors->first('name.' . $item->slug, '<p class="help-block">:message</p>') !!}
            </div>

        </div>
    @endforeach
</div>

<div class="form-group {{ $errors->has('slug') ? 'has-error' : ''}}">
    <label for="slug"
           class="control-label">{{ 'Slug' }}</label>
    <input class="form-control" name="slug" type="text" id="slug"
           value="{{ $data->slug ?? old('slug') }}" required>
    {!! $errors->first('slug', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('menu') ? 'has-error' : ''}}">
    <label for="menu" class="control-label">{{ 'Меню' }}</label>
    <select class="form-control" name="menu" id="menu">
        <option value="1" {{ isset($data->menu) && $data->menu == 1 ? 'selected' : ''}}>Активен</option>
        <option value="0" {{ isset($data->menu) && $data->menu == 0 ? 'selected' : ''}}>Не активен</option>
    </select>
    {!! $errors->first('menu', '<p class="help-block">:message</p>') !!}
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
