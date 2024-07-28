@extends('layouts.app')
@section('title')
    اضافة منتج
@endsection
@section('content')
    <div class="row">

        <form action="{{ route('rooms.create') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="col-md-12 alert alert-danger text-white">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="input-group input-group-outline my-3">
                                                <label class="form-label">اسم الغرفة</label>
                                                <input name="name" value="{{ old('name') }}" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group input-group-outline my-3">
                                                <select name="user_id" class="form-control">
                                                    <option value="">اختر مختص لهذه الغرفة ...</option>
                                                    @foreach($users as $key)
                                                        <option value="{{ $key->id }}">{{ $key->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">حفظ</button>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="row text-center">
                                    <span style="font-size: 200px" class="fa fa-home"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
