@extends('layouts.app')
@section('title')
    قائمة التعليمات
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
                    <a href="{{ route('program.instructions.add') }}" class="btn btn-primary">اضافة تعليمات</a>
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
                                    <label class="form-label">اسم التعليمات</label>
                                    <input id="name" onkeyup="list_instructions()" type="text" class="form-control">
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
                    <div id="list_instructions" class="table-responsive">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            list_instructions();
        });
        function list_instructions() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('program.instructions.list_instructions') }}",
                type: 'POST',
                dataType: "json",
                data: {
                    name : $('#name').val(),
                    // phone : $('#phone').val(),
                },
                success: function(data) {
                    if (data.success === true){
                        $('#list_instructions').html(data.view);
                    }
                }
            });
        }

    </script>
@endsection
