@extends('layouts.app')
@section('title')
    تعديل اشتراك
@endsection
@section('content')
    <div class="row">
        <form action="{{ route('subscriptions.update') }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <input type="hidden" name="id" value="{{ $data->id }}">
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
                                                <label class="form-label">اسم الاشتراك</label>
                                                <input name="name" value="{{ old('name',$data->name) }}" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group input-group-outline my-3">
                                                <label class="form-label">مدة الاشتراك بالايام</label>
                                                <input name="duration" value="{{ old('duration',$data->duration) }}" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group input-group-outline my-3">
                                                <label class="form-label">سعر الاشتراك</label>
                                                <input name="price" value="{{ old('price',$data->price) }}" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" name="status" type="checkbox" id="flexSwitchCheckDefault" @if(old('status',$data->status) == 'active') checked @endif>
                                                <label class="form-check-label" for="flexSwitchCheckDefault">حالة الاشتراك</label>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">تعديل</button>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="row text-center">
                                    <div class="col-md-12 text-center">
                                        <h4>اضافة اشتراك</h4>
                                        <span style="font-size: 150px" class="fa fa-receipt"></span>
                                    </div>
                                </div>
                            </div>
                            {{--                        <div class="col-md-4">--}}
                            {{--                            <div class="form-group">--}}
                            {{--                                <div class="input-group input-group-outline my-3">--}}
                            {{--                                    <label class="form-label">المدينة</label>--}}
                            {{--                                    <input name="city" type="text" class="form-control">--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                        </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
