<table class="table-sm table-hover w-100">
    <tbody>
        @if ($data->isEmpty())
            <tr>
                <td class="text-center" colspan="2">لا توجد انواع وجبات</td>
            </tr>
        @endif
        @foreach ($data as $key)
           <tr>
                <td>{{ $key->meal_name }}</td>
                <td style="">
                    <button onclick="add_meal_type_for_program({{ $key }})" class="btn btn-sm btn-success"><span class="fa fa-plus"></span></button>
                </td>
            </tr> 
        @endforeach
    </tbody>
</table>