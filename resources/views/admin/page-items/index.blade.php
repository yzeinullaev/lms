@extends('adminlte::page')

@section('title', 'Блоки страницы')

@section('content_header')
    <h1>Блоки страницы: {{ $parentData->getName->$lang }}</h1>
@stop
@php

@endphp
@section('content')
    @include('flash-message')

    <a href="{{ url('/admin/pages') }}" title="Назад">
        <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад</button>
    </a>

    <form method="GET" action="{{ url('/admin/page-items/create/' . $parentData->id) }}" accept-charset="UTF-8"
          class="form-inline my-2 my-lg-0 float-right" role="search">
        <div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
            <label for="type" class="control-label">{{ 'Блоки для страниц' }}</label>
            <select class="form-control" name="type" id="type">
                @foreach(App\Enums\PageTypeEnum::TYPES as $key => $item)
                    <option
                        value="{{ $key }}">{{ $item }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <input class="btn btn-success btn-sm" type="submit" value="Добавить">
        </div>
    </form>

    <br/>
    <br/>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Наименование</th>
                <th>Порядок отображения</th>
                <th>Статус</th>
                <th>Действие</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ App\Enums\PageTypeEnum::TYPES[$item['item_type']] }}</td>
                    <td>{{ $item->sort }}</td>
                    <td>@if($item->is_active) Активен @else Не активен @endif</td>
                    <td>

                        <form method="GET" action="{{ url('/admin/page-items/' . $item->id . '/edit/' . $parentData->id) }}" accept-charset="UTF-8">
                            <input type="hidden" name="type" value="{{ $item->item_type }}">
                            <input class="btn btn-primary btn-sm" type="submit" value="Редактировать">
                        </form>


                        <form method="POST" action="{{ url('/admin/page-items/' . $item->id) }}"
                              accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <input type="hidden" name="page_id" value="{{ $parentData->id }}">
                            <button type="submit" class="btn btn-danger btn-sm" title="Удалить"
                                    onclick="return confirm('Подтвердите удаление')"><i class="fa fa-trash-o"
                                                                                                  aria-hidden="true"></i>
                                Удалить
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $data->appends(['search' => Request::get('search')])->render() !!} </div>
    </div>

@stop
