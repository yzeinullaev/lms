@extends('adminlte::page')

@section('title', 'Редатирование социальной сети')

@section('content_header')
    <h1>Редатирование социальной сети</h1>
@stop

@section('content')
    <a href="{{ url('/admin/socials') }}" title="Назад">
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

    <form method="POST" action="{{ url('/admin/socials/' . $data->id) }}" accept-charset="UTF-8"
          class="form-horizontal" enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        @include ('admin.socials.form', ['formMode' => 'edit'])

    </form>

@stop
