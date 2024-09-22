@extends('layouts.app')
@section('title')
    قائمة البرامج
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
                    <a href="{{ route('program.program.add') }}" class="btn btn-primary">اضافة برنامج</a>
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
                                    <label class="form-label">اسم البرنامج</label>
                                    <input id="name" onkeyup="list_programs()" type="text" class="form-control">
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
                    <div id="list_programs" class="table-responsive">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            list_programs();
            $('#name').keyup(function(){
                list_programs();
            });
        });
        function list_programs() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('program.program.list_programs') }}",
                type: 'POST',
                dataType: "json",
                data: {
                    name : $('#name').val(),
                    // phone : $('#phone').val(),
                },
                success: function(data) {
                    if (data.success === true){
                        $('#list_programs').html(data.view);
                    }
                }
            });
        }

    </script>
@endsection
