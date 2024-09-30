<table class="table text-center table-sm table-hover">
    <thead>
        <tr>
            <th>تاريخ الاضافة</th>
            <th>اسم العميل</th>
            <th>العمليات</th>
        </tr>
    </thead>
    <tbody>
        @if ($data->isEmpty())
            <tr>
                <td colspan="3" class="text-center">لا توجد بيانات</td>
            </tr>
        @else
            @foreach ($data as $key)
                <tr>
                    <td>{{ $key->created_at }}</td>
                    <td>{{ $key->client->name }}</td>
                    <td>
                        <a href="{{ route('program.user_program.details', ['program_id' => $key->id]) }}"
                            class="btn btn-sm btn-primary"><span class="fa fa-search"></span></a>
                        <a href="{{ route('program.user_program.print_pdf', ['program_id' => $key->id]) }}"
                            class="btn btn-sm btn-warning"><span class="fa fa-print"></span></a>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
