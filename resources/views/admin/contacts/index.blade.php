@extends('adminlte::page')

@section('title', 'Контакты')

@section('content_header')
    <h1>Контакты</h1>
@stop

@section('content')
    @include('flash-message')
    <a href="{{ url('/admin/contacts/create') }}" class="btn btn-success btn-sm" title="Добавить контакт">
        <i class="fa fa-plus" aria-hidden="true"></i> Добавить
    </a>

    <form method="GET" action="{{ url('/admin/contacts') }}" accept-charset="UTF-8"
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
                <th>Телефон</th>
                <th>Email</th>
                <th>Адрес</th>
                <th>Ссылка карты</th>
                <th>Статус</th>
                <th>Действие</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->address }}</td>
                    <td>{{ $item->map_url }}</td>
                    <td>@if($item->is_active) Активен @else Не активен @endif</td>
                    <td>
                        <a href="{{ url('/admin/contacts/' . $item->id . '/edit') }}" title="Редактировать">
                            <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                      aria-hidden="true"></i> Редактировать
                            </button>
                        </a>

                        <form method="POST" action="{{ url('/admin/contacts' . '/' . $item->id) }}"
                              accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete ErrorCode"
                                    onclick="return confirm('Вы уверены что хотите удалить?')"><i class="fa fa-trash-o"
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
