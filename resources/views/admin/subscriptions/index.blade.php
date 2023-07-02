@extends('adminlte::page')

@section('title', 'Подписки')

@section('content_header')
    <h1>Подписки</h1>
@stop

@section('content')
    @include('flash-message')
    <a href="{{ url('/admin/subscriptions/create') }}" class="btn btn-success btn-sm" title="Добавить">
        <i class="fa fa-plus" aria-hidden="true"></i> Добавить
    </a>

    <form method="GET" action="{{ url('/admin/subscriptions') }}" accept-charset="UTF-8"
          class="form-inline my-2 my-lg-0 float-right" role="search">
        <div class="input-group">
            <label>
                <input type="text" class="form-control" name="search" placeholder="Поиск..."
                       value="{{ request('search') }}">
            </label>
            <span class="input-group-append">
                <button class="btn btn-secondary" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </span>
        </div>
    </form>

    <br/>
    <br/>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Курс</th>
                <th>Тариф</th>
                <th>Пользователь</th>
                <th>Оплата</th>
                <th>Статус оплаты</th>
                <th>Начало подписки</th>
                <th>Окончание подписки</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->getCourse->getName->$lang }}</td>
                    <td>{{ $item->getTariff->getName->$lang }}</td>
                    <td>{{ $item->getUser->name }}</td>
                    <td>{{ $item->getPayment->amount }} тг</td>
                    <td>@if($item->payment_status == 1) Активен @elseif($item->payment_status == 0) Не активен @else Ошибка оплаты @endif</td>
                    <td>{{ $item->start_subscribe }}</td>
                    <td>{{ $item->end_subscribe }}</td>
                    <td>
                        <a href="{{ url('/admin/subscriptions/' . $item->id . '/edit') }}" title="Редактировать">
                            <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                      aria-hidden="true"></i> Редактировать
                            </button>
                        </a>

                        <form method="POST" action="{{ url('/admin/subscriptions' . '/' . $item->id) }}"
                              accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                                    onclick="return confirm('Вы уверены что хотите удалить?')"><i class="fa fa-trash-o"
                                                                                             aria-hidden="true"></i>
                                Удалить
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $data->appends(['search' => Request::get('search')])->render() !!} </div>
    </div>

@stop
