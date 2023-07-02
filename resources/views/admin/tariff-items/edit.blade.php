@extends('adminlte::page')

@section('title', 'Редактировать блоки тарифа')

@section('content_header')
    <h1>Редактировать блоки тарифа: {{ $parentData->getName->$lang }}</h1>
@stop

@section('content')
    @include('flash-message')
    <a href="{{ url('/admin/tariff-items/tariff/' . $parentData->id) }}" title="Назад">
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

    <form method="POST" action="{{ url('/admin/tariff-items/' . $data->id) }}" accept-charset="UTF-8" class="form-horizontal"
          enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        @include ('admin.tariff-items.form', ['formMode' => 'edit'])

    </form>

@stop
