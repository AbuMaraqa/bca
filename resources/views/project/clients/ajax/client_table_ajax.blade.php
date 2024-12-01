<table class="table text-center table-bordered table-hover table-striped">
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
                    <td class="text-end justify-content-center align-content-center"><a
                            href="{{ route('clients.details', ['client_id' => $key->id]) }}" class="me-2">{{ $key->name }}</a></td>
                    <td class="justify-content-center align-content-center">{{ $key->dob }}</td>
                    <td class="justify-content-center align-content-center">{{ $key->phone }}</td>
                    <td class="justify-content-center align-content-center">{{ $key->city }}</td>
                    <td class="justify-content-center align-content-center">
                        @if ($key->user_status == 'new')
                            <span class="badge bg-gradient-danger w-75">غير مشترك</span>
                        @elseif ($key->user_status == 'old')
                            @if (
                                !is_null($key->start_freezing_date) &&
                                    !is_null($key->end_freezing_date) &&
                                    \Carbon\Carbon::now()->between($key->start_freezing_date, $key->end_freezing_date))
                                <form action="{{ route('clients.freezing_subscription.cancel_freezing_subscription') }}"
                                    method="post">
                                    @csrf
                                    <input type="text" name="client_id" value="{{ $key->id }}" hidden>
                                    <button type="submit" onclick="return confirm('هل تريد الغاء تجميد الاشتراك')"
                                        class="badge bg-gradient-warning">مجمد</button>
                                </form>
                            @elseif (!is_null($key->end_subscription) && \Carbon\Carbon::now()->lessThanOrEqualTo($key->end_subscription))
                                <span class="badge bg-gradient-success w-75">مشترك</span>
                            @else
                                <span class="badge bg-gradient-danger w-75">غير مشترك</span>
                            @endif
                        @endif

                    </td>
                    <td class="justify-content-center align-content-center">
                        {{ $key->end_subscription }}
                    </td>
                    <td class="justify-content-center align-content-center">
                        @if ($key->debt < 0)
                            <span class="badge bg-gradient-danger w-50">{{ $key->debt }}</span>
                        @else
                            <span class="badge bg-gradient-warning w-50">{{ $key->debt }}</span>
                        @endif

                    </td>
                    <td class="justify-content-center align-content-center">
                        <a href="{{ route('clients.edit', ['id' => $key->id]) }}"
                            class="btn btn-success mb-0 btn-xs btn-tooltip" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Tooltip on top" data-container="body" data-animation="true"><span
                                class="fa fa-edit"></span></a>
                        <a href="{{ route('clients.details', ['client_id' => $key->id]) }}"
                            class="btn btn-dark btn-xs mb-0 btn-tooltip"><span class="fa fa-search"></span></a>
                        {{-- <a href="{{ route('customers_debt.index', ['client_id' => $key->id]) }}"
                            class="btn btn-warning btn-sm btn-tooltip"><span class="fa fa-credit-card"></span></a>
                        <a href="{{ route('clients.subscriptions.index', ['client_id' => $key->id]) }}"
                            class="btn btn-warning btn-sm btn-tooltip"><span class="fa fa-address-card"></span></a> --}}
                        <button onclick="open_freezing_modal({{ $key->id }})" class="btn mb-0 btn-warning btn-xs"><i
                                class="fas fa-snowflake"></i></button>
                        <a onclick="return confirm('هل تريد حذف العميل؟');"
                            href="{{ route('clients.delete', ['client_id' => $key->id]) }}"
                            class="btn btn-xs mb-0 btn-danger"><span class="fa fa-trash"></span></a>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
{{-- {{ $data->links() }} --}}
