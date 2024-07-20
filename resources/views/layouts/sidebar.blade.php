<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-end me-3 rotate-caret  bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute start-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard-pro/pages/dashboards/analytics.html " target="_blank">
            <img src="{{ asset('assets/img/logo-ct.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="me-1 font-weight-bold text-white">مشروع فحص الجسم</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse px-0 w-auto h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item mb-2 mt-0">
                <a href="#ProfileNav" class="nav-link text-white" aria-controls="ProfileNav" role="button" aria-expanded="false">
                    <img src="{{ asset('assets/img/team-3.jpg') }}" class="avatar">
                    <span class="nav-link-text ms-2 ps-1">محمد مرقة</span>
                </a>
{{--                <div class="collapse" id="ProfileNav" style="">--}}
{{--                    <ul class="nav ">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link text-white" href="../../pages/pages/profile/overview.html">--}}
{{--                                <span class="sidenav-mini-icon"> MP </span>--}}
{{--                                <span class="sidenav-normal  ms-3  ps-1"> My Profile </span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link text-white " href="../../pages/pages/account/settings.html">--}}
{{--                                <span class="sidenav-mini-icon"> S </span>--}}
{{--                                <span class="sidenav-normal  ms-3  ps-1"> Settings </span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link text-white " href="../../pages/authentication/signin/basic.html">--}}
{{--                                <span class="sidenav-mini-icon"> L </span>--}}
{{--                                <span class="sidenav-normal  ms-3  ps-1"> Logout </span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
            </li>
            <hr class="horizontal light mt-0">
            <li class="nav-item">
                <a href="#dashboardsExamples" class="nav-link text-white " aria-controls="dashboardsExamples" role="button" aria-expanded="false">
                    <i class="fa fa-menu"></i>
                    <span class="nav-link-text me-1">الرئيسية</span>
                </a>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#dashboardsExamples" class="nav-link text-white " aria-controls="dashboardsExamples" role="button" aria-expanded="false">
                    <i class="material-icons-round opacity-10"></i>
                    <span class="nav-link-text me-1">المستخدمين</span>
                </a>
                <div class="collapse " id="dashboardsExamples">
                    <ul class="nav  pe-0 ">
                        <li class="nav-item ">
                            <a class="nav-link text-white " href="{{ route('users.index') }}">
                                <span class="sidenav-mini-icon">  </span>
                                <span class="sidenav-normal  me-3  ps-1"> قائمة المستخدمين </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#category" class="nav-link text-white " aria-controls="category" role="button" aria-expanded="false">
                    <i class="material-icons-round opacity-10"></i>
                    <span class="nav-link-text me-1">التصنيفات</span>
                </a>
                <div class="collapse " id="category">
                    <ul class="nav  pe-0 ">
                        <li class="nav-item ">
                            <a class="nav-link text-white " href="{{ route('category.index') }}">
                                <span class="sidenav-mini-icon">  </span>
                                <span class="sidenav-normal  me-3  ps-1"> قائمة التصنيفات </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#products" class="nav-link text-white " aria-controls="category" role="button" aria-expanded="false">
                    <i class="material-icons-round opacity-10"></i>
                    <span class="nav-link-text me-1">المنتجات</span>
                </a>
                <div class="collapse " id="products">
                    <ul class="nav  pe-0 ">
                        <li class="nav-item ">
                            <a class="nav-link text-white " href="{{ route('product.index') }}">
                                <span class="sidenav-mini-icon">  </span>
                                <span class="sidenav-normal  me-3  ps-1"> قائمة المنتجات </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#subscriptions" class="nav-link text-white " aria-controls="subscriptions" role="button" aria-expanded="false">
                    <i class="material-icons-round opacity-10"></i>
                    <span class="nav-link-text me-1">الاشتراكات</span>
                </a>
                <div class="collapse " id="subscriptions">
                    <ul class="nav  pe-0 ">
                        <li class="nav-item ">
                            <a class="nav-link text-white " href="{{ route('subscriptions.index') }}">
                                <span class="sidenav-mini-icon">  </span>
                                <span class="sidenav-normal  me-3  ps-1"> قائمة الاشتراكات </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#client" class="nav-link text-white " aria-controls="dashboardsExamples" role="button" aria-expanded="false">
                    <i class="material-icons-round opacity-10"></i>
                    <span class="nav-link-text me-1">العملاء</span>
                </a>
                <div class="collapse " id="client">
                    <ul class="nav  pe-0 ">
                        <li class="nav-item ">
                            <a class="nav-link text-white " href="{{ route('clients.index') }}">
                                <span class="sidenav-mini-icon">  </span>
                                <span class="sidenav-normal  me-3  ps-1"> قائمة العملاء </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white " href="{{ route('clients.add') }}">
                                <span class="sidenav-mini-icon">  </span>
                                <span class="sidenav-normal  me-3  ps-1"> اضافة عميل </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="#dashboardsExamples" class="nav-link text-white " aria-controls="dashboardsExamples" role="button" aria-expanded="false">
                    <i class="fa fa-menu"></i>
                    <span class="nav-link-text me-1">شاشة الاستقبال</span>
                </a>
            </li>
        </ul>
    </div>
</aside>