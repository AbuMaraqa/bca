@extends('layouts.app')
@section('title')
    قائمة القراءات
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">اسم العميل</label>
                                    <input id="name" type="text" class="form-control">
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
                    <div id="list_reading_users_ajax" class="table-responsive">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#name').on('keyup', function() {
                list_reading_users_ajax();
            });
            list_reading_users_ajax();
        });

        function list_reading_users_ajax() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('reading_users.list_reading_users_ajax') }}",
                type: 'POST',
                dataType: "json",
                data: {
                    name: $('#name').val(),
                },
                success: function(data) {
                    if (data.success === true) {
                        $('#list_reading_users_ajax').html(data.view);
                    }
                }
            });
        }
    </script>
@endsection
