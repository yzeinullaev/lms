@extends('adminlte::page')

@section('title', 'Добавление страны')

@section('content_header')
    <h1>Добавление страны</h1>
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
    
    <form method="POST" action="{{ url('/admin/countries') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
        {{ csrf_field() }}

        @include ('admin.countries.form', ['formMode' => 'create'])

    </form>

@stop
