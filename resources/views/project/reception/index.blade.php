@extends('layouts.app')
@section('title')
    شاشة الاستقبال
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
                        @foreach($rooms as $key)
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{ route('reception.room',['id'=>$key->id]) }}" class="btn btn-primary btn-sm">{{ $key->name }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
