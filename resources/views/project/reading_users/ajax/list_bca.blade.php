<table class="table table-sm text-center table-hover">
    <thead>
        <tr>
            <th>تاريخ الفحص</th>
            <th>الوزن</th>
            <th>الدهون</th>
            {{-- <th>البروتين</th> --}}
            <th>العضلات</th>
            <th></th>
            {{-- <th>الاملاح</th> --}}
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key)
            <tr>
                <td>{{ $key->insert_at }}</td>
                <td>{{ $key->weight }}</td>
                <td>{{ $key->fats }}</td>
                {{-- <td>{{ $key->liquids }}</td> --}}
                <td>{{ $key->muscles }}</td>
                {{-- <td>{{ $key->salts }}</td> --}}
                <td>
                    <a href="{{ route('reading_users.delete', ['id' => $key->id]) }}" class="btn btn-sm btn-danger"><span
                            class="fa fa-trash"></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
