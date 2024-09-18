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
                    <a href="{{ route('program.meal_type.add') }}" class="btn btn-primary">اضافة تصنيف للبرنامج</a>
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
                                    <label class="form-label">اسم التصنيف</label>
                                    <input id="name" onkeyup="list_program_category()" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="list_program_category" class="table-responsive">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            list_program_category();
        });
        function list_program_category() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('program.program_category.list_program_category') }}",
                type: 'POST',
                dataType: "json",
                data: {
                    name : $('#name').val(),
                    // phone : $('#phone').val(),
                },
                success: function(data) {
                    if (data.success === true){
                        $('#list_program_category').html(data.view);
                    }
                }
            });
        }

    </script>
@endsection
