@extends('adminlte::page')

@section('title', 'Добавить подписку')

@section('content_header')
    <h1>Добавить подписку</h1>
@stop

@section('content')
    <a href="{{ url('/admin/subscriptions') }}" title="Back">
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

    <form method="POST" action="{{ url('/admin/subscriptions') }}" accept-charset="UTF-8" class="form-horizontal"
          enctype="multipart/form-data">
        {{ csrf_field() }}

        @include ('admin.subscriptions.form', ['formMode' => 'create'])

    </form>

@stop
