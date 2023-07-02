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
            <div class="form-group {{ $errors->has('message.' . $item->slug) ? 'has-error' : ''}}">
                <label for="name_{{ $item->slug }}" class="control-label">{{ 'Наименование ' . $item->slug }}</label>
                <input class="form-control" name="name[{{ $item->slug }}]" type="text" id="name_{{ $item->slug }}"
                       value="{{ isset($data->getMessage) ? $data->getMessage->$currentLang : old('message.' . $currentLang) }}">
                {!! $errors->first('message.' . $item->slug, '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    @endforeach

</div>

<div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
    <label for="code" class="control-label">{{ 'Машинное имя' }}</label>
    <input class="form-control" name="code" type="text" id="code"
           value="{{ isset($data->code) ? $data->code : old('code')}}" {{ $formMode === 'edit' ? 'disabled' : 'required' }}>
    {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Обновить' : 'Создать' }}">
</div>
