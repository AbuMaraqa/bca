@extends('layouts.app')
@section('title')
    اضافة عميل
@endsection
@section('content')
    @include('project.clients.menu')
    <div class="row mb-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        <h6 class="text-secondary"><span
                                                class="fa fa-user-circle text-secondary"></span>&nbsp;&nbsp;{{ $client->name }}
                                        </h6>
                                        <h6 class="text-secondary"><span
                                                class="fa fa-phone text-secondary"></span>&nbsp;&nbsp;{{ $client->phone }}
                                        </h6>
                                        <h6 class="text-secondary"><span
                                                class="fa fa-calendar text-secondary"></span>&nbsp;&nbsp;
                                            {{ \Carbon\Carbon::parse($client->dob)->diff(\Carbon\Carbon::now())->format('%y سنة') }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>القراءات
                        <a href="{{ route('reading_users.details', ['client_id' => $client->id]) }}"
                            class="btn btn-primary btn-sm float-start">قراءة جديدة</a>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-sm text-center table-hover">
                                <thead>
                                    <tr>
                                        <th>تاريخ الفحص</th>
                                        <th>الوزن</th>
                                        <th>الدهون</th>
                                        {{-- <th>البروتين</th> --}}
                                        <th>العضلات</th>
                                        <th></th>
                                        {{-- <th>الاملاح</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($readings->isEmpty())
                                        <tr>
                                            <td colspan="5">لا يوجد بيانات</td>
                                        </tr>
                                    @else
                                        @foreach ($readings as $key)
                                            <tr>
                                                <td>{{ $key->insert_at }}</td>
                                                <td>{{ $key->weight }}</td>
                                                <td>{{ $key->fats }}</td>
                                                {{-- <td>{{ $key->liquids }}</td> --}}
                                                <td>{{ $key->muscles }}</td>
                                                {{-- <td>{{ $key->salts }}</td> --}}
                                                <td>
                                                    <a href="{{ route('reading_users.delete', ['id' => $key->id]) }}"
                                                        class="btn btn-sm btn-danger"><span class="fa fa-trash"></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>
                        آخر برامج
                        <a href="{{ route('program.user_program.add', ['client_id' => $client->id]) }}"
                            class="btn btn-primary btn-sm float-start">برنامج جديد</a>

                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-sm text-center table-hover">
                                <tbody>
                                    @if ($programs->isEmpty())
                                        <tr>
                                            <td colspan="2" class="text-center">لا يوجد برامج</td>
                                        </tr>
                                    @else
                                        @foreach ($programs as $key)
                                            <tr>
                                                <td><a
                                                        href="{{ route('program.user_program.details', ['program_id' => $key->id]) }}">{{ $key->program_name }}</a>
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($key->created_at)->toDateString() }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div>
                                <p class="text-center">
                                    <a
                                        href="{{ route('program.user_program.user_program_list', ['client_id' => $client->id]) }}">ـــ
                                        كل البرامج ـــ</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
