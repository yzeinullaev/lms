@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Курсы {{ $data->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/courses') }}" title="Back">
                            <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Back
                            </button>
                        </a>
                        <a href="{{ url('/admin/courses/' . $data->id . '/edit') }}" title="Edit Banner">
                            <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                      aria-hidden="true"></i> Edit
                            </button>
                        </a>

                        <form method="POST" action="{{ url('admin/banners' . '/' . $data->id) }}"
                              accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Banner"
                                    onclick="return confirm('Confirm delete?')"><i class="fa fa-trash-o"
                                                                                  aria-hidden="true"></i>
                                Delete
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
                                    <th> Name</th>
                                    <td> {{ $data->name }} </td>
                                </tr>
                                <tr>
                                    <th> Content</th>
                                    <td> {{ $data->content }} </td>
                                </tr>
                                <tr>
                                    <th> Images</th>
                                    <td> {{ $data->images }} </td>
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
