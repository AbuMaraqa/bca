@extends('layouts.app')
@section('title')
    تعديل عميل
@endsection
@section('content')
    @include('project.clients.menu')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('clients.update') }}" method="post" class="row">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $client->id }}">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">اسم الزبون</label>
                                            <input required name="name" value="{{ old('name', $client->name) }}"
                                                type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">رقم الهاتف</label>
                                            <input pattern="\d{10}" name="phone"
                                                value="{{ old('phone', $client->phone) }}" required type="number"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">المدينة</label>
                                            <input required name="city" value="{{ old('city', $client->city) }}"
                                                type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group input-group-static my-3">
                                            <label>تاريخ الميلاد</label>
                                            <input name="dob" required type="date"
                                                value="{{ old('dob', $client->dob) }}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    @foreach ($diseases as $key)
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input name="diseases[]" class="form-check-input" type="checkbox"
                                                    value="{{ $key->id }}"
                                                    @if (in_array($key->id, json_decode($client->diseases ?? '[]'))) checked @endif
                                                    id="fcustomCheck{{ $loop->index }}">
                                                <label class="custom-control-label"
                                                    for="fcustomCheck{{ $loop->index }}">{{ $key->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea name="notes" class="form-control" id="" cols="30" rows="2" placeholder="ملاحظات اخرى">{{ $client->notes }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea name="medicines" class="form-control" id="" cols="30" rows="2"
                                            placeholder="هل تاخذ ادوية معينة">{{ $client->medicines }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea name="sensitive" class="form-control" id="" cols="30" rows="2"
                                            placeholder="هل تعاني من حساسية">{{ $client->sensitive }}</textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">تعديل بيانات العميل</button>
                            </form>
                        </div>
                        {{-- <div class="col-md-6 text-center justify-content-center d-flex align-content-center">
                            <div class="row">
                                <div class="col-md-12">
                                    <p style="font-size: 20px" class="font-weight-bold">تسجيل حساب جديد</p>
                                    <span style="font-size: 150px" class="fa fa-user"></span>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
