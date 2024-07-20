@extends('layouts.app')
@section('title')
    اضافة عميل
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('clients.create') }}" method="post" class="row">
                                @csrf
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">اسم الزبون</label>
                                            <input required name="name" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">رقم الهاتف</label>
                                            <input pattern="\d{10}" name="phone" required type="number" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">المدينة</label>
                                            <input required name="city" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group input-group-static my-3">
                                            <label>تاريخ الميلاد</label>
                                            <input name="dob" required type="date" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">اضافة العميل</button>
                            </form>
                        </div>
                        <div class="col-md-6 text-center justify-content-center d-flex align-content-center">
                            <div class="row">
                                <div class="col-md-12">
                                    <p style="font-size: 20px" class="font-weight-bold">تسجيل حساب جديد</p>
                                    <span style="font-size: 150px" class="fa fa-user"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
