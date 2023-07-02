@extends('adminlte::page')

@section('title', 'Добавить курс')

@section('content_header')
    <h1>Добавить курс</h1>
@stop

@section('content')
    @include('flash-message')
    <a href="{{ url('/admin/courses') }}" title="Назад">
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

    <form method="POST" action="{{ url('/admin/courses') }}" accept-charset="UTF-8" class="form-horizontal"
          enctype="multipart/form-data">
        {{ csrf_field() }}

        @include ('admin.courses.form', ['formMode' => 'create'])

    </form>

@stop
