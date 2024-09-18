<table class="table table-sm">
    <thead>
        <tr>
            <th>اسم التعليمات</th>
            <th>العمليات</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key)
            <tr>
                <td>{{ $key->instructions_name }}</td>    
                <td>
                    <a href="{{ route('program.instructions.edit',['id'=>$key->id]) }}" class="btn btn-sm btn-success"><span class="fa fa-edit"></span></a>    
                </td>    
            </tr> 
        @endforeach
    </tbody>
</table>