@extends('layouts.app')
@section('title')
    اضافة اشتراك لعميل
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('clients.subscriptions.create') }}" method="post">
                        @csrf
                        <input type="hidden" value="{{ $client->id }}" name="client_id">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6>اضافة اشتراك للعميل <span class="text-primary">{{ $client->name }}</span></h6>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group input-group-outline my-3">
                                                <select required class="form-control" name="subscriptions_id" id="">
                                                    <option value="">اختر الاشتراك</option>
                                                    @foreach($subscriptions as $key)
                                                        <option value="{{ $key->id }}">{{ $key->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">اضافة الاشتراك</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <h4>اضافة اشتراك للعميل</h4>
                                <span style="font-size: 200px" class="fa fa-address-card"></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
