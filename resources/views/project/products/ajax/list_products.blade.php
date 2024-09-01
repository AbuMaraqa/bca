<table class="table table-sm">
    <thead>
        <tr>
            <th></th>
            <th>اسم المنتج</th>
            <th>تصنيف المنتج</th>
{{--            <th>نوع المنتج</th>--}}
{{--            <th>وقت الاشتراك</th>--}}
            <th>سعر المنتج</th>
            <th>حالة المنتج</th>
            <th>العمليات</th>
        </tr>
    </thead>
    <tbody>
        @if($data->isEmpty())
            <tr>
                <td colspan="7" class="text-center">لا توجد بيانات</td>
            </tr>
        @else
            @foreach($data as $key)
                <tr>
                    <td>
                        <img style="width: 50px" src="{{ asset('storage/product/'.$key->image) }}" alt="">
                    </td>
                    <td>{{ $key->name }}</td>
                    <td>{{ $key->category->name }}</td>
{{--                    <td>{{ $key->type }}</td>--}}
                    <td>{{ $key->price }}</td>
{{--                    <td>{{ $key->duration }}</td>--}}
                    <td class="text-center">
                        @if($key->status == 'active')
                            <span class="badge bg-success">فعال</span>
                        @else
                            <span class="badge bg-danger">غير فعال</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('product.edit',['id'=>$key->id]) }}" class="btn btn-success btn-sm"><span class="fa fa-edit"></span></a>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
