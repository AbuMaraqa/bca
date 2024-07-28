@extends('layouts.app')
@section('title')
    قائمة المنتجات
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
                    <a href="{{ route('rooms.add') }}" class="btn btn-primary">اضافة منتج</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">اسم المنتج</label>
                                    <input id="name" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group input-group-outline my-3">
                                    <select class="form-control" name="" id="">
                                        <option value="">كل التصنيفات</option>
                                    </select>
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
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="products_table" class="table-responsive">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            list_products();
        });
        function list_products() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('product.list_products_ajax') }}",
                type: 'POST',
                dataType: "json",
                data: {
                    // name : $('#name').val(),
                    // phone : $('#phone').val(),
                },
                success: function(data) {
                    if (data.success === true){
                        $('#products_table').html(data.view);
                    }
                }
            });
        }

    </script>
@endsection
