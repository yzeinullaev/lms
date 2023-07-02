@extends('adminlte::page')

@section('title', 'Языки')

@section('content_header')
    <h1>Языки</h1>
@stop

@section('content')
    <a href="{{ url('/admin/languages/create') }}" class="btn btn-success btn-sm" title="Добавить новый язык">
        <i class="fa fa-plus" aria-hidden="true"></i> Добавить
    </a>

    <br/>
    <br/>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Код</th>
                <th>Наименование</th>
                <th>Изображение</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->slug }}</td>
                    <td>{{ $item->name }}</td>
                    <td>@if(isset($item->image) && !empty($item->image))
                            <a class="example-image-link" href="/uploads/{{ $item->image }}" data-lightbox="example-1" data-title="{{ $item->name }}">
                                <img class="example-image" src="/uploads/{{ $item->image }}" alt="image-1" style="width: 60px; max-width:100%;" />
                            </a>
                        @else
                        @endif</td>
                    <td>
                        <a href="{{ url('/admin/languages/' . $item->id . '/edit') }}" title="Редактирование языка">
                            <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                      aria-hidden="true"></i> Редактировать
                            </button>
                        </a>

                        <form method="POST" action="{{ url('/admin/languages' . '/' . $item->id) }}"
                              accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Language"
                                    onclick="return confirm('При удалении весь контент связанный с языком удалится!')">
                                <i class="fa fa-trash-o" aria-hidden="true"></i> Удалить
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@stop
