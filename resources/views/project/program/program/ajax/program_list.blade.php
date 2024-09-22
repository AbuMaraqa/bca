<table class="table table-sm">
    <thead>
        <tr>
            <th>اسم التعليمات</th>
            <th>تصنيف التعليمات</th>
            <th>العمليات</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key)
            <tr>
                <td>{{ $key->program_name }}</td>    
                <td>{{ $key->program_category->program_category_name }}</td>    
                <td>
                    <a href="{{ route('program.program.edit',['id'=>$key->id]) }}" class="btn btn-sm btn-success"><span class="fa fa-edit"></span></a>    
                    <a href="{{ route('program.program_meal.index',['program_id'=>$key->id]) }}" class="btn btn-sm btn-dark"><span class="fa fa-tasks"></span></a>    
                </td>    
            </tr> 
        @endforeach
    </tbody>
</table>