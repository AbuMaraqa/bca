@extends('layouts.app')
@section('title')
    قائمة الغرف
@endsection
@section('content')
    <div class="row mb-3">
        <div class="col-md-12">
            @include('alert_message.success')
            @include('alert_message.fail')
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('rooms.add') }}" class="btn btn-primary">اضافة غرفة</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>اسم الغرفة</th>
                                    <th>اسم المختص</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($data->isEmpty())
                                    <tr>
                                        <td colspan="3" class="text-center">لا توجد بيانات</td>
                                    </tr>
                                @else
                                    @foreach ($data as $key)
                                        <tr>
                                            <td>{{ $key->name }}</td>
                                            <td>{{ $key->user->name }}</td>
                                            <td>
                                                <a href="{{ route('rooms.edit', ['id' => $key->id]) }}"
                                                    class="btn btn-success btn-sm"><span class="fa fa-edit"></span></a>
                                                <a href="{{ route('rooms.delete', ['id' => $key->id]) }}"
                                                    class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
