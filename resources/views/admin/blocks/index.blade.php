@extends('adminlte::page')

@section('title', 'Блоки')

@section('content_header')
    <h1>Блоки</h1>
@stop

@section('content')
    @include('flash-message')
    <a href="{{ url('/admin/blocks/create') }}" class="btn btn-success btn-sm" title="Добавить страну">
        <i class="fa fa-plus" aria-hidden="true"></i> Добавить
    </a>

    <form method="GET" action="{{ url('/admin/blocks') }}" accept-charset="UTF-8"
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
                <th>Название</th>
                <th>Описание</th>
                <th>Статус</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->getName->$lang }}</td>
                    <td>{{ $item->getContent->$lang }}</td>
                    <td>@if($item->is_active) Активен @else Не активен @endif</td>
                    <td>
                        <a href="{{ url('/admin/block-items/block/' . $item->id) }}" title="Edit">
                            <button class="btn btn-secondary btn-sm">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Значение
                            </button>
                        </a>

                        <a href="{{ url('/admin/blocks/' . $item->id . '/edit') }}" title="Edit">
                            <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                      aria-hidden="true"></i> Редактировать
                            </button>
                        </a>

                        <form method="POST" action="{{ url('/admin/blocks' . '/' . $item->id) }}"
                              accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Удалить страну"
                                    onclick="return confirm('Вы уверены что хотите удалить?')"><i
                                    class="fa fa-trash-o" aria-hidden="true"></i> Удалить
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@stop
