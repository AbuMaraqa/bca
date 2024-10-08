@extends('layouts.app')
@section('title')
    غرفة الاستقبال
@endsection
@section('content')
    <div class="row mb-3">
        <div class="col-md-12">
            @include('alert_message.success')
            @include('alert_message.fail')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('reception.add_appointment', ['room_id' => $id]) }}"
                                class="btn btn-primary btn-sm">اضافة موعد</a>
                        </div>
                        <div class="col-md-12">
                            <div class='table-responsive'>
                                <form action="{{ route('supplements.update_status') }}" method="post">
                                    @csrf
                                    <table style="font-size: 15px"
                                        class="table text-center table-sm table-hover table-responsive">
                                        <thead>
                                            <tr>
                                                <th>اسم الزبون</th>
                                                <th>تاريخ ساعة الحجز</th>
                                                <th>الحالة</th>
                                                <th>العمليات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($data->isEmpty())
                                                <tr>
                                                    <td colspan="4" class="text-center">لا يوجد مواعيد</td>
                                                </tr>
                                            @else
                                                @foreach ($data as $key)
                                                    <tr>
                                                        <td>{{ $key->client->name }}</td>
                                                        <td>{{ $key->appointment_date }}</td>
                                                        <td>
                                                            <select class="form-control text-center"
                                                                @if ($key->status == 'not_attend') style="background-color: #d9534f;color:white"
                                                                @elseif ($key->status == 'waiting') style="background-color: #f0ad4e;color:black"
                                                                @elseif ($key->status == 'under_examination') style="background-color: #5bc0de;color:white"
                                                                @elseif ($key->status == 'done') style="background-color: #5cb85c;color:white" @endif
                                                                onchange="update_status({{ $key->id }}, this.value)">
                                                                <option class="text-center"
                                                                    @if ($key->status == 'waiting') selected @endif
                                                                    value="waiting">قيد الانتظار</option>
                                                                <option class="text-center"
                                                                    @if ($key->status == 'under_examination') selected @endif
                                                                    value="under_examination">تحت الفحص</option>
                                                                <option class="text-center"
                                                                    @if ($key->status == 'done') selected @endif
                                                                    value="done">جاهز</option>
                                                                <option class="text-center"
                                                                    @if ($key->status == 'not_attend') selected @endif
                                                                    value="not_attend">لم يحضر</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('clients.details', ['client_id' => $key->customer_id]) }}"
                                                                class="btn btn-success btn-sm"><span
                                                                    class="fa fa-search"></span></a>
                                                            <a href="" class="btn btn-danger btn-sm"><span
                                                                    class="fa fa-trash"></span></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function update_status(id, status) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('supplements.update_status') }}",
                type: 'POST',
                dataType: "json",
                data: {
                    id: id,
                    status: status,
                    // phone : $('#phone').val(),
                },
                success: function(data) {
                    if (data.success == true) {
                        window.location.reload();
                    }
                }
            });
        }
    </script>
@endsection
