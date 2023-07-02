@if(empty($typeData))
    <h3>{{ App\Enums\PageTypeEnum::TYPES[$type] }}</h3>
    <p class="small">Данный блок для страницы без выподающего списка</p>
@else
    <div class="form-group {{ $errors->has('item_type_id') ? 'has-error' : ''}}">
        <label for="item_type_id" class="control-label">{{ App\Enums\PageTypeEnum::TYPES[$type] }}</label>
        <select class="form-control" name="item_type_id" id="item_type_id">
            @foreach($typeData as $typeItem)
                <option value="{{ $typeItem['value'] }}" {{ isset($data->item_type_id ) && $typeItem['value'] == $data->item_type_id ? 'selected' : ''}}>{{ $typeItem['name'] }}</option>
            @endforeach
        </select>
        {!! $errors->first('item_type_id', '<p class="help-block">:message</p>') !!}
    </div>
@endif
<hr>
<div class="form-group {{ $errors->has('sort') ? 'has-error' : ''}}">
    <label for="sort"
           class="control-label">{{ 'Порядок отображения' }}</label>
    <input class="form-control" name="sort" type="number" id="sort" value="{{ $data->sort ?? 0 }}" required />

    {!! $errors->first('sort', '<p class="help-block">:message</p>') !!}
</div>
<br>
<div class="form-group {{ $errors->has('is_active') ? 'has-error' : ''}}">
    <label for="is_active" class="control-label">{{ 'Статус' }}</label>
    <select class="form-control" name="is_active" id="is_active">
        <option value="1" {{ isset($data->is_active) && $data->is_active == 1 ? 'selected' : ''}}>Активен</option>
        <option value="0" {{ isset($data->is_active) && $data->is_active == 0 ? 'selected' : ''}}>Не активен</option>
    </select>
    {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input type="hidden" name="item_type" value="{{ $type }}">
    <input type="hidden" name="page_id" value="{{ $parentData->id }}">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Обновить' : 'Создать' }}">
</div>
