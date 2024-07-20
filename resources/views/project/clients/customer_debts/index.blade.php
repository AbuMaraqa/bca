@extends('layouts.app')
@section('title')
    ديون العميل
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
                    <a href="{{ route('customers_debt.add',['client_id'=>$client->id]) }}" class="btn btn-primary">اضافة دين</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-sm text-center">
                                <thead>
                                    <tr>
                                        <th>القيمة</th>
                                        <th>نوع الدين</th>
                                        <th>ملاحظات</th>
                                        <th>التاريخ</th>
                                        <th>العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $key)
                                        <tr>
                                            <td>{{ $key->value }}</td>
                                            <td>
                                                @if($key->type == 'creditor')
                                                    عليه
                                                @else
                                                    له
                                                @endif
                                            </td>
                                            <td>{{ $key->notes }}</td>
                                            <td>{{ $key->insert_at }}</td>
                                            <td>
                                                <a class="btn btn-danger btn-sm" onclick="return confirm('هل انت متاكد من عملية الحذف ؟')" href="{{ route('customers_debt.delete',['id'=>$key->id]) }}"><span class="fa fa-trash"></span></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td>{{ $total_debt }}</td>
                                        <td colspan="4" class="bg-dark text-white">المجموع</td>
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
