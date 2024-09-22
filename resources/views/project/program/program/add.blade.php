@extends('layouts.app')
@section('title')
    اضافة تصنيف البرنامج
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
                        <form action="{{ route('program.program.create') }}" method="post">
                            @csrf
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group input-group-outline my-3">
                                        <input required name="program_name" type="text" placeholder="اسم البرنامج" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group input-group-static mb-4">
                                        <label for="exampleFormControlSelect1" class="ms-0">تصنيف البرنامج</label>
                                        <select class="form-control" name="program_category_id" id="user_role">
                                            @foreach ($program_category as $key)
                                                <option value="{{ $key->id }}">{{ $key->program_category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group input-group-static mb-4">
                                        <label for="exampleFormControlSelect1" class="ms-0">التعليمات</label>
                                        <select class="form-control" name="Instructions" id="user_role">
                                            @foreach ($instructions as $key)
                                                <option value="{{ $key->id }}">{{ $key->instructions_name }}</option>
                                            @endforeach
                                        </select>
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
