@extends('adminlte::page')

@section('title', 'Просмотр пользователя')

@section('content_header')
    <h1>Просмотр пользователя</h1>
@stop

@section('content')

    <a href="{{ url('/admin/users') }}" title="Back">
        <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад</button>
    </a>
    <a href="{{ url('/admin/users/' . $data->id . '/edit') }}" title="Edit User">
        <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Редактировать
        </button>
    </a>

    <form method="POST" action="{{ url('admin/users' . '/' . $data->id) }}" accept-charset="UTF-8"
          style="display:inline">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        <button type="submit" class="btn btn-danger btn-sm" title="Delete User"
                onclick="return confirm('Confirm delete?')"><i class="fa fa-trash-o" aria-hidden="true"></i>
            Удалить
        </button>
    </form>
    <br/>
    <br/>

    <div class="table-responsive">
        <table class="table">
            <tbody>
            <tr>
                <th>ID</th>
                <td>{{ $data->id }}</td>
            </tr>
            <tr>
                <th> Имя</th>
                <td> {{ $data->name }} </td>
            </tr>
            <tr>
                <th> Email</th>
                <td> {{ $data->email }} </td>
            </tr>
            <tr>
                <th> Телефон</th>
                <td> {{ $data->phone }} </td>
            </tr>
            </tbody>
        </table>
    </div>

@stop
