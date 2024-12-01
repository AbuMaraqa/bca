<table class="table table-sm table-bordered text-center table-hover table-striped">
    <thead>
        <tr>
            <th>اسم الزبون</th>
            <th>الغرفة</th>
            <th>الموعد</th>
            <th>الحالة</th>
            <th style="width: 10%">العمليات</th>
        </tr>
    </thead>
    <tbody>
        @if ($data->isEmpty())
            <tr>
                <td colspan="5" class="text-center">لا توجد مواعيد اليوم</td>
            </tr>
        @else
            @foreach ($data as $key)
                <tr>
                    <td class="justify-content-center align-content-center">{{ $key->client->name ?? '' }}</td>
                    <td class="justify-content-center align-content-center">{{ $key->room->name ?? '' }}</td>
                    <td class="justify-content-center align-content-center">{{ $key->appointment_date }}</td>
                    <td class="justify-content-center align-content-center">
                        <select class="form-control text-center btn-xs"
                            @if ($key->status == 'not_attend') style="background-color: #d9534f;color:white"
                                                            @elseif ($key->status == 'waiting') style="background-color: #f0ad4e;color:black"
                                                            @elseif ($key->status == 'under_examination') style="background-color: #5bc0de;color:white"
                                                            @elseif ($key->status == 'done') style="background-color: #5cb85c;color:white" @endif
                            onchange="update_status({{ $key->id }}, this.value)">
                            <option class="text-center" @if ($key->status == 'waiting') selected @endif value="waiting">
                                قيد
                                الانتظار</option>
                            <option class="text-center" @if ($key->status == 'under_examination') selected @endif
                                value="under_examination">تحت الفحص</option>
                            <option class="text-center" @if ($key->status == 'done') selected @endif
                                value="done">
                                جاهز
                            </option>
                            <option class="text-center" @if ($key->status == 'not_attend') selected @endif
                                value="not_attend">
                                لم يحضر</option>
                        </select>
                    </td>
                    <td class="justify-content-center align-content-center">
                        <a href="{{ route('clients.details', ['client_id' => $key->customer_id]) }}"
                            class="btn btn-success mb-0 btn-xs"><span class="fa fa-search"></span></a>
                        <a href="{{ route('reception.delete', ['id' => $key->id]) }}"
                            class="btn btn-xs mb-0 btn-danger"><span class="fa fa-trash"></a>
                    </td>
                </tr>
            @endforeach

        @endif
    </tbody>
</table>
