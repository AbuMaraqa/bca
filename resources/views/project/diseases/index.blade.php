@extends('layouts.app')
@section('title')
    قائمة التصنيفات
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
                    <a class="btn btn-primary" href="{{ route('diseases.add') }}" class="btn btn-primary">اضافة مرض</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>اسم المرض</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($data->isEmpty())
                                <tr>
                                    <td colspan="2" class="text-center">لا يوجد بيانات</td>
                                </tr>
                            @else
                                @foreach ($data as $key)
                                    <tr>
                                        <td>{{ $key->name }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('diseases.edit', ['id' => $key->id]) }}"><span
                                                    class="fa fa-edit"></span></a>
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
@endsection
