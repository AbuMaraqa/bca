@extends('layouts.app')
@section('title')
    اضافة نوع للوجبة
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
                        <form action="{{ route('program.meal_type.create') }}" method="post">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group input-group-outline my-3">
                                        <input id="program_category_name" required name="meal_name" type="text" placeholder="اسم نوع الوجبة" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success">اضافة</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
