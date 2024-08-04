@extends('layouts.app')
@section('title')
    قائمة المكملات الغذائية
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
                    <a href="{{ route('supplements.add') }}" class="btn btn-primary">اضافة مكمل غذائي</a>
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
                                <th>اسم المكمل</th>
{{--                                <th>الكمية</th>--}}
                                <th>السعرات الحرارية</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($data->isEmpty())
                                <tr>
                                    <td colspan="4" class="text-center">لا توجد بيانات</td>
                                </tr>
                            @else
                                @foreach($data as $key)
                                    <tr>
                                        <td>{{ $key->product }}</td>
{{--                                        <td>{{ $key->qty }}</td>--}}
                                        <td>{{ $key->calories }}</td>
                                        <td>
                                            <a href="{{ route('supplements.edit',['id'=>$key->id]) }}" class="btn btn-success btn-sm"><span class="fa fa-edit"></span></a>
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
