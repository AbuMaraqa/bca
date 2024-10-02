@extends('layouts.app')
@section('title')
    الرئيسية
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 btn lg-light btn-lg btn-block border border-primary">
                                <div>
                                    <h5 class=""><span class="fa fa-users"></span> العملاء</h5>
                                    <div class="row">
                                        <div class="col">
                                            <a href="{{ route('clients.add') }}"
                                                class="btn btn-primary btn-sm btn-lg w-100"><span
                                                    class="fa fa-user-plus"></span> اضافة عميل</a>
                                        </div>
                                        <div class="col">
                                            <a href="{{ route('clients.index') }}"
                                                class="btn btn-primary btn-sm btn-lg w-100"><span
                                                    class="fa fa-users"></span>
                                                عرض العملاء</a>
                                        </div>
                                        <div class="col">
                                            <a href="{{ route('program.user_program.index') }}"
                                                class="btn btn-primary btn-sm btn-lg w-100"><span class="fa fa-list"></span>
                                                برامج العملاء</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="col-md-6 btn lg-light btn-lg btn-block border border-success">
                                <h5 class=""><span class="fa fa-users"></span> العملاء</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{ route('clients.index') }}"
                                            class="btn btn-success btn-sm btn-lg w-100"><span
                                                class="fa fa-user-plus"></span> اضافة عميل</a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('clients.index') }}"
                                            class="btn btn-success btn-sm btn-lg w-100"><span class="fa fa-users"></span>
                                            عرض العملاء</a>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
