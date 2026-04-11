<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>برنامج التغذية</title>
    <style>
        /* التنسيقات العامة */
        body {
            font-family: 'tajawal', sans-serif;
            font-weight: normal;
            direction: rtl;
            text-align: right;
            color: #333; /* لون رمادي داكن مريح للقراءة بدلاً من الأسود القاتم */
            line-height: 1.6;
        }

        @page {
            header: page-header;
            footer: page-footer;
        }

        h1, h2, h3, h4, h5 {
            font-family: 'tajawal', sans-serif;
            font-weight: bold;
            color: #2c3e50; /* كحلي/رمادي أنيق للعناوين */
        }

        .container {
            max-width: 900px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
        }

        /* تنسيق بطاقة معلومات المشترك */
        .client-info-card {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 40px;
        }

        .client-info-card table {
            margin-bottom: 0;
            border: none;
        }

        .client-info-card td {
            border: none;
            text-align: right;
            padding: 10px;
        }

        h3 {
            text-align: center;
            font-size: 22px;
            margin-bottom: 20px;
            color: #2a9d8f; /* لون أخضر صحي مميز لأسماء الأيام */
        }

        /* الجداول العامة */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
            font-size: 13px;
        }

        th, td {
            border: 1px solid #e9ecef; /* حدود ناعمة جداً */
            padding: 10px 8px;
        }

        th {
            background-color: #f8f9fa;
            color: #2c3e50;
            font-size: 14px;
            text-align: center;
        }

        thead th {
            border-bottom: 2px solid #2a9d8f; /* خط سفلي مميز لترويسة الجدول */
        }

        td {
            text-align: center;
        }

        /* تنسيق نوع الوجبة (بدلاً من شكل الزر) */
        .meal-label {
            display: inline-block;
            background-color: #e8f5e9; /* خلفية خضراء فاتحة */
            color: #2e7d32; /* نص أخضر داكن */
            padding: 6px 15px;
            font-size: 13px;
            font-weight: bold;
            border-radius: 20px; /* أطراف دائرية */
            border: 1px solid #c8e6c9;
            text-align: center;
        }

        /* تنسيق جدول الأصناف الداخلي */
        .meal-supplements table {
            margin-bottom: 0;
            border: none;
        }

        .meal-supplements th {
            background-color: transparent;
            border: none;
            border-bottom: 1px solid #dee2e6;
            color: #6c757d;
            font-size: 12px;
            padding: 6px;
            text-align: right;
        }

        .meal-supplements th:first-child { text-align: center; } /* توسيط الكمية */

        .meal-supplements td {
            border: none;
            border-bottom: 1px dashed #e9ecef; /* خط متقطع خفيف بين الأصناف */
            padding: 8px 6px;
            text-align: right;
        }

        .meal-supplements td:first-child { text-align: center; font-weight: bold; } /* توسيط الكمية */

        .meal-supplements tr:last-child td {
            border-bottom: none;
        }

        .day-section {
            margin-bottom: 40px;
        }

        /* تنسيقات الفوتر */
        .footer-text {
            color: #6c757d;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <htmlpagefooter name="page-footer">
        <table style="border: none; width: 100%; border-top: 1px solid #e9ecef; padding-top: 10px;" class="footer-text">
            <tr style="border: none">
                <td colspan="3" style="border: none; text-align: center; padding-bottom: 10px;">بيت لحم - مقابل مستوصف الاحسان - عمارة السنة - الطابق الأول</td>
            </tr>
            <tr style="border: none">
                <td style="border: none; text-align: center;">
                    <span>سوبر هيلث - super health</span>
                    <img style="width: 13px;height: 13px; margin-right: 5px; vertical-align: middle;" src="{{ asset('img/icons/facebook.png') }}" alt="">
                </td>
                <td style="border: none; text-align: center;">
                    <span>dietitian fida shakhtour</span>
                    <img style="width: 13px;height: 13px; margin-right: 5px; vertical-align: middle;" src="{{ asset('img/icons/instgram.png') }}" alt="">
                </td>
                <td style="border: none; text-align: center;">
                    <span dir="ltr">0594830078</span>
                    <img style="width: 13px;height: 13px; margin-right: 5px; vertical-align: middle;" src="{{ asset('img/icons/whatsapp.png') }}" alt="">
                </td>
            </tr>
        </table>
    </htmlpagefooter>

    <div class="container">
        <div style="width: 100%; text-align: center; margin-bottom: 20px;">
            <img style="width: 250px; height: auto;" src="{{ asset('img/logo-fidaa.png') }}" alt="">
        </div>

        <div style="margin-bottom: 30px;">
            <h2 style="text-align: center; color: #2a9d8f;">معاً ... لصحة أفضل</h2>
        </div>

        <div class="client-info-card">
            <table>
                <tr>
                    <td colspan="2">
                        <h5 style="font-size:18px; margin: 0;">رقم المشترك : <span style="font-weight: normal;">{{ $client->id }}</span></h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5 style="font-size:15px; margin: 0;">الاسم : <span style="font-weight: normal;">{{ $client->name }}</span></h5>
                    </td>
                    <td>
                        <h5 style="font-size:15px; margin: 0;">رقم الهاتف : <span style="font-weight: normal;">{{ $client->phone }}</span></h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5 style="font-size:15px; margin: 0;">تاريخ الميلاد : <span style="font-weight: normal;">{{ $client->dob }}</span></h5>
                    </td>
                    <td>
                        <h5 style="font-size:15px; margin: 0;">المدينة : <span style="font-weight: normal;">{{ $client->city }}</span></h5>
                    </td>
                </tr>
            </table>
        </div>

        <table>
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
                    <td style="font-weight: bold; background-color: #fdfdfd;">الوزن</td>
                    <td>{{ $currentVisit && $currentVisit->weight ? number_format($currentVisit->weight, 2) : 'N/A' }}</td>
                    <td>{{ $previousVisit && $previousVisit->weight ? number_format($previousVisit->weight, 2) : 'N/A' }}</td>
                    <td>{{ $firstVisit && $firstVisit->weight ? number_format($firstVisit->weight, 2) : 'N/A' }}</td>
                    <td dir="ltr">{{ $currentVisit && $previousVisit ? number_format($currentVisit->weight - $previousVisit->weight, 2) : 'N/A' }}</td>
                    <td dir="ltr">{{ $currentVisit && $firstVisit ? number_format($currentVisit->weight - $firstVisit->weight, 2) : 'N/A' }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold; background-color: #fdfdfd;">الدهون</td>
                    <td>{{ $currentVisit && $currentVisit->fats ? number_format($currentVisit->fats, 2) : 'N/A' }}</td>
                    <td>{{ $previousVisit && $previousVisit->fats ? number_format($previousVisit->fats, 2) : 'N/A' }}</td>
                    <td>{{ $firstVisit && $firstVisit->fats ? number_format($firstVisit->fats, 2) : 'N/A' }}</td>
                    <td dir="ltr">{{ $currentVisit && $previousVisit ? number_format($currentVisit->fats - $previousVisit->fats, 2) : 'N/A' }}</td>
                    <td dir="ltr">{{ $currentVisit && $firstVisit ? number_format($currentVisit->fats - $firstVisit->fats, 2) : 'N/A' }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold; background-color: #fdfdfd;">البروتين</td>
                    <td>{{ $currentVisit && $currentVisit->muscles ? number_format($currentVisit->muscles, 2) : 'N/A' }}</td>
                    <td>{{ $previousVisit && $previousVisit->muscles ? number_format($previousVisit->muscles, 2) : 'N/A' }}</td>
                    <td>{{ $firstVisit && $firstVisit->muscles ? number_format($firstVisit->muscles, 2) : 'N/A' }}</td>
                    <td dir="ltr">{{ $currentVisit && $previousVisit ? number_format($currentVisit->muscles - $previousVisit->muscles, 2) : 'N/A' }}</td>
                    <td dir="ltr">{{ $currentVisit && $firstVisit ? number_format($currentVisit->muscles - $firstVisit->muscles, 2) : 'N/A' }}</td>
                </tr>
            </tbody>
        </table>
        <pagebreak />

        <div style="width:100%; margin-top: 15px; margin-bottom: 15px;">
            <h4 style="text-align: center; border-bottom: 2px solid #2a9d8f; display: inline-block; padding-bottom: 5px; margin: 0;">التعليمات العامة</h4>
        </div>
        <div style="font-size: 12.5px; line-height: 1.5; background-color: #f8f9fa; padding: 10px 15px; border-radius: 6px; border: 1px solid #e9ecef; margin-bottom: 30px;">
            {!! $user_program->instructions ?? 'لا توجد تعليمات مسجلة.' !!}
        </div>
        <pagebreak />

        @foreach ($data as $day => $meals)
            @php
                $calories = 0; $carbohydrates = 0; $fats = 0; $protein = 0; $fibers = 0;
            @endphp
            <div class="day-section">
                <h3>اليوم {{ $day }}</h3>
                <table>
                    <thead>
                        <tr>
                            <th style="width: 150px;">نوع الوجبة</th>
                            <th>الأصناف المقترحة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($meals as $meal)
                            <tr>
                                <td style="vertical-align: middle;">
                                    <span class="meal-label" onclick="open_add_supplement_for_meal_type_modal({{ $meal }})">
                                        {{ $meal->meal_type->meal_name ?? '' }}
                                    </span>
                                </td>
                                <td style="padding: 0;">
                                    <div class="meal-supplements">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th style="width: 50px; text-align: center;">الكمية</th>
                                                    <th style="width: 250px; text-align: right;">الصنف</th>
                                                    <th style="text-align: right;">ملاحظات</th>
                                                </tr>
                                            </thead>
                                            <tbody id="supplement_for_meal_type_row_{{ $meal->id }}">
                                                @if ($meal->program_meal_supplement->isEmpty())
                                                    <tr>
                                                        <td colspan="3" style="text-align: center; color: #999;">لا يوجد أصناف لنوع الوجبة هذه</td>
                                                    </tr>
                                                @else
                                                    @foreach ($meal->program_meal_supplement as $key)
                                                        @php
                                                            $calories += $key->supplement->calories * ($key->qty ?? 1);
                                                            $carbohydrates += $key->supplement->carbohydrates * ($key->qty ?? 1);
                                                            $fats += $key->supplement->fats * ($key->qty ?? 1);
                                                            $protein += $key->supplement->protein * ($key->qty ?? 1);
                                                            $fibers += $key->supplement->fibers * ($key->qty ?? 1);
                                                        @endphp
                                                        <tr>
                                                            <td style="text-align: center;">{{ $key->qty ?? 1 }}</td>
                                                            <td style="text-align: right;">{{ $key->supplement->product ?? '' }}</td>
                                                            <td style="text-align: right; color: #555;">{{ $key->notes ?? '-' }}</td>
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
            @if (!$loop->last)
                <pagebreak />
            @endif
        @endforeach
    </div>
</body>

</html>
