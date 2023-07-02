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

            <div class="form-group {{ $errors->has('question.' . $item->slug) ? 'has-error' : ''}}">
                <label for="question_{{ $item->slug }}"
                       class="control-label">{{ 'Вопрос ' . $item->slug }}</label>
                <textarea class="form-control" name="question[{{ $item->slug }}]" type="text" id="question_{{ $item->slug }}" required>{{ isset($data->getQuestion) ? $data->getQuestion->$currentLang : old('question.' . $currentLang) }}</textarea>

                {!! $errors->first('question.' . $item->slug, '<p class="help-block">:message</p>') !!}
            </div>

            <div class="form-group {{ $errors->has('answer.' . $item->slug) ? 'has-error' : ''}}">
                <label for="answer_{{ $item->slug }}"
                       class="control-label">{{ 'Ответ ' . $item->slug }}</label>
                <textarea class="form-control" name="answer[{{ $item->slug }}]" type="text" id="answer_{{ $item->slug }}" required>{{ isset($data->getAnswer) ? $data->getAnswer->$currentLang : old('answer.' . $currentLang) }}</textarea>
                {!! $errors->first('answer.' . $item->slug, '<p class="help-block">:message</p>') !!}
            </div>

            <div class="form-group {{ $errors->has('meta_title.' . $item->slug) ? 'has-error' : ''}}">
                <label for="meta_title_{{ $item->slug }}"
                       class="control-label">{{ 'Meta заголовок ' . $item->slug }}</label>
                <textarea class="form-control" name="meta_title[{{ $item->slug }}]" type="text" id="meta_title_{{ $item->slug }}" required>{{ isset($data->getMetaTitle) ? $data->getMetaTitle->$currentLang : old('meta_title.' . $currentLang) }}</textarea>
                {!! $errors->first('meta_title.' . $item->slug, '<p class="help-block">:message</p>') !!}
            </div>

            <div class="form-group {{ $errors->has('meta_description.' . $item->slug) ? 'has-error' : ''}}">
                <label for="meta_description_{{ $item->slug }}"
                       class="control-label">{{ 'Meta описание ' . $item->slug }}</label>
                <textarea class="form-control" name="meta_description[{{ $item->slug }}]" type="text" id="meta_description_{{ $item->slug }}" required>{{ isset($data->getMetaDescription) ? $data->getMetaDescription->$currentLang : old('meta_description.' . $currentLang) }}</textarea>
                {!! $errors->first('meta_description.' . $item->slug, '<p class="help-block">:message</p>') !!}
            </div>

            <div class="form-group {{ $errors->has('meta_keywords.' . $item->slug) ? 'has-error' : ''}}">
                <label for="meta_keywords_{{ $item->slug }}"
                       class="control-label">{{ 'Meta ключевые слова ' . $item->slug }}</label>
                <textarea class="form-control" name="meta_keywords[{{ $item->slug }}]" type="text" id="meta_keywords_{{ $item->slug }}" required>{{ isset($data->getMetaKeywords) ? $data->getMetaKeywords->$currentLang : old('meta_keywords.' . $currentLang) }}</textarea>
                {!! $errors->first('meta_keywords.' . $item->slug, '<p class="help-block">:message</p>') !!}
            </div>

        </div>
    @endforeach
</div>

<div class="form-group {{ $errors->has('sort') ? 'has-error' : ''}}">
    <label for="sort"
           class="control-label">{{ 'Порядок отображения' }}</label>
    <input class="form-control" name="sort" type="number" id="sort" value="{{ $data->sort ?? old('sort') }}" required />

    {!! $errors->first('sort', '<p class="help-block">:message</p>') !!}
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
