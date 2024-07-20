@extends('layouts.app')
@section('title')
    تعديل التصنيف
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <form action="{{ route('category.update') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">اسم التصنيف</label>
                                        <input type="text" id="" name="name" value="{{ $data->name }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">تعديل</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
