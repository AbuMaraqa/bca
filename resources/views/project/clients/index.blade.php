@extends('layouts.app')
@section('title')
    قائمة العملاء
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
                    <a href="{{ route('clients.add') }}" class="btn btn-primary">اضافة عميل</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">اسم العميل</label>
                                    <input id="name" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">رقم هاتف العميل</label>
                                    <input name="phone" onkeydown="list_users()" id="phone" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">حالة العميل</label>
                                    <input name="city" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">المدينة</label>
                                    <input name="city" type="text" class="form-control">
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
                    <div id="clients_table" class="table-responsive">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#name').on('keyup', function() {
                list_users();
            });

            $('#phone').on('keydown', function() {
                list_users();
            });
            list_users();
        });
        function list_users() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('clients.list_clients_ajax') }}",
                type: 'POST',
                dataType: "json",
                data: {
                    name : $('#name').val(),
                    phone : $('#phone').val(),
                },
                success: function(data) {
                    if (data.status === 'success'){
                        $('#clients_table').html(data.view);
                    }
                }
            });
        }

    </script>
@endsection
