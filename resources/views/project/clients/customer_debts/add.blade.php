@extends('layouts.app')
@section('title')
    اضافة دين
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('customers_debt.create') }}" method="post">
                        @csrf
                        <input type="hidden" name="client_id" value="{{ $client->id }}">
                        <div class="row">
                            <div class="col-md-12">
                                <h5>اضافة دفعة الى العميل <span class="badge bg-gradient-primary">محمد مرقة</span></h5>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">قيمة الدفعة</label>
                                        <input required name="value" type="number" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group input-group-outline my-3">
                                        <select name="type" required class="form-control" id="exampleFormControlSelect1">
                                            <option value="">اختر نوع الدين</option>
                                            <option value="creditor">عليه</option>
                                            <option value="debtor">له</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group input-group-dynamic">
                                        <textarea name="notes" class="form-control" rows="2" placeholder="ادخل ملاحظات عن الدفعة" spellcheck="false"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <button type="submit" class="btn btn-success">اضافة</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
