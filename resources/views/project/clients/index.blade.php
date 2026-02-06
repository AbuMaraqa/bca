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
                                    <input name="phone" id="phone" type="text"
                                        class="form-control">
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
    @include('project.clients.modals.freezing_subscription_modal')
@endsection
@section('script')
    <script>
        var searchRequest = null;
        var debounceTimer = null;

        $(document).ready(function() {
            $('#name, #phone').on('keyup', function() {
                handleSearch();
            });
            
            list_users();
        });

        function handleSearch() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(function() {
                list_users();
            }, 500);
        }

        var page = 1;
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            page = $(this).attr('href').split('page=')[1];
            list_users(page);
        });

        function list_users(page) {
            if (searchRequest) {
                searchRequest.abort();
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            searchRequest = $.ajax({
                url: "{{ route('clients.list_clients_ajax') }}",
                type: 'POST',
                dataType: "json",
                data: {
                    name: $('#name').val(),
                    phone: $('#phone').val(),
                    page: page
                },
                success: function(data) {
                    if (data.status === 'success') {
                        $('#clients_table').html(data.view);
                    }
                }
            });
        }

        function open_freezing_modal(client_id) {
            $('#client_id').val(client_id);
            $('#freezing_subscription_modal').modal('show');
        }
    </script>
@endsection
