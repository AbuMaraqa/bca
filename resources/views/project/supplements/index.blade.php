@extends('layouts.app')
@section('title')
    قائمة المكملات الغذائية
@endsection
@section('style')

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
                    <a href="{{ route('supplements.add') }}" class="btn btn-primary">اضافة صنف</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover cell-breakWord">
                            <thead>
                            <tr>
                                <th>اسم الصنف</th>
{{--                                <th>الكمية</th>--}}
                                <th>السعرات الحرارية</th>
                                <th>كربوهيدرات</th>
                                <th>بروتين</th>
                                <th>دهون</th>
                                <th>الياف</th>
                                <th>ملاحظات</th>
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
                                        <td style="word-wrap: break-word;white-space: pre-wrap;">{{ $key->product }}</td>
{{--                                        <td>{{ $key->qty }}</td>--}}
                                        <td>{{ $key->calories }}</td>
                                        <td>{{ $key->carbohydrates }}</td>
                                        <td>{{ $key->fats }}</td>
                                        <td>{{ $key->protein }}</td>
                                        <td>{{ $key->fibers }}</td>
                                        <td style="word-wrap: break-word;white-space: pre-wrap;">{{ $key->notes }}</td>
                                        <td class="text-center">
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
