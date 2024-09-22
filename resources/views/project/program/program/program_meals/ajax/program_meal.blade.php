@foreach ($data as $day => $meals)
    <h3>اليوم {{ $day }}</h3>
    <div class="col-md-12">
        
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>نوع الوجبة</th>
                <th>الأصناف</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($meals as $meal)
                <tr>
                    <td>{{ $meal->meal_type->meal_name ?? '' }} <span onclick="open_add_supplement_for_meal_type_modal({{ $meal }})" class="btn btn-sm btn-success fa fa-plus"></span></td>
                    <td>{{ $meal->id }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endforeach