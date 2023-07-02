@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Контакты {{ $data->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/contacts') }}" title="Back">
                            <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Back
                            </button>
                        </a>
                        <a href="{{ url('/admin/contacts/' . $data->id . '/edit') }}" title="Редактировать">
                            <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                      aria-hidden="true"></i> Редактировать
                            </button>
                        </a>

                        <form method="POST" action="{{ url('admin/contacts' . '/' . $data->id) }}"
                              accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Удалить"
                                    onclick="return confirm('Вы уверены что хотите удалить?')"><i class="fa fa-trash-o"
                                                                                             aria-hidden="true"></i>
                                Удалить
                            </button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $data->id }}</td>
                                </tr>
                                <tr>
                                    <th> Телефон</th>
                                    <td> {{ $data->phone }} </td>
                                </tr>
                                <tr>
                                    <th> Email</th>
                                    <td> {{ $data->email }} </td>
                                </tr>
                                <tr>
                                    <th> Адрес</th>
                                    <td> {{ $data->address }} </td>
                                </tr>
                                <tr>
                                    <th> Ссылка карты</th>
                                    <td> {{ $data->map_url }} </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
