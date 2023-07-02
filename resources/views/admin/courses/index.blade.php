@extends('adminlte::page')

@section('title', 'Курсы')

@section('content_header')
    <h1>Курсы</h1>
@stop

@section('content')
    @include('flash-message')
    <a href="{{ url('/admin/courses/create') }}" class="btn btn-success btn-sm" title="Добавить курс">
        <i class="fa fa-plus" aria-hidden="true"></i> Добавить
    </a>

    <br/>
    <br/>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Название</th>
                <th>Slug</th>
                <th>Картинка</th>
                <th>Видео</th>
                <th>Статус</th>
                <th>Действие</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->getName->$lang }}</td>
                    <td>{{ $item->slug }}</td>
                    <td>
                        @if(isset($item->images) && !empty($item->images))
                            <a class="example-image-link" href="/uploads/{{ $item->getMedia->$lang }}" data-lightbox="example-1" data-title="{{ $item->getContent->$lang }}">
                                <img class="example-image" src="/uploads/{{ $item->getMedia->$lang }}" alt="image-1" style="width: 100px; max-width:100%;" />
                            </a>
                        @else
                        @endif
                    </td>
                    <td>
                        @if(!empty($item->video))
                            <a href="/uploads/{{ $item->getMedia->$lang }}" target="_blank">Ссылка</a>
                        @else
                            Ссылка
                        @endif
                    </td>
                    <td>@if($item->is_active) Активен @else Не активен @endif</td>
                    <td>
                        <a href="{{ url('/admin/course-lessons/course/' . $item->id ) }}" title="Редактировать уроки курса">
                            <button class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o"
                                                                      aria-hidden="true"></i> Уроки курса
                            </button>
                        </a>

                        <a href="{{ url('/admin/course-programs/course/' . $item->id ) }}" title="Редактировать программу курса">
                            <button class="btn btn-success btn-sm"><i class="fa fa-pencil-square-o"
                                                                      aria-hidden="true"></i> Программы курса
                            </button>
                        </a>

                        <a href="{{ url('/admin/courses/' . $item->id . '/edit') }}" title="Редактировать курс">
                            <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                      aria-hidden="true"></i> Редактировать
                            </button>
                        </a>

                        <form method="POST" action="{{ url('/admin/courses' . '/' . $item->id) }}"
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
