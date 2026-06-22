<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>برنامج التغذية</title>
    <style>
        @page {
            footer: page-footer;
        }

        body {
            font-family: 'tajawal', sans-serif;
            direction: rtl;
            text-align: right;
            color: #3f4a56;
            font-size: 13px;
            line-height: 1.45;
        }

        .container {
            width: 100%;
        }

        .logo {
            width: 230px;
            height: auto;
        }

        h2,
        h3,
        h4,
        h5 {
            margin: 0;
            color: #2c3e50;
            font-weight: bold;
        }

        .center {
            text-align: center;
        }

        .brand-title {
            margin: 18px 0 26px;
            color: #229d91;
            font-size: 22px;
        }

        .client-card {
            margin-bottom: 28px;
            padding: 12px 14px;
            border: 1px solid #e6eaee;
            background-color: #fafbfc;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #e7ebef;
            padding: 8px 7px;
            vertical-align: middle;
        }

        th {
            background-color: #f7f9fa;
            color: #2f3e4d;
            font-weight: bold;
        }

        .client-card table,
        .client-card td {
            border: 0;
        }

        .client-card td {
            padding: 8px 6px;
        }

        .reading-label {
            background-color: #fdfdfd;
            font-weight: bold;
        }

        .readings-table th,
        .readings-table td {
            text-align: center;
        }

        .readings-table .reading-label {
            text-align: right;
        }

        .section-title {
            margin: 6px 0 14px;
            text-align: center;
            color: #2f3e4d;
            font-size: 17px;
        }

        .section-title span {
            display: inline-block;
            padding-bottom: 5px;
            border-bottom: 2px solid #229d91;
        }

        .instructions-box {
            padding: 12px 14px;
            border: 1px solid #e7ebef;
            background-color: #fafbfc;
            line-height: 1.65;
            font-size: 13px;
        }

        .day-title {
            margin-bottom: 14px;
            text-align: center;
            color: #229d91;
            font-size: 20px;
        }

        .program-table {
            margin-bottom: 18px;
            page-break-inside: auto;
            font-size: 13px;
        }

        .program-table th,
        .program-table td {
            border-color: #e5e9ed;
        }

        .meal-type-cell {
            width: 135px;
            color: #229d91;
            background-color: #fff;
            font-size: 13px;
            font-weight: bold;
            text-align: center;
        }

        .meal-header th {
            border-bottom: 2px solid #229d91;
            background-color: #f9fafb;
            color: #2f3e4d;
            font-size: 12.5px;
        }

        .qty-cell {
            width: 52px;
            text-align: center;
        }

        .product-cell {
            width: 245px;
            text-align: right;
        }

        .notes-cell {
            text-align: right;
            color: #59636e;
        }

        .empty-cell {
            text-align: center;
            color: #8b96a1;
        }

        .footer-table {
            width: 100%;
            border-collapse: collapse;
            border-top: 1px solid #edf0f2;
            color: #8a949e;
            font-size: 10.5px;
        }

        .footer-table td {
            border: 0;
            padding: 6px 4px;
            text-align: center;
        }

        .footer-icon {
            width: 12px;
            height: 12px;
            margin-right: 4px;
            vertical-align: middle;
        }
    </style>
</head>

