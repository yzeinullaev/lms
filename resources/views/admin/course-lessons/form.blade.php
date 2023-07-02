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
                <label for="name_{{ $item->slug }}" class="control-label">{{ 'Заголовок ' . $item->slug }}</label>
                <input class="form-control" name="name[{{ $item->slug }}]" type="text" id="name_{{ $item->slug }}"
                       value="{{ isset($data->getName) ? $data->getName->$currentLang : old('name.' . $item->slug) }}">
                {!! $errors->first('name.' . $item->slug, '<p class="help-block">:message</p>') !!}
            </div>

            <div class="form-group {{ $errors->has('content.' . $item->slug) ? 'has-error' : ''}}">
                <label for="content_{{ $item->slug }}" class="control-label">{{ 'Описание ' . $item->slug }}</label>
                <textarea class="form-control" name="content[{{ $item->slug }}]" type="text" id="content_{{ $item->slug }}"
                          required>{{ isset($data->getContent) ? $data->getContent->$currentLang : old('content.' . $item->slug) }}</textarea>
                {!! $errors->first('content.' . $item->slug, '<p class="help-block">:message</p>') !!}
            </div>

            <div class="form-group {{ $errors->has('file.' . $item->slug) ? 'has-error' : ''}}">
                <label for="file_{{ $item->slug }}" class="control-label">{{ 'Файлы ' . $item->slug }}</label>
                <input
                    type="file"
                    name="file[{{ $item->slug }}][]"
                    id="file_{{ $item->slug }}"
                    multiple
                    class="form-control"
                >
                {!! $errors->first('file.' . $item->slug, '<p class="help-block">:message</p>') !!}
            </div>

            @if (isset($data->file))
                @php $files = explode(',', $data->getFile->$currentLang); @endphp
                <div class="form-group">
                    @foreach($files as $file)
                        <a href="/uploads/{{ $file }}" target="_blank">Файл ({{ $item->slug }})</a> <br>
                    @endforeach
                </div>
            @endif

            <div class="form-group {{ $errors->has('video.' . $item->slug) ? 'has-error' : ''}}">
                <label for="video_{{ $item->slug }}" class="control-label">{{ 'Видео ' . $item->slug }}</label>
                <input class="form-control" name="video[{{ $item->slug }}]" type="file" id="video_{{ $item->slug }}"
                       value="{{ isset($data->getMedia) ? $data->getMedia->$currentLang : old('video.' . $item->slug)}}">
                {!! $errors->first('video.' . $item->slug, '<p class="help-block">:message</p>') !!}
            </div>

            @if (isset($data->video))
                <div class="form-group">
                    <video width="320" height="240" controls>
                        <source src="/uploads/{{ $data->getMediaVideo->$currentLang }}" type="video/mp4">
                        <source src="/uploads/{{ $data->getMediaVideo->$currentLang }}" type="video/ogg">
                        Your browser does not support the video tag.
                    </video>
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
    <input type="hidden" name="course_id" value="{{ $parentData->id }}">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Обновить' : 'Создать' }}">
</div>
