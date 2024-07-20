<table class="table">
    <thead>
        <tr>
            <th>اسم المستخدم</th>
            <th>صلاحية المستخدم</th>
            <th>الايميل</th>
            <th>حالة المستخدم</th>
            <th>العمليات</th>
        </tr>
    </thead>
    <tbody>
        @if($data->isEmpty())
            <tr>
                <td colspan="4" class="text-center">لا يوجد مستخدمين</td>
            </tr>
        @else
            @foreach($data as $key)
                <tr>
                    <td>{{ $key->name }}</td>
                    <td>{{ $key->email }}</td>
                    <td>{{ $key->email }}</td>
                    <td class="text-center">
                        <div class="form-switch">
                            <input class="form-check-input" onchange="update_status({{ $key->id }} , this.checked)" @if($key->user_status == 'active') checked @endif type="checkbox" id="flexSwitchCheckDefault">
                        </div>
                    </td>
                    <td>
                        <button onclick="open_edit_user_modal({{ $key }})" class="btn btn-success btn-sm"><span class="">تعديل</span></button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
