@extends('layouts.app')
@section('title')
    اشتراكات العميل
@endsection
@section('content')
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('clients.subscriptions.add',['client_id'=>$client->id]) }}" class="btn btn-primary">اضافة اشتراك</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>اشترك العميل محمد مرقة</h4>
                            <h5>الديون : <span>{{ $client->debt }}</span></h5>
                        </div>
                    </div>
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
                            <table class="table table-sm">
                                <thead>
                                <tr>
                                    <th>اسم الاشتراك</th>
                                    <th>السعر</th>
                                    <th>تاريخ الاشتراك</th>
                                    <th>مدة الاشتراك</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($data->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">لا يوجد اشتراك للعميل</td>
                                    </tr>
                                @else
                                    @foreach($data as $key)
                                        <tr>
                                            <td>{{ $key->subscription->name }}</td>
                                            <td>{{ $key->price }}</td>
                                            <td>{{ $key->insert_at }}</td>
                                            <td>{{ $key->duration }}</td>
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
@endsection
