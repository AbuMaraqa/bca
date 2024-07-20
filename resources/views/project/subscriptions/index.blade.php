@extends('layouts.app')
@section('title')
    قائمة الاشتراكات
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
                    <a href="{{ route('subscriptions.add') }}" class="btn btn-primary">اضافة اشتراك</a>
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
                                    <th>اسم الاشتراك</th>
                                    <th>مدة الاشتراك</th>
                                    <th>سعر الاشتراك</th>
                                    <th>حالة الاشتراك</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($data->isEmpty())
                                    <tr>
                                        <td colspan="5" class="text-center">لا توجد بيانات</td>
                                    </tr>
                                @else
                                    @foreach($data as $key)
                                        <tr>
                                            <td>{{ $key->name }}</td>
                                            <td>{{ $key->duration }}</td>
                                            <td>{{ $key->price }}</td>
                                            <td>{{ $key->status }}</td>
                                            <td>
                                                <a href="{{ route('subscriptions.edit',['id'=>$key->id]) }}" class="btn btn-success btn-sm"><span class="fa fa-edit"></span></a>
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
