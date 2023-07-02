@extends('adminlte::page')

@section('title', 'Добавить урок курса')

@section('content_header')
    <h1>Добавить урок : {{ $parentData->getName->$lang }}</h1>
@stop

@section('content')
    @include('flash-message')
    <a href="{{ url('/admin/course-lessons/course/' . $parentData->id) }}" title="Назад">
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

    <form method="POST" action="{{ url('/admin/course-lessons') }}" accept-charset="UTF-8" class="form-horizontal"
          enctype="multipart/form-data">
        {{ csrf_field() }}

        @include ('admin.course-lessons.form', ['formMode' => 'create'])

    </form>

@stop
