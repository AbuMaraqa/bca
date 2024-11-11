<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>برنامج التغذية</title>
    <style>
        body {
            font-family: 'tajawal', sans-serif;
            font-weight: normal;
            /* You can change to 'bold' if needed */
            direction: rtl;
            text-align: right;
        }

        @page {
            header: page-header;
            footer: page-footer;
        }

        h1,
        h2,
        h3 {
            font-family: 'tajawal', sans-serif;
            font-weight: bold;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            overflow-x: auto;
            /* Ensures tables are scrollable on smaller screens */
        }

        h3 {
            color: #000;
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
            background-color: #f5f6f6;
            color: #000;
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
            background-color: #f5f6f6;
            color: #000;
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
    <!-- optional -->
    <htmlpagefooter name="page-footer">
        <table style="border: none">
            <tr style="border: none">
                <td colspan="3">بيت لحم - مقابل مستوصف الاحسان - عمارة السنة - الطابق الأول</td>
            </tr>
            <tr style="border: none">
                <td>
                    <div style="display: flex;align-content: center;justify-content: center">
                        <span>سوبر هيلث - super health</span>
                        <img style="width: 15px;height: 15px" src="{{ asset('img/icons/facebook.png') }}"
                            alt="">
                    </div>
                </td>
                <td>
                    <span>dietitian fida shakhtour</span>
                    <img style="width: 15px;height: 15px" src="{{ asset('img/icons/instgram.png') }}" alt="">
                </td>
                <td>
                    <span>0594830078</span>
                    <img style="width: 15px;height: 15px" src="{{ asset('img/icons/whatsapp.png') }}" alt="">
                </td>
            </tr>
        </table>
    </htmlpagefooter>
    <div class="container">
        <div style="width: 100%;text-align: center">
            <img style="width: 400px;height: 400px" src="{{ asset('img/logo-fidaa.png') }}" alt="">
        </div>
        <div style="margin-bottom: 50px">
            <h2 style="text-align: center">معاً ... لصحة أفضل</h2>
        </div>
        <div style="margin-bottom: 50px">
            <table style="width: 100%;">
                <tr>
                    <td colspan="2" style="padding:30px">
                        <h5 style="font-size:20px">رقم المشترك : {{ $client->id }}</h5>
                    </td>
                </tr>
                <tr>
                    <td style="padding:15px">
                        <h5 style="font-size:15px">
                            الاسم : {{ $client->name }}</h5>
                    </td>
                    <td style="padding:15px">
                        <h5 style="font-size:15px">رقم الهاتف : {{ $client->phone }}</h5>
                    </td>
                </tr>
                <tr>
                    <td style="padding:15px">
                        <h5 style="font-size:15px">تاريخ الميلاد : {{ $client->dob }}</h5>
                    </td>
                    <td style="padding:15px">
                        <h5 style="font-size:15px">المدينة : {{ $client->city }}</h5>
                    </td>
                </tr>
            </table>
        </div>
        <table class="table table-sm text-center table-hover">
            <thead>
                <tr>
                    <th>الوصف</th>
                    <th>الزيارة الحالية</th>
                    <th>الزيارة السابقة</th>
                    <th>الزيارة الأولى</th>
                    <th>الفرق عن اخر زيارة</th>
                    <th>الفرق الكلي</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>الوزن</td>
                    <td>{{ $currentVisit && $currentVisit->weight ? number_format($currentVisit->weight, 2) : 'N/A' }}
                    </td>
                    <td>{{ $previousVisit && $previousVisit->weight ? number_format($previousVisit->weight, 2) : 'N/A' }}
                    </td>
                    <td>{{ $firstVisit && $firstVisit->weight ? number_format($firstVisit->weight, 2) : 'N/A' }}</td>
                    <td>{{ $currentVisit && $previousVisit ? number_format($currentVisit->weight - $previousVisit->weight, 2) : 'N/A' }}
                    </td>
                    <td>{{ $currentVisit && $firstVisit ? number_format($currentVisit->weight - $firstVisit->weight, 2) : 'N/A' }}
                    </td>
                </tr>
                <tr>
                    <td>الدهون</td>
                    <td>{{ $currentVisit && $currentVisit->fats ? number_format($currentVisit->fats, 2) : 'N/A' }}</td>
                    <td>{{ $previousVisit && $previousVisit->fats ? number_format($previousVisit->fats, 2) : 'N/A' }}
                    </td>
                    <td>{{ $firstVisit && $firstVisit->fats ? number_format($firstVisit->fats, 2) : 'N/A' }}</td>
                    <td>{{ $currentVisit && $previousVisit ? number_format($currentVisit->fats - $previousVisit->fats, 2) : 'N/A' }}
                    </td>
                    <td>{{ $currentVisit && $firstVisit ? number_format($currentVisit->fats - $firstVisit->fats, 2) : 'N/A' }}
                    </td>
                </tr>
                {{-- السوائل --}}
                <tr>
                    <td>السوائل</td>
                    <td>{{ $currentVisit }}
                    </td>
                    <td>{{ $previousVisit && $previousVisit->liquids ? number_format($previousVisit->liquids, 2) : 'N/A' }}
                    </td>
                    <td>{{ $firstVisit && $firstVisit->liquids ? number_format($firstVisit->liquids, 2) : 'N/A' }}</td>
                    <td>{{ $currentVisit && $previousVisit ? number_format($currentVisit->liquids - $previousVisit->liquids, 2) : 'N/A' }}
                    </td>
                    <td>{{ $currentVisit && $firstVisit ? number_format($currentVisit->liquids - $firstVisit->liquids, 2) : 'N/A' }}
                    </td>
                </tr>
                <tr>
                    <td>العضلات</td>
                    <td>{{ $currentVisit && $currentVisit->muscles ? number_format($currentVisit->muscles, 2) : 'N/A' }}
                    </td>
                    <td>{{ $previousVisit && $previousVisit->muscles ? number_format($previousVisit->muscles, 2) : 'N/A' }}
                    </td>
                    <td>{{ $firstVisit && $firstVisit->muscles ? number_format($firstVisit->muscles, 2) : 'N/A' }}</td>
                    <td>{{ $currentVisit && $previousVisit ? number_format($currentVisit->muscles - $previousVisit->muscles, 2) : 'N/A' }}
                    </td>
                    <td>{{ $currentVisit && $firstVisit ? number_format($currentVisit->muscles - $firstVisit->muscles, 2) : 'N/A' }}
                    </td>
                </tr>
                {{-- <tr>
                    <td>الأملاح</td>
                    <td>{{ $currentVisit->salts ? number_format($currentVisit->salts, 2) : 'N/A' }}</td>
                    <td>{{ $previousVisit->salts ? number_format($previousVisit->salts, 2) : 'N/A' }}</td>
                    <td>{{ $firstVisit->salts ? number_format($firstVisit->salts, 2) : 'N/A' }}</td>
                    <td>{{ $currentVisit && $previousVisit ? number_format($currentVisit->salts - $previousVisit->salts, 2) : 'N/A' }}</td>
                    <td>{{ $currentVisit && $firstVisit ? number_format($currentVisit->salts - $firstVisit->salts, 2) : 'N/A' }}</td>
                </tr> --}}
            </tbody>
        </table>
        <pagebreak />

        <div style="width:100%">
            <h4 style="text-align: center">التعليمات العامة</h4>
        </div>
        <div style="font-size: 13px;font-weight: 10">
            {!! $user_program->instructions ?? '' !!}
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
                                                    <th style="width: 20px">الكمية</th>
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
            @if (!$loop->last)
                <pagebreak />
            @endif
        @endforeach
    </div>
</body>

</html>
