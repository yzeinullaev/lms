@extends('adminlte::page')

@section('title', 'Социальные сети')

@section('content_header')
    <h1>Социальные сети</h1>
@stop

@section('content')
    @include('flash-message')
    <a href="{{ url('/admin/socials/create') }}" class="btn btn-success btn-sm" title="Добавить соц сеть">
        <i class="fa fa-plus" aria-hidden="true"></i> Добавить
    </a>

    <form method="GET" action="{{ url('/admin/socials') }}" accept-charset="UTF-8"
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
                <th>Наименование</th>
                <th>Ссылка</th>
                <th>Иконка</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->getLink->$lang ?? null }}</td>
                    <td> @if(isset($item->images) && !empty($item->images))
                            <a class="example-image-link" href="/uploads/{{ $item->getMedia->$lang }}" data-lightbox="example-1" data-title="{{ $item->name }}">
                                <img class="example-image" src="/uploads/{{ $item->getMedia->$lang }}" alt="image-1" style="width: 60px; max-width:100%;" />
                            </a>
                        @else
                        @endif
                    </td>
                    <td>
                        <a href="{{ url('/admin/socials/' . $item->id . '/edit') }}" title="Редактирование">
                            <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                      aria-hidden="true"></i> Редактировать
                            </button>
                        </a>

                        <form method="POST" action="{{ url('/admin/socials' . '/' . $item->id) }}"
                              accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Удаление"
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
        <div
            class="pagination-wrapper"> {!! $data->appends(['search' => Request::get('search')])->render() !!} </div>
    </div>

@stop
