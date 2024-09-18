<table class="table table-sm">
    <thead>
        <tr>
            <th>اسم التصنيف</th>
            <th>العمليات</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key)
            <tr>
                <td>{{ $key->program_category_name }}</td>    
                <td>
                    <a href="{{ route('program.program_category.edit',['id'=>$key->id]) }}" class="btn btn-sm btn-success"><span class="fa fa-edit"></span></a>    
                </td>    
            </tr> 
        @endforeach
    </tbody>
</table>