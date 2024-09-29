@extends('layouts.app')
@section('title')
    برامج العميل
@endsection
@section('content')
    <div class="row mb-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('program.user_program.add')}}" class="btn btn-primary">اضافة برنامج</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 table-responsive" id="users_program_list">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            users_program();
        })

        function users_program(program_id){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('program.user_program.users_program') }}",
                type: 'POST',
                dataType: "json",
                data: {
                    client_id: $('#client_id').val()
                },
                success: function(data) {                    
                    if (data.success === true){
                        $('#users_program_list').html(data.view)
                    }
                }
            });
        }
    </script>
@endsection
