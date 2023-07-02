@extends('adminlte::page')

@section('title', 'Добавить новость')

@section('content_header')
    <h1>Добавить новость: категория {{ $parentData->getName->$lang }}</h1>
@stop

@section('content')
    @include('flash-message')
    <a href="{{ url('/admin/news-categories/news/' . $parentData->id) }}" title="Назад">
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

    <form method="POST" action="{{ url('/admin/news') }}" accept-charset="UTF-8" class="form-horizontal"
          enctype="multipart/form-data">
        {{ csrf_field() }}

        @include ('admin.news.form', ['formMode' => 'create'])

    </form>

@stop
