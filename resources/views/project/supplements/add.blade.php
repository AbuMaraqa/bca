@extends('layouts.app')
@section('title')
    اضافة مكمل غذائي
@endsection
@section('content')
    <div class="row">
            <form action="{{ route('supplements.create') }}" method="post" enctype="multipart/form-data">
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
                                                    <label class="form-label">اسم المنتج</label>
                                                    <input name="product" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
{{--                                        <div class="col-md-6">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <div class="input-group input-group-outline my-3">--}}
{{--                                                    <label class="form-label">الكمية</label>--}}
{{--                                                    <input name="qty" value="{{ old('qty') }}" type="text" class="form-control">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="input-group input-group-outline my-3">
                                                    <label class="form-label">السعرات الحرارية</label>
                                                    <input name="calories" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="input-group input-group-outline my-3">
                                                    <label class="form-label">كايبوهيدرات</label>
                                                    <input name="carbohydrates" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="input-group input-group-outline my-3">
                                                    <label class="form-label">دهون</label>
                                                    <input name="fats" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="input-group input-group-outline my-3">
                                                    <label class="form-label">الياف</label>
                                                    <input name="fibers" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="input-group input-group-outline my-3">
                                                    <label class="form-label">بروتين</label>
                                                    <input name="protein" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">حفظ</button>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="row text-center">
                                        <div class="col-md-12 text-center">
                                            <h4>اضافة مكمل غذائي</h4>
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
