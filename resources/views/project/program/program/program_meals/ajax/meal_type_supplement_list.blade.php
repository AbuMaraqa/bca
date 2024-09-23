<table class="table table-sm table-bordered table-hover">
        <thead>
            <tr>
                <th>اسم الصنف</th>
                <th>calories</th>
                <th>carbohydrates</th>
                <th>fats</th>
                <th>protein</th>
                <th>fibers</th>
                <th>العمليات</th>
            </tr>
        </thead>
        <tbody>
            @if ($data->isEmpty())
            <tr>
                <td class="text-center" colspan="2">لا توجد انواع وجبات</td>
            </tr>
        @endif
            @foreach ($data as $key)
            <tr>
                    <td class="long-text">{{ $key->product }}</td>
                    <td>{{ $key->calories }}</td>
                    <td>{{ $key->carbohydrates }}</td>
                    <td>{{ $key->fats }}</td>
                    <td>{{ $key->protein }}</td>
                    <td>{{ $key->fibers }}</td>
                    <td>
                        <button onclick="add_supplement_for_meal_type({{ $key->id }})" class="btn btn-success btn-sm"><span class="fa fa-plus"></span></button>
                    </td>
                </tr> 
            @endforeach
        </tbody>
</table>