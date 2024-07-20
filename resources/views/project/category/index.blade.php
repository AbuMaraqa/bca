@extends('layouts.app')
@section('title')
    قائمة التصنيفات
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
                    <button data-bs-toggle="modal" data-bs-target="#add_category_modal" class="btn btn-primary">اضافة تصنيف</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>اسم التصنيف</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($data->isEmpty())
                            <tr>
                                <td colspan="2" class="text-center">لا يوجد بيانات</td>
                            </tr>
                        @else
                            @foreach($data as $key)
                                <tr>
                                    <td>{{ $key->name }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-success" href="{{ route('category.edit',['id'=>$key->id]) }}"><span class="fa fa-edit"></span></a>
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
    @include('project.category.modals.add_category_modal')
@endsection
@section('script')
    <script>
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
