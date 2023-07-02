@extends('adminlte::page')

@section('title', 'Добавить блоки страницы')

@section('content_header')
    <h1>Добавить блоки страницы: {{ $parentData->getName->$lang }}</h1>
@stop

@section('content')
    @include('flash-message')
    <a href="{{ url('/admin/page-items/page/' . $parentData->id) }}" title="Назад">
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

    <form method="POST" action="{{ url('/admin/page-items') }}" accept-charset="UTF-8" class="form-horizontal"
          enctype="multipart/form-data">
        {{ csrf_field() }}

        @include ('admin.page-items.form', ['formMode' => 'create'])

    </form>

@stop
