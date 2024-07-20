<table class="table table-sm">
    <thead>
        <tr>
            <th>اسم العميل</th>
            <th>تاريخ الميلاد</th>
            <th>رقم الهاتف</th>
            <th>المدينة</th>
            <th>حالة المستخدم</th>
            <th>العمليات</th>
        </tr>
    </thead>
    <tbody>
        @if($data->isEmpty())
            <tr>
                <td colspan="5" class="text-center">لا يوجد بيانات</td>
            </tr>
        @else
            @foreach($data as $key)
                <tr>
                    <td>{{ $key->name }}</td>
                    <td>{{ $key->dob }}</td>
                    <td>{{ $key->phone }}</td>
                    <td>{{ $key->city }}</td>
                    <td>
                        <span class="badge bg-gradient-success">مشترك</span>
                    </td>
                    <td>
                        <a href="{{ route('clients.edit',['id'=>$key->id]) }}" class="btn btn-success btn-sm btn-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top" data-container="body" data-animation="true"><span class="fa fa-edit"></span></a>
                        <a href="" class="btn btn-dark btn-sm btn-tooltip"><span class="fa fa-search"></span></a>
                        <a href="{{ route('customers_debt.index',['client_id'=>$key->id]) }}" class="btn btn-warning btn-sm btn-tooltip"><span class="fa fa-credit-card"></span></a>
                        <a href="{{ route('clients.subscriptions.index',['client_id'=>$key->id]) }}" class="btn btn-warning btn-sm btn-tooltip"><span class="fa fa-address-card"></span></a>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

{{ $data->links() }}
