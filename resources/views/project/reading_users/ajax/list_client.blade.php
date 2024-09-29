<table class="table table-hover">
    <thead>
        <tr>
            <th>اسم العميل</th>
            <th>العمليات</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key)
            <tr>
                <td>{{ $key->name }}</td>
                <td><a href="{{ route('reading_users.details',['client_id'=>$key->id]) }}" class="btn btn-primary btn-sm"><span class="fa fa-search"></span></a></td>
            </tr>
        @endforeach
    </tbody>
</table>