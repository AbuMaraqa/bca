@extends('layouts.app')
@section('title')
    قائمة المستخدمين
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#add_users_modal">
                        اضافة مستخدم
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="users_table">

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('project.users.modals.add_users_modal')
    @include('project.users.modals.edit_users_modal')
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            users_table();
        })
        function users_table() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('users.users_table_ajax') }}",
                type: 'POST',
                dataType: "json",
                data: {

                },
                success: function(data) {
                    $('#users_table').html(data.view);
                }
            });
        }

        function update_status(user_id , value) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('users.update_status') }}",
                type: 'POST',
                dataType: "json",
                data: {
                    user_id : user_id,
                    value : value
                },
                success: function(data) {

                }
            });
        }

        function open_edit_user_modal(data) {
            $('#edit_users_modal').modal('show');
            $('#user_id').val(data.id);
            $('#user_name').val(data.name);
            $('#user_email').val(data.email);
            $('#user_role').val(data.user_role);
            $('#user_status').val(data.user_status);
        }
    </script>
@endsection
