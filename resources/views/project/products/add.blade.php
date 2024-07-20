@extends('layouts.app')
@section('title')
    اضافة منتج
@endsection
@section('content')
    <div class="row">

            <form action="{{ route('product.create') }}" method="post" enctype="multipart/form-data">
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
                                                    <input name="name" value="{{ old('name') }}" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="input-group input-group-outline my-3">
                                                    <label class="form-label">سعر التكلفة</label>
                                                    <input name="cost_price" value="{{ old('cost_price') }}" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="input-group input-group-outline my-3">
                                                    <label class="form-label">سعر البيع</label>
                                                    <input name="price" value="{{ old('price') }}" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="input-group input-group-outline my-3">
                                                    <select class="form-control" name="category_id" id="">
                                                        <option value="">اختر تصنيف</option>
                                                        @foreach($category as $key)
                                                            <option @if($key->id == old('category_id')) selected @endif value="{{ $key->id }}">{{ $key->name }}</option>
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
                                        <div class="col-md-12 text-center">
                                            <label for="">صورة المنتج</label> <br>
                                            <input type="file" name="image" class="">
                                        </div>
                                        <span style="font-size: 200px" class="fa fa-image"></span>
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
