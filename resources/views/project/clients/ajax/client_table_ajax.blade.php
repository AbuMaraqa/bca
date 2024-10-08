<table class="table table-sm text-center table-bordered">
    <thead>
        <tr>
            <th>اسم العميل</th>
            <th>تاريخ الميلاد</th>
            <th>رقم الهاتف</th>
            <th>المدينة</th>
            <th>حالة المستخدم</th>
            <th>تاريخ انتهاء الاشتراك</th>
            <th>الديون</th>
            <th>العمليات</th>
        </tr>
    </thead>
    <tbody>
        @if ($data->isEmpty())
            <tr>
                <td colspan="5" class="text-center">لا يوجد بيانات</td>
            </tr>
        @else
            @foreach ($data as $key)
                <tr>
                    <td>{{ $key->name }}</td>
                    <td>{{ $key->dob }}</td>
                    <td>{{ $key->phone }}</td>
                    <td>{{ $key->city }}</td>
                    <td>
                        @if ($key->user_status == 'new')
                            <span class="badge bg-gradient-danger">غير مشترك</span>
                        @elseif ($key->user_status == 'old')
                            <span class="badge bg-gradient-success">مشترك</span>
                        @endif
                    </td>
                    <td>
                        {{ $key->end_subscription }}
                    </td>
                    <td>
                        @if ($key->debt < 0)
                            <span class="badge bg-gradient-warning">{{ $key->debt }}</span>
                        @else
                            <span class="badge bg-gradient-primary">{{ $key->debt }}</span>
                        @endif

                    </td>
                    <td>
                        <a href="{{ route('clients.edit', ['id' => $key->id]) }}"
                            class="btn btn-success btn-sm btn-tooltip" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Tooltip on top" data-container="body" data-animation="true"><span
                                class="fa fa-edit"></span></a>
                        <a href="{{ route('clients.details', ['client_id' => $key->id]) }}"
                            class="btn btn-dark btn-sm btn-tooltip"><span class="fa fa-search"></span></a>
                        {{-- <a href="{{ route('customers_debt.index', ['client_id' => $key->id]) }}"
                            class="btn btn-warning btn-sm btn-tooltip"><span class="fa fa-credit-card"></span></a>
                        <a href="{{ route('clients.subscriptions.index', ['client_id' => $key->id]) }}"
                            class="btn btn-warning btn-sm btn-tooltip"><span class="fa fa-address-card"></span></a> --}}
                        <button onclick="open_freezing_modal({{ $key->id }})" class="btn btn-primary btn-sm"><i
                                class="fas fa-snowflake"></i></button>
                        <a onclick="return confirm('هل تريد حذف العميل؟');"
                            href="{{ route('clients.delete', ['client_id' => $key->id]) }}"
                            class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></a>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

{{-- {{ $data->links() }} --}}
