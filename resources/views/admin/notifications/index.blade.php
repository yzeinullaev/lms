@extends('adminlte::page')

@section('title', 'Уведомления')

@section('content_header')
    <h1>Уведомления</h1>
@stop

@section('content')
    @include('flash-message')
    <a href="{{ url('/admin/notifications/create') }}" class="btn btn-success btn-sm" title="">
        <i class="fa fa-plus" aria-hidden="true"></i> Добавить
    </a>

    <form method="GET" action="{{ url('/admin/notifications') }}" accept-charset="UTF-8"
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
                <th>Комментарий</th>
                <th>Пользователь</th>
                <th>Дата</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->getName->$lang }}</td>
                    <td>{{ $item->getContent->$lang }}</td>
                    <td>@if($item->user_type == 0) Все @else {{ $item->getUser->name }} @endif</td>
                    <td>{{ $item->updated_at }}</td>
                    <td>
                        <a href="{{ url('/admin/notifications/' . $item->id . '/edit') }}" title="Редактировать отзыв">
                            <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                      aria-hidden="true"></i> Редактировать
                            </button>
                        </a>

                        <form method="POST" action="{{ url('/admin/notifications/' . $item->id) }}"
                              accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Удалить отзыв"
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
        <div
            class="pagination-wrapper"> {!! $data->appends(['search' => Request::get('search')])->render() !!} </div>
    </div>

@stop
