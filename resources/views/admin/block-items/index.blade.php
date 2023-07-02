@extends('adminlte::page')

@section('title', 'Данные блока')

@section('content_header')
    <h1>Данные блока: {{ $parentData->getName->$lang }}</h1>
@stop
@php

@endphp
@section('content')
    @include('flash-message')

    <a href="{{ url('/admin/block-items/create/' . $parentData->id) }}" class="btn btn-success btn-sm" title="Добавить блок">
        <i class="fa fa-plus" aria-hidden="true"></i> Добавить
    </a>

    <a href="{{ url('/admin/blocks') }}" title="Назад">
        <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад</button>
    </a>

    <form method="GET" action="{{ url('/admin/block-items/block/' . $parentData->id) }}" accept-charset="UTF-8"
          class="form-inline my-2 my-lg-0 float-right" role="search">
        <div class="input-group">
            <label>
                <input type="text" class="form-control" name="search" placeholder="Поиск..."
                       value="{{ request('search') }}">
            </label>
            <span class="input-group-append">
                <button class="btn btn-secondary" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </span>
        </div>
    </form>

    <br/>
    <br/>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Контент</th>
                <th>Статус</th>
                <th>Действие</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->getContent->$lang }}</td>
                    <td>
                        @if(isset($item->icon) && !empty($item->icon))
                            <a class="example-image-link" href="/uploads/{{ $item->getMedia->$lang }}" data-lightbox="example-1" data-title="{{ $item->getContent->$lang }}">
                                <img class="example-image" src="/uploads/{{ $item->getMedia->$lang }}" alt="image-1" style="width: 100px; max-width:100%;" />
                            </a>
                        @else
                        @endif
                    </td>
                    <td>@if($item->is_active) Активен @else Не активен @endif</td>
                    <td>
                        <a href="{{ url('/admin/block-items/' . $item->id . '/edit/' . $parentData->id) }}" title="Редактировать блок">
                            <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                      aria-hidden="true"></i> Редактировать
                            </button>
                        </a>

                        <form method="POST" action="{{ url('/admin/block-items/' . $item->id) }}"
                              accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Удалить курс"
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
