@extends('layouts.app')
@section('title')
    تعديل تصنيف برنامج
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
                        <form action="{{ route('program.program_category.update') }}" method="post">
                            @csrf
                            <input type="text" hidden name="id" value="{{ $data->id }}">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group input-group-outline my-3">
                                        <input id="program_category_name" value="{{ $data->program_category_name }}" required name="program_category_name" type="text" placeholder="اسم التصنيف" class="form-control">
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
