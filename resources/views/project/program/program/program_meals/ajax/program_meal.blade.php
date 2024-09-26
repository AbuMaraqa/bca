<div class="container">
    @if ($data->isEmpty())
    <h4 class="text-center">لم يتم اضافة اي نوع وجبة على البرنامج</h4>
    @else
    @foreach ($data as $day => $meals)
        @php
            $calories = 0;
            $carbohydrates = 0;
            $fats = 0;
            $protein = 0;
            $fibers = 0;
        @endphp
        <div class="day-section card shadow-lg p-3 mb-5 bg-white rounded">
            <div class="card-body">
                <h3 class="text-center my-4 text-success">اليوم {{ $day }}</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>نوع الوجبة</th>
                                <th class="text-center">الأصناف</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($meals as $meal)
                                <tr>
                                    <td class="align-middle text-center">
                                        <button class="btn btn-sm btn-success fa fa-plus ml-2" 
                                            onclick="open_add_supplement_for_meal_type_modal({{ $meal }})">
                                            {{ $meal->meal_type->meal_name ?? '' }}                                        
                                        </button>
                                        <br>
                                        <button class="btn btn-sm btn-danger fa fa-minus ml-2" 
                                            onclick="delete_meal_type_from_program({{ $meal }})">
                                            {{ $meal->meal_type->meal_name ?? '' }}                                        
                                        </button>
                                    </td>
                                    <td>
                                        <div class="meal-supplements">
                                            <table style="width: 100%; border: 1px solid black; padding: 10px; border-collapse: collapse;">
                                                <thead class="bg-light">
                                                    <tr style="background-color: #f8f9fa;">
                                                        <th style="padding: 10px; border: 1px solid black; text-align: right; color: black; width:6%;">الكمية <i class="fa fa-cutlery"></i></th>
                                                        <th style="padding: 10px; border: 1px solid black; text-align: right; color: black; width: 45%;">الصنف <i class="fa fa-cutlery"></i></th>
                                                        <th style="padding: 10px; border: 1px solid black; text-align: right; color: black; width: 45%;">ملاحظات <i class="fa fa-pencil"></i></th>
                                                        <th style="padding: 10px; border: 1px solid black; text-align: right; color: black; width: 4%;"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="supplement_for_meal_type_row_{{ $meal->id }}">
                                                    @if ($meal->program_meal_supplement->isEmpty())
                                                        <tr>
                                                            <td colspan="3" class="text-center p-2">لا يوجد أصناف لنوع الوجبة هذه</td>
                                                        </tr>
                                                    @else
                                                        @foreach ($meal->program_meal_supplement as $key)
                                                        @php
                                                            $calories = $calories + ($key->supplement->calories * ($key->qty ?? 1));
                                                            $carbohydrates = $carbohydrates + ($key->supplement->carbohydrates * ($key->qty ?? 1));
                                                            $fats = $fats + ($key->supplement->fats * ($key->qty ?? 1));
                                                            $protein = $protein + ($key->supplement->protein * ($key->qty ?? 1));
                                                            $fibers = $fibers + ($key->supplement->fibers * ($key->qty ?? 1));
                                                        @endphp
                                                            <tr id="meal_program_meal_supplement_row_{{ $key->id }}">
                                                                <td class="font-weight-bold text-dark long-text" style="padding: 10px; border: 1px solid black; text-align: right; color: black;">
                                                                    <input type="number" value="{{ $key->qty }}" onchange="update_data_ajax('qty',{{ $key->id }} , this.value)" class="form-control text-center">
                                                                </td>
                                                                <td class="font-weight-bold text-dark long-text" style="padding: 10px; border: 1px solid black; text-align: right; color: black;">
                                                                    {{ $key->supplement->product }}
                                                                </td>
                                                                <td style="padding: 10px; border: 1px solid black; text-align: right;">
                                                                    <textarea onchange="update_data_ajax('notes',{{ $key->id }} , this.value)" class="form-control form-control-sm" style="width: 100%; box-sizing: border-box;" name="" id="" cols="30" rows="1">{{ $key->notes }}</textarea>
                                                                </td>
                                                                <td class="text-center" style="padding: 10px; border: 1px solid black; text-align: right;">
                                                                    <span style="cursor: pointer" class="badge badge-danger" onclick="delete_supplement_from_meal_type({{ $key->id }})">X</span>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div>
                    <table class="table table-bordered text-center">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>القيمة الغذائية</th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>السعرات الحرارية</td>
                                <td id="calories_{{ $day }}">{{ $calories }}</td>
                            </tr>
                            <tr>
                                <td>الدهون - غرام</td>
                                <td id="fats_{{ $day }}">{{ $fats }}</td>
                            </tr>
                            <tr>
                                <td>البروتينات - غرام</td>
                                <td id="carbohydrates_{{ $day }}">{{ $carbohydrates }}</td>
                            </tr>
                            <tr>
                                <td>الكيبوهيدرات - غرام</td>
                                <td id="protein_{{ $day }}">{{ $protein }}</td>
                            </tr>
                            <tr>
                                <td>الالياف - غرام</td>
                                <td id="fibers_{{ $day }}">{{ $fibers }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
    @endif
</div>