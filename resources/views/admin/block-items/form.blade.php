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

            <div class="form-group {{ $errors->has('content.' . $item->slug) ? 'has-error' : ''}}">
                <label for="content_{{ $item->slug }}" class="control-label">{{ 'Описание ' . $item->slug }}</label>
                <textarea class="form-control" name="content[{{ $item->slug }}]" type="text" id="content_{{ $item->slug }}"
                          required>{{ isset($data->getContent) ? $data->getContent->$currentLang : old('content.' . $item->slug) }}</textarea>
                {!! $errors->first('content.' . $item->slug, '<p class="help-block">:message</p>') !!}
            </div>

            <div class="form-group {{ $errors->has('icon.' . $item->slug) ? 'has-error' : ''}}">
                <label for="icon_{{ $item->slug }}" class="control-label">{{ 'Иконка ' . $item->slug }}</label>
                <input class="form-control" name="icon[{{ $item->slug }}]" type="file" id="icon_{{ $item->slug }}"
                       value="{{ isset($data->getMedia) ? $data->getMedia->$currentLang : old('icon.' . $item->slug)}}">
                {!! $errors->first('icon.' . $item->slug, '<p class="help-block">:message</p>') !!}
            </div>

            @if (isset($data->getMedia->$currentLang))
                <div class="form-group">
                    <img src="/uploads/{{ $data->getMedia->$currentLang }}" alt="" style="max-width: 300px;">
                </div>
            @endif

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
    <input type="hidden" name="block_id" value="{{ $parentData->id }}">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Обновить' : 'Создать' }}">
</div>
