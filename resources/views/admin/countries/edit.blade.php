@extends('adminlte::page')

@section('title', 'Редактирование страны')

@section('content_header')
    <h1>Редактирование страны</h1>
@stop

@section('content')
    <a href="{{ url('/admin/countries') }}" title="Назад"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад</button></a>
    <br />
    <br />

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ url('/admin/countries/' . $data->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        @include ('admin.countries.form', ['formMode' => 'edit'])

    </form>

@stop
