@extends('layouts.app')
@section('title')
    تعديل نوع الوجبة
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
                    <div class="row">
                        <form action="{{ route('program.meal_type.update') }}" method="post">
                            @csrf
                            <input type="text" hidden name="id" value="{{ $data->id }}">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group input-group-outline my-3">
                                        <input id="meal_name" value="{{ $data->meal_name }}" required name="meal_name" type="text" placeholder="نوع الوجبة" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success">تعديل</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
