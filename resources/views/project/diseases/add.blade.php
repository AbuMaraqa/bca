@extends('layouts.app')
@section('title')
    اضافة مرض
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <form action="{{ route('diseases.create') }}" method="post">
                            @csrf
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">اسم المرض</label>
                                        <input type="text" id="" name="name"" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">اضافة</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
