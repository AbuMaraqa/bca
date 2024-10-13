<table style="font-size: 15px" class="table text-center table-sm table-hover cell-breakWord">
    <thead>
        <tr>
            <th>اسم الصنف</th>
            {{--                                <th>الكمية</th> --}}
            <th>السعرات الحرارية</th>
            <th>كربوهيدرات</th>
            <th>بروتين</th>
            <th>دهون</th>
            <th>الياف</th>
            <th>ملاحظات</th>
            <th>العمليات</th>
        </tr>
    </thead>
    <tbody>
        @if ($data->isEmpty())
            <tr>
                <td colspan="4" class="text-center">لا توجد بيانات</td>
            </tr>
        @else
            @foreach ($data as $key)
                <tr>
                    <td style="word-wrap: break-word;white-space: pre-wrap;">{{ $key->product }}
                    </td>
                    {{--                                        <td>{{ $key->qty }}</td> --}}
                    <td>{{ $key->calories }}</td>
                    <td>{{ $key->carbohydrates }}</td>
                    <td>{{ $key->fats }}</td>
                    <td>{{ $key->protein }}</td>
                    <td>{{ $key->fibers }}</td>
                    <td style="word-wrap: break-word;white-space: pre-wrap;">{{ $key->notes }}
                    </td>
                    <td class="text-center">
                        <a href="{{ route('supplements.edit', ['id' => $key->id]) }}" class="btn btn-success btn-sm"><span
                                class="fa fa-edit"></span></a>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
