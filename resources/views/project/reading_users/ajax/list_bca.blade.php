<table class="table table-sm text-center table-hover">
    <thead>
        <tr>
            <th>تاريخ الفحص</th>
            <th>الوزن</th>
            <th>الدهون</th>
            <th>البروتين</th>
            <th>العضلات</th>
            <th>الاملاح</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key)
            <tr>
                <td>{{ $key->insert_at }}</td>
                <td>{{ $key->weight }}</td>
                <td>{{ $key->fats }}</td>
                <td>{{ $key->liquids }}</td>
                <td>{{ $key->muscles }}</td>
                <td>{{ $key->salts }}</td>
            </tr>
        @endforeach
    </tbody>
</table>