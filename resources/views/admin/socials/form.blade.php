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

<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Наименование' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($data->name) ? $data->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>

<br>

<div class="tab-content" id="myTabContent">

    @foreach($langs as $item)
        @php
            $currentLang = $item->slug;
        @endphp
        <div class="tab-pane fade @if ($loop->first) show active @endif" id="{{ $item->slug }}" role="tabpanel"
             aria-labelledby="{{ $item->slug }}-tab">

            <div class="form-group {{ $errors->has('images.' . $item->slug) ? 'has-error' : ''}}">
                <label for="images_{{ $item->slug }}" class="control-label">{{ 'Баннер ' . $item->slug }}</label>
                <input class="form-control" name="images[{{ $item->slug }}]" type="file" id="images_{{ $item->slug }}"
                       value="{{ isset($data->getMedia) ? $data->getMedia->$currentLang : old('images.' . $item->slug)}}">
                {!! $errors->first('images.' . $item->slug, '<p class="help-block">:message</p>') !!}
            </div>

            @if (isset($data->getMedia->$currentLang))
                <div class="form-group">
                    <img src="/uploads/{{ $data->getMedia->$currentLang }}" alt="" style="max-width: 300px;">
                </div>
            @endif

            <div class="form-group {{ $errors->has('url.' . $item->slug) ? 'has-error' : ''}}">
                <label for="url_{{ $item->slug }}" class="control-label">{{ 'Ссылка ' . $item->slug }}</label>
                <label for="url"></label>
                <input class="form-control" name="url[{{ $item->slug }}]" type="text" id="url_{{ $item->slug }}"
                       value="{{ isset($data->getLink) ? $data->getLink->$currentLang : old('url.' . $item->slug)}}">
                {!! $errors->first('url', '<p class="help-block">:message</p>') !!}
            </div>

        </div>
    @endforeach
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
