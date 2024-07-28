@extends('layouts.app')
@section('title')
    غرفة الاستقبال
@endsection
@section('content')
    <div class="row mb-3">
        <div class="col-md-12">
            @include('alert_message.success')
            @include('alert_message.fail')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('reception.add_appointment') }}" class="btn btn-primary btn-sm">اضافة موعد</a>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-sm table-hover">
                                    <thead>
                                        <tr>
                                            <th>اسم الزبون</th>
                                            <th>تاريخ ساعة الحجز</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if($data->isEmpty())
                                        <tr>
                                            <td colspan="2" class="text-center">لا توجد بيانات</td>
                                        </tr>
                                    @else
                                        @foreach($data as $key)
                                            <tr>
                                                <td>{{ $key->customer_id }}</td>
                                                <td></td>
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
        </div>
    </div>
@endsection
