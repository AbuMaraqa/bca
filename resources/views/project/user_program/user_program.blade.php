@extends('layouts.app')
@section('title')
    برامج العميل
@endsection
@section('content')
    @include('project.clients.menu')
    <div class="row mb-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('program.user_program.add') }}" class="btn btn-primary">اضافة برنامج</a>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="row mb-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <input type="text" id="search" class="form-control" placeholder="البحث عن برنامج لعميل">
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class='table-responsive'>
                            <table class="table text-center table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th>تاريخ الاضافة</th>
                                        <th>اسم العميل</th>
                                        <th>اسم البرنامج</th>
                                        <th>العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($data->isEmpty())
                                        <tr>
                                            <td colspan="3" class="text-center">لا توجد بيانات</td>
                                        </tr>
                                    @else
                                        @foreach ($data as $key)
                                            <tr>
                                                <td>{{ $key->created_at }}</td>
                                                <td>{{ $key->client->name }}</td>
                                                <td>{{ $key->program_name }}</td>
                                                <td>
                                                    <a href="{{ route('program.user_program.details', ['program_id' => $key->id]) }}"
                                                        class="btn btn-sm btn-primary"><span
                                                            class="fa fa-search"></span></a>
                                                    <a href="{{ route('program.user_program.print_pdf', ['program_id' => $key->id]) }}"
                                                        class="btn btn-sm btn-warning"><span class="fa fa-print"></span></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            users_program();
            $('#search').keyup(function() {
                users_program();
            })

        });

        function users_program(program_id) {
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
                    client_id: $('#client_id').val(),
                    search: $('#search').val(),
                },
                success: function(data) {
                    if (data.success === true) {
                        $('#users_program_list').html(data.view)
                    }
                }
            });
        }
    </script>
@endsection
