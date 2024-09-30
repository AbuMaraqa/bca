<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>برنامج التغذية</title>
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            direction: rtl;
            margin: 0;
            padding: 20px;
            background-color: #f0f4f8;
            color: #333;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            overflow-x: auto;
            /* Ensures tables are scrollable on smaller screens */
        }

        h3 {
            color: #2a9d8f;
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 12px;
        }

        table,
        th,
        td {
            border: 1px solid #e0e0e0;
        }

        th {
            background-color: #2a9d8f;
            color: #fff;
            padding: 12px;
            font-size: 16px;
        }

        td {
            padding: 6px;
            /* تقليص حشوة خلايا الجدول */
            text-align: center;
            font-size: 12px;/
            /* Slight color change for better readability */
        }

        th,
        td {
            padding: 6px 8px;
            /* تقليص الحشوة (padding) */
            font-size: 12px;
            /* تقليص حجم النص في خلايا الجدول */
        }

        td input,
        td textarea {
            padding: 4px;
            /* تقليص الحشوة داخل الحقول النصية */
            font-size: 12px;
            /* تقليص حجم النص داخل الحقول */

        }

        td textarea {
            resize: none;
            height: 40px;
        }

        .btn {
            display: inline-block;
            padding: 8px 16px;
            font-size: 14px;
            margin-top: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            /* Smooth hover transition */
        }

        .btn-success {
            background-color: #2a9d8f;
            color: #fff;
            border: none;
        }

        .btn-danger {
            background-color: #e63946;
            color: #fff;
            border: none;
        }

        .btn:hover {
            opacity: 0.9;
            /* Slight hover effect for better feedback */
        }

        .nutritional-info th,
        .nutritional-info td {
            padding: 6px 8px;
            /* تقليص الحشوة داخل خلايا معلومات التغذية */
            font-size: 12px;
            /* تقليص حجم النص */
        }

        .nutritional-info {
            margin-top: 30px;
            background-color: #f7f7f7;
            padding: 20px;
            border-radius: 10px;
        }

        .nutritional-info table {
            margin: 0;
            border: none;
            text-align: left;
        }

        .nutritional-info th {
            background-color: transparent;
            color: #555;
            padding: 8px;
            border-bottom: 1px solid #e0e0e0;
        }

        .nutritional-info td {
            color: #2a9d8f;
            padding: 8px;
            font-weight: bold;
            border-bottom: 1px solid #e0e0e0;
        }

        .day-section {
            margin-bottom: 30px;
        }

        /* Add some responsiveness */
        @media (max-width: 600px) {

            th,
            td {
                font-size: 10px;
                /* حجم النص على الشاشات الصغيرة */
                padding: 4px;
                /* تقليل الحشوة على الشاشات الصغيرة */
            }

            .btn {
                padding: 4px 6px;
                font-size: 10px;
                /* تصغير الأزرار على الشاشات الصغيرة */
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div style="width: 100%;text-align: center">
            <img style="" src="{{ asset('img/logo-fidaa.png') }}" alt="">
        </div>
        <table class="table table-sm text-center table-hover">
            <thead>
                <tr>
                    <th>الوصف</th>
                    <th>الزيارة الحالية</th>
                    <th>الزيارة السابقة</th>
                    <th>الزيارة الأولى</th>
                    <th>التقدم عن آخر زيارة</th>
                    <th>التقدم التراكمي</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>الوزن</td>
                    <td>{{ $currentVisit->weight ?? 'N/A' }}</td>
                    <td>{{ $previousVisit->weight ?? 'N/A' }}</td>
                    <td>{{ $firstVisit->weight ?? 'N/A' }}</td>
                    <td>{{ $currentVisit && $previousVisit ? $currentVisit->weight - $previousVisit->weight : 'N/A' }}
                    </td>
                    <td>{{ $currentVisit && $firstVisit ? $currentVisit->weight - $firstVisit->weight : 'N/A' }}</td>
                </tr>
                <tr>
                    <td>الدهون</td>
                    <td>{{ $currentVisit->fats ?? 'N/A' }}</td>
                    <td>{{ $previousVisit->fats ?? 'N/A' }}</td>
                    <td>{{ $firstVisit->fats ?? 'N/A' }}</td>
                    <td>{{ $currentVisit && $previousVisit ? $currentVisit->fats - $previousVisit->fats : 'N/A' }}</td>
                    <td>{{ $currentVisit && $firstVisit ? $currentVisit->fats - $firstVisit->fats : 'N/A' }}</td>
                </tr>
                {{-- <tr>
                    <td>السوائل</td>
                    <td>{{ $currentVisit->liquids ?? 'N/A' }}</td>
                    <td>{{ $previousVisit->liquids ?? 'N/A' }}</td>
                    <td>{{ $firstVisit->liquids ?? 'N/A' }}</td>
                    <td>{{ $currentVisit && $previousVisit ? $currentVisit->liquids - $previousVisit->liquids : 'N/A' }}
                    </td>
                    <td>{{ $currentVisit && $firstVisit ? $currentVisit->liquids - $firstVisit->liquids : 'N/A' }}</td>
                </tr> --}}
                <tr>
                    <td>العضلات</td>
                    <td>{{ $currentVisit->muscles ?? 'N/A' }}</td>
                    <td>{{ $previousVisit->muscles ?? 'N/A' }}</td>
                    <td>{{ $firstVisit->muscles ?? 'N/A' }}</td>
                    <td>{{ $currentVisit && $previousVisit ? $currentVisit->muscles - $previousVisit->muscles : 'N/A' }}
                    </td>
                    <td>{{ $currentVisit && $firstVisit ? $currentVisit->muscles - $firstVisit->muscles : 'N/A' }}</td>
                </tr>
                {{-- <tr>
                    <td>الأملاح</td>
                    <td>{{ $currentVisit->salts ?? 'N/A' }}</td>
                    <td>{{ $previousVisit->salts ?? 'N/A' }}</td>
                    <td>{{ $firstVisit->salts ?? 'N/A' }}</td>
                    <td>{{ $currentVisit && $previousVisit ? $currentVisit->salts - $previousVisit->salts : 'N/A' }}
                    </td>
                    <td>{{ $currentVisit && $firstVisit ? $currentVisit->salts - $firstVisit->salts : 'N/A' }}</td>
                </tr> --}}
            </tbody>
        </table>
        <div style="width:100%">
            <h4 style="text-align: center">التعليمات العامة</h4>
        </div>
        <pagebreak />
        @foreach ($data as $day => $meals)
            @php
                $calories = 0;
                $carbohydrates = 0;
                $fats = 0;
                $protein = 0;
                $fibers = 0;
            @endphp
            <div class="day-section">
                <h3>اليوم {{ $day }}</h3>
                <table>
                    <thead>
                        <tr>
                            <th style="width: 100px">نوع الوجبة</th>
                            <th>الأصناف</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($meals as $meal)
                            <tr>
                                <td>
                                    <button class="btn btn-success"
                                        onclick="open_add_supplement_for_meal_type_modal({{ $meal }})">
                                        {{ $meal->meal_type->meal_name ?? '' }}
                                    </button>
                                </td>
                                <td>
                                    <div class="meal-supplements">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>الكمية</th>
                                                    <th style="width: 200px">الصنف</th>
                                                    <th>ملاحظات</th>
                                                </tr>
                                            </thead>
                                            <tbody id="supplement_for_meal_type_row_{{ $meal->id }}">
                                                @if ($meal->program_meal_supplement->isEmpty())
                                                    <tr>
                                                        <td colspan="3">لا يوجد أصناف لنوع الوجبة هذه</td>
                                                    </tr>
                                                @else
                                                    @foreach ($meal->program_meal_supplement as $key)
                                                        @php
                                                            $calories += $key->supplement->calories * ($key->qty ?? 1);
                                                            $carbohydrates +=
                                                                $key->supplement->carbohydrates * ($key->qty ?? 1);
                                                            $fats += $key->supplement->fats * ($key->qty ?? 1);
                                                            $protein += $key->supplement->protein * ($key->qty ?? 1);
                                                            $fibers += $key->supplement->fibers * ($key->qty ?? 1);
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $key->qty ?? 1 }}</td>
                                                            <td>{{ $key->supplement->product ?? '' }}</td>
                                                            <td>
                                                                {{ $key->notes ?? '' }}
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
                {{-- <div class="nutritional-info">
                    <h3>معلومات التغذية</h3>
                    <table>
                        <tr>
                            <th>السعرات الحرارية</th>
                            <td>{{ $calories }}</td>
                        </tr>
                        <tr>
                            <th>الكربوهيدرات</th>
                            <td>{{ $carbohydrates }}</td>
                        </tr>
                        <tr>
                            <th>الدهون</th>
                            <td>{{ $fats }}</td>
                        </tr>
                        <tr>
                            <th>البروتين</th>
                            <td>{{ $protein }}</td>
                        </tr>
                        <tr>
                            <th>الألياف</th>
                            <td>{{ $fibers }}</td>
                        </tr>
                    </table>
                </div> --}}
            </div>
            <pagebreak />
        @endforeach
    </div>

</body>

</html>
