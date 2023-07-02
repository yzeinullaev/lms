@extends('adminlte::page')

@section('title', 'Добавление пользователя')

@section('content_header')
    <h1>Добавление пользователя</h1>
@stop

@section('content')
    <a href="{{ url('/admin/users') }}" title="Назад">
        <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад</button>
    </a>
    <br/>
    <br/>

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ url('/admin/users') }}" accept-charset="UTF-8" class="form-horizontal"
          enctype="multipart/form-data">
        {{ csrf_field() }}

        @include ('admin.users.form', ['formMode' => 'create'])

    </form>

@stop