<body>
    @php
        $logoPath = str_replace('\\', '/', public_path('img/logo-fidaa.png'));
        $facebookIconPath = str_replace('\\', '/', public_path('img/icons/facebook.png'));
        $instagramIconPath = str_replace('\\', '/', public_path('img/icons/instgram.png'));
        $whatsappIconPath = str_replace('\\', '/', public_path('img/icons/whatsapp.png'));
        $instructions = $user_program->instructions ?? ($user_program->Instructions ?? null);
    @endphp

    <htmlpagefooter name="page-footer">
        <table class="footer-table">
            <tr>
                <td colspan="3">بيت لحم - مقابل مستوصف الاحسان - عمارة السنة - الطابق الأول</td>
            </tr>
            <tr>
                <td>
                    <span>سوبر هيلث - super health</span>
                    <img class="footer-icon" src="{{ $facebookIconPath }}" alt="">
                </td>
                <td>
                    <span>dietitian fida shakhtour</span>
                    <img class="footer-icon" src="{{ $instagramIconPath }}" alt="">
                </td>
                <td>
                    <span dir="ltr">0594830078</span>
                    <img class="footer-icon" src="{{ $whatsappIconPath }}" alt="">
                </td>
            </tr>
        </table>
    </htmlpagefooter>

    <div class="container">
        <div class="center">
            <img class="logo" src="{{ $logoPath }}" alt="">
        </div>

        <h2 class="center brand-title">معاً ... لصحة أفضل</h2>

        <div class="client-card">
            <table>
                <tr>
                    <td colspan="2">
                        <h5>رقم المشترك : <span style="font-weight: normal;">{{ $client->id }}</span></h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5>الاسم : <span style="font-weight: normal;">{{ $client->name }}</span></h5>
                    </td>
                    <td>
                        <h5>رقم الهاتف : <span style="font-weight: normal;">{{ $client->phone }}</span></h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5>تاريخ الميلاد : <span style="font-weight: normal;">{{ $client->dob }}</span></h5>
                    </td>
                    <td>
                        <h5>المدينة : <span style="font-weight: normal;">{{ $client->city }}</span></h5>
                    </td>
                </tr>
            </table>
        </div>

        <table class="readings-table">
            <thead>
                <tr>
                    <th>الوصف</th>
                    <th>الزيارة الحالية</th>
                    <th>الزيارة السابقة</th>
                    <th>الزيارة الأولى</th>
                    <th>الفرق عن آخر زيارة</th>
                    <th>الفرق الكلي</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="reading-label">الوزن</td>
                    <td>{{ $currentVisit && $currentVisit->weight ? number_format($currentVisit->weight, 2) : 'N/A' }}</td>
                    <td>{{ $previousVisit && $previousVisit->weight ? number_format($previousVisit->weight, 2) : 'N/A' }}</td>
                    <td>{{ $firstVisit && $firstVisit->weight ? number_format($firstVisit->weight, 2) : 'N/A' }}</td>
                    <td dir="ltr">{{ $currentVisit && $previousVisit ? number_format($currentVisit->weight - $previousVisit->weight, 2) : 'N/A' }}</td>
                    <td dir="ltr">{{ $currentVisit && $firstVisit ? number_format($currentVisit->weight - $firstVisit->weight, 2) : 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="reading-label">الدهون</td>
                    <td>{{ $currentVisit && $currentVisit->fats ? number_format($currentVisit->fats, 2) : 'N/A' }}</td>
                    <td>{{ $previousVisit && $previousVisit->fats ? number_format($previousVisit->fats, 2) : 'N/A' }}</td>
                    <td>{{ $firstVisit && $firstVisit->fats ? number_format($firstVisit->fats, 2) : 'N/A' }}</td>
                    <td dir="ltr">{{ $currentVisit && $previousVisit ? number_format($currentVisit->fats - $previousVisit->fats, 2) : 'N/A' }}</td>
                    <td dir="ltr">{{ $currentVisit && $firstVisit ? number_format($currentVisit->fats - $firstVisit->fats, 2) : 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="reading-label">البروتين</td>
                    <td>{{ $currentVisit && $currentVisit->muscles ? number_format($currentVisit->muscles, 2) : 'N/A' }}</td>
                    <td>{{ $previousVisit && $previousVisit->muscles ? number_format($previousVisit->muscles, 2) : 'N/A' }}</td>
                    <td>{{ $firstVisit && $firstVisit->muscles ? number_format($firstVisit->muscles, 2) : 'N/A' }}</td>
                    <td dir="ltr">{{ $currentVisit && $previousVisit ? number_format($currentVisit->muscles - $previousVisit->muscles, 2) : 'N/A' }}</td>
                    <td dir="ltr">{{ $currentVisit && $firstVisit ? number_format($currentVisit->muscles - $firstVisit->muscles, 2) : 'N/A' }}</td>
                </tr>
            </tbody>
        </table>

        <pagebreak />
        <html-separator/>

        <h4 class="section-title"><span>التعليمات العامة</span></h4>
        <div class="instructions-box">
            @if (!empty($instructions))
                {!! $instructions !!}
            @else
                لا توجد تعليمات مسجلة.
            @endif
        </div>

        @if ($data->isNotEmpty())
            <pagebreak />
            <html-separator/>
        @endif

        @foreach ($data as $day => $meals)
            <h3 class="day-title">اليوم {{ $day }}</h3>

            <table class="program-table">
                <tbody>
                    @foreach ($meals as $meal)
                        @php
                            $supplements = $meal->program_meal_supplement ?? collect();
                            $rowspan = max($supplements->count(), 1) + 1;
                        @endphp

                        <tr class="meal-header">
                            <td class="meal-type-cell" rowspan="{{ $rowspan }}">
                                {{ $meal->meal_type->meal_name ?? '' }}
                            </td>
                            <th class="qty-cell">الكمية</th>
                            <th class="product-cell">الصنف</th>
                            <th class="notes-cell">ملاحظات</th>
                        </tr>

                        @if ($supplements->isEmpty())
                            <tr>
                                <td colspan="3" class="empty-cell">لا يوجد أصناف لنوع الوجبة هذه</td>
                            </tr>
                        @else
                            @foreach ($supplements as $key)
                                @php
                                    $qty = $key->qty ?? 1;
                                    $supplement = $key->supplement;
                                @endphp
                                <tr>
                                    <td class="qty-cell">{{ $qty }}</td>
                                    <td class="product-cell">{{ $supplement->product ?? '' }}</td>
                                    <td class="notes-cell">{{ $key->notes ?? '-' }}</td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                </tbody>
            </table>

            @if (!$loop->last)
                <pagebreak />
                <html-separator/>
            @endif
        @endforeach
    </div>
</body>

</html>
