@extends('layouts.app')

@section('title')
    الرئيسية
@endsection

@section('style')
    <style>
        .home-shell {
            --brand-primary: #A9BB47;
            --brand-primary-dark: #879638;
            --brand-dark: #344767;
            --brand-black: #191919;
            --brand-muted: #7b809a;
            --brand-border: #e5e9ef;
            --brand-panel: #fff;
            --brand-page: #f0f2f5;
            max-width: 1320px;
            margin: 10px auto 0;
        }

        .quick-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 18px;
            padding: 14px 18px;
            border: 1px solid var(--brand-border);
            border-radius: 8px;
            background: var(--brand-panel);
            box-shadow: 0 3px 12px rgba(52, 71, 103, 0.05);
        }

        .quick-header h4 {
            margin: 0;
            color: var(--brand-dark);
            font-weight: 800;
        }

        .quick-header .home-date {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 10px;
            border-radius: 8px;
            background: rgba(169, 187, 71, 0.11);
            color: var(--brand-dark);
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .quick-header .home-date i {
            color: var(--brand-primary);
        }

        .primary-actions {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 22px;
        }

        .primary-action {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 112px;
            padding: 22px;
            overflow: hidden;
            border: 0;
            border-radius: 8px;
            color: #fff;
            box-shadow: 0 12px 26px rgba(25, 25, 25, 0.12);
            transition: transform 0.16s ease, box-shadow 0.16s ease;
        }

        .primary-action:before {
            content: "";
            position: absolute;
            inset: 0 0 auto auto;
            width: 7px;
            height: 100%;
            background: rgba(255, 255, 255, 0.36);
        }

        .primary-action:hover {
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 16px 30px rgba(25, 25, 25, 0.16);
        }

        .primary-action strong,
        .quick-action strong {
            display: block;
            margin-bottom: 5px;
            font-size: 16px;
            font-weight: 800;
            letter-spacing: 0;
        }

        .primary-action span,
        .quick-action span {
            display: block;
            font-size: 12px;
            line-height: 1.7;
            opacity: 0.88;
        }

        .primary-action .action-icon {
            position: relative;
            z-index: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 46px;
            height: 46px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.18);
            color: #fff;
            flex: 0 0 auto;
        }

        .primary-action .action-icon i {
            font-size: 18px;
        }

        .primary-action>div {
            position: relative;
            z-index: 1;
        }

        .primary-client {
            background: linear-gradient(195deg, var(--brand-primary), var(--brand-primary-dark));
        }

        .primary-reception {
            background: linear-gradient(195deg, #42424a, var(--brand-black));
        }

        .quick-section {
            margin-bottom: 22px;
        }

        .quick-section-title {
            display: flex;
            align-items: center;
            gap: 9px;
            margin: 0 0 12px;
            color: var(--brand-dark);
            font-size: 15px;
            font-weight: 800;
        }

        .quick-section-title:before {
            content: "";
            width: 6px;
            height: 22px;
            border-radius: 8px;
            background: var(--brand-primary);
        }

        .quick-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 13px;
        }

        .quick-action {
            position: relative;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            min-height: 106px;
            padding: 17px 16px;
            border: 1px solid var(--brand-border);
            border-right: 4px solid var(--accent);
            border-radius: 8px;
            background: var(--brand-panel);
            color: var(--brand-dark);
            box-shadow: 0 4px 14px rgba(52, 71, 103, 0.05);
            transition: transform 0.16s ease, border-color 0.16s ease, box-shadow 0.16s ease;
        }

        .quick-action:hover {
            color: var(--brand-dark);
            border-color: var(--brand-border);
            border-right-color: var(--accent);
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(52, 71, 103, 0.10);
        }

        .quick-action .quick-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: var(--soft);
            color: var(--accent);
            flex: 0 0 auto;
        }

        .quick-action .quick-icon i {
            font-size: 15px;
        }

        .quick-action small {
            display: inline-flex;
            align-items: center;
            margin-top: 7px;
            color: var(--accent);
            font-size: 11px;
            font-weight: 800;
        }

        .quick-arrow {
            position: absolute;
            bottom: 16px;
            left: 16px;
            color: #c4cad6;
            font-size: 12px;
            transition: color 0.16s ease, transform 0.16s ease;
        }

        .quick-action:hover .quick-arrow {
            color: var(--accent);
            transform: translateX(-3px);
        }

        @media (max-width: 1199.98px) {
            .quick-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (max-width: 991.98px) {
            .primary-actions,
            .quick-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 575.98px) {
            .quick-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .primary-actions,
            .quick-grid {
                grid-template-columns: 1fr;
            }

            .primary-action,
            .quick-action {
                min-height: auto;
            }
        }
    </style>
@endsection

@section('content')
    @php
        $role = auth()->user()->user_role;
        $today = now()->locale('ar')->translatedFormat('l d F Y');

        $palette = [
            'primary' => [
                'accent' => '#A9BB47',
                'soft' => 'rgba(169, 187, 71, 0.14)',
            ],
            'dark' => [
                'accent' => '#344767',
                'soft' => 'rgba(52, 71, 103, 0.12)',
            ],
            'black' => [
                'accent' => '#191919',
                'soft' => 'rgba(25, 25, 25, 0.10)',
            ],
            'muted' => [
                'accent' => '#7b809a',
                'soft' => 'rgba(123, 128, 154, 0.13)',
            ],
            'rose' => [
                'accent' => '#D81B60',
                'soft' => 'rgba(216, 27, 96, 0.10)',
            ],
        ];

        $clientActions = [
            [
                'title' => 'عرض العملاء',
                'text' => 'قائمة العملاء والاشتراكات والحسابات',
                'route' => route('clients.index'),
                'icon' => 'fa-users',
                'color' => 'primary',
                'tag' => 'عملاء',
            ],
            [
                'title' => 'برامج العملاء',
                'text' => 'استعراض البرامج المطبوعة والمحفوظة',
                'route' => route('program.user_program.index'),
                'icon' => 'fa-list',
                'color' => 'dark',
                'tag' => 'برامج',
            ],
            [
                'title' => 'قراءات العملاء',
                'text' => 'تسجيل ومتابعة قياسات الزيارات',
                'route' => route('reading_users.index'),
                'icon' => 'fa-chart-line',
                'color' => 'muted',
                'tag' => 'قياسات',
            ],
        ];

        $clinicActions = [
            [
                'title' => 'شاشة الاستقبال',
                'text' => 'المواعيد والغرف وحركة اليوم',
                'route' => route('reception.index'),
                'icon' => 'fa-calendar-check',
                'color' => 'black',
                'tag' => 'استقبال',
                'roles' => ['admin', 'reception'],
            ],
            [
                'title' => 'الغرف',
                'text' => 'إدارة غرف الجلسات والمواعيد',
                'route' => route('rooms.index'),
                'icon' => 'fa-door-open',
                'color' => 'primary',
                'tag' => 'غرف',
                'roles' => ['admin'],
            ],
            [
                'title' => 'الاشتراكات',
                'text' => 'الباقات والأسعار وتفاصيل الاشتراك',
                'route' => route('subscriptions.index'),
                'icon' => 'fa-credit-card',
                'color' => 'rose',
                'tag' => 'اشتراكات',
                'roles' => ['admin'],
            ],
        ];

        $systemActions = [
            [
                'title' => 'الأصناف',
                'text' => 'الأطعمة والمقادير والملاحظات',
                'route' => route('supplements.index'),
                'icon' => 'fa-utensils',
                'color' => 'primary',
                'tag' => 'تغذية',
            ],
            [
                'title' => 'نماذج البرامج',
                'text' => 'البرامج الأساسية قبل تخصيصها للعميل',
                'route' => route('program.program.index'),
                'icon' => 'fa-clipboard-list',
                'color' => 'dark',
                'tag' => 'نماذج',
            ],
            [
                'title' => 'أنواع الوجبات',
                'text' => 'الفطور والغداء والعشاء والوجبات الخفيفة',
                'route' => route('program.meal_type.index'),
                'icon' => 'fa-utensils',
                'color' => 'primary',
                'tag' => 'وجبات',
            ],
            [
                'title' => 'التعليمات',
                'text' => 'النصوص العامة المرفقة مع البرامج',
                'route' => route('program.instructions.index'),
                'icon' => 'fa-file-alt',
                'color' => 'muted',
                'tag' => 'نصوص',
            ],
        ];

        $visibleClinicActions = collect($clinicActions)->filter(function ($action) use ($role) {
            return in_array($role, $action['roles']);
        });
    @endphp

    <div class="home-shell">
        <div class="quick-header">
            <div>
                <h4>الوصول السريع</h4>
            </div>
            <div class="home-date">
                <i class="fa fa-calendar-alt"></i>
                <span>{{ $today }}</span>
            </div>
        </div>

        <div class="primary-actions">
            <a href="{{ route('clients.add') }}" class="primary-action primary-client">
                <div>
                    <strong>إضافة عميل جديد</strong>
                    <span>فتح ملف عميل وتجهيز بياناته الأساسية</span>
                </div>
                <span class="action-icon"><i class="fa fa-user-plus"></i></span>
            </a>

            @if (in_array($role, ['admin', 'reception']))
                <a href="{{ route('reception.index') }}" class="primary-action primary-reception">
                    <div>
                        <strong>شاشة الاستقبال</strong>
                        <span>متابعة المواعيد والغرف مباشرة</span>
                    </div>
                    <span class="action-icon"><i class="fa fa-calendar-check"></i></span>
                </a>
            @else
                <a href="{{ route('program.user_program.index') }}" class="primary-action primary-reception">
                    <div>
                        <strong>برامج العملاء</strong>
                        <span>فتح البرامج الجاهزة للطباعة والمتابعة</span>
                    </div>
                    <span class="action-icon"><i class="fa fa-list"></i></span>
                </a>
            @endif
        </div>

        <div class="quick-section">
            <h5 class="quick-section-title">العملاء والمتابعة</h5>
            <div class="quick-grid">
                @foreach ($clientActions as $action)
                    @php($color = $palette[$action['color']])
                    <a href="{{ $action['route'] }}" class="quick-action"
                        style="--accent: {{ $color['accent'] }}; --soft: {{ $color['soft'] }};">
                        <span class="quick-icon"><i class="fa {{ $action['icon'] }}"></i></span>
                        <span>
                            <strong>{{ $action['title'] }}</strong>
                            <span>{{ $action['text'] }}</span>
                            <small>{{ $action['tag'] }}</small>
                        </span>
                        <i class="fa fa-arrow-left quick-arrow"></i>
                    </a>
                @endforeach
            </div>
        </div>

        @if ($visibleClinicActions->isNotEmpty())
            <div class="quick-section">
                <h5 class="quick-section-title">تشغيل العيادة</h5>
                <div class="quick-grid">
                    @foreach ($visibleClinicActions as $action)
                        @php($color = $palette[$action['color']])
                        <a href="{{ $action['route'] }}" class="quick-action"
                            style="--accent: {{ $color['accent'] }}; --soft: {{ $color['soft'] }};">
                            <span class="quick-icon"><i class="fa {{ $action['icon'] }}"></i></span>
                            <span>
                                <strong>{{ $action['title'] }}</strong>
                                <span>{{ $action['text'] }}</span>
                                <small>{{ $action['tag'] }}</small>
                            </span>
                            <i class="fa fa-arrow-left quick-arrow"></i>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        @if ($role === 'admin')
            <div class="quick-section">
                <h5 class="quick-section-title">إعدادات البرامج</h5>
                <div class="quick-grid">
                    @foreach ($systemActions as $action)
                        @php($color = $palette[$action['color']])
                        <a href="{{ $action['route'] }}" class="quick-action"
                            style="--accent: {{ $color['accent'] }}; --soft: {{ $color['soft'] }};">
                            <span class="quick-icon"><i class="fa {{ $action['icon'] }}"></i></span>
                            <span>
                                <strong>{{ $action['title'] }}</strong>
                                <span>{{ $action['text'] }}</span>
                                <small>{{ $action['tag'] }}</small>
                            </span>
                            <i class="fa fa-arrow-left quick-arrow"></i>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
