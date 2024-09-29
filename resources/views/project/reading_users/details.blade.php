@extends('layouts.app')
@section('title')
    تفاصيل القراءات
@endsection
@section('content')
    <div class="row mb-3">
        <div class="col-md-12">
            @include('alert_message.success')
            @include('alert_message.fail')
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                        <form class="row" action="{{ route('reading_users.create_reading_user') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $client->id }}" name="user_id">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="">الوزن</label>
                                    <input required type="text" name="weight" class="form-control" placeholder="الوزن">
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="">الدهون</label>
                                    <input required type="text" name="fats" class="form-control" placeholder="الدهون">
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="">السوائل</label>
                                    <input required type="text" name="liquids" class="form-control" placeholder="السوائل">
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="">العضلات</label>
                                    <input required type="text" name="muscles" class="form-control" placeholder="العضلات">
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="">الأملاح</label>
                                    <input required type="text" name="salts" class="form-control" placeholder="الأملاح">
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <button type="submit" class="btn btn-primary btn-sm">اضافة</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-sm text-center table-hover">
                                        <thead>
                                            <tr>
                                                <th>الوصف</th>
                                                <th>الزيارة الحالية</th>
                                                <th>الزيارة السابعة</th>
                                                <th>الزيارة الأولى</th>
                                                <th>التقدم عن آخر زيارة</th>
                                                <th>التقدم التراكمي</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>الوزن</td>
                                                <td>{{ $currentVisit->weight ?? 'N/A' }}</td>
                                                <td>{{ $previousVisit->weight ?? 'N/A' }}</td>
                                                <td>{{ $firstVisit->weight ?? 'N/A' }}</td>
                                                <td>{{ $currentVisit && $previousVisit ? $currentVisit->weight - $previousVisit->weight : 'N/A' }}</td>
                                                <td>{{ $currentVisit && $firstVisit ? $currentVisit->weight - $firstVisit->weight : 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td>الدهون</td>
                                                <td>{{ $currentVisit->fats ?? 'N/A' }}</td>
                                                <td>{{ $previousVisit->fats ?? 'N/A' }}</td>
                                                <td>{{ $firstVisit->fats ?? 'N/A' }}</td>
                                                <td>{{ $currentVisit && $previousVisit ? $currentVisit->fats - $previousVisit->fats : 'N/A' }}</td>
                                                <td>{{ $currentVisit && $firstVisit ? $currentVisit->fats - $firstVisit->fats : 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td>السوائل</td>
                                                <td>{{ $currentVisit->liquids ?? 'N/A' }}</td>
                                                <td>{{ $previousVisit->liquids ?? 'N/A' }}</td>
                                                <td>{{ $firstVisit->liquids ?? 'N/A' }}</td>
                                                <td>{{ $currentVisit && $previousVisit ? $currentVisit->liquids - $previousVisit->liquids : 'N/A' }}</td>
                                                <td>{{ $currentVisit && $firstVisit ? $currentVisit->liquids - $firstVisit->liquids : 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td>العضلات</td>
                                                <td>{{ $currentVisit->muscles ?? 'N/A' }}</td>
                                                <td>{{ $previousVisit->muscles ?? 'N/A' }}</td>
                                                <td>{{ $firstVisit->muscles ?? 'N/A' }}</td>
                                                <td>{{ $currentVisit && $previousVisit ? $currentVisit->muscles - $previousVisit->muscles : 'N/A' }}</td>
                                                <td>{{ $currentVisit && $firstVisit ? $currentVisit->muscles - $firstVisit->muscles : 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td>الأملاح</td>
                                                <td>{{ $currentVisit->salts ?? 'N/A' }}</td>
                                                <td>{{ $previousVisit->salts ?? 'N/A' }}</td>
                                                <td>{{ $firstVisit->salts ?? 'N/A' }}</td>
                                                <td>{{ $currentVisit && $previousVisit ? $currentVisit->salts - $previousVisit->salts : 'N/A' }}</td>
                                                <td>{{ $currentVisit && $firstVisit ? $currentVisit->salts - $firstVisit->salts : 'N/A' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        {{-- <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="bca_search" placeholder="بحث عن bca">
                            </div>
                        </div> --}}
                        <div class="col-md-12 table-responsive" id="list_bca">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#name').on('keyup', function() {
                list_reading_users_ajax();
            });
            list_reading_users_ajax();
            search_from_bca();
        });
        function list_reading_users_ajax() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('reading_users.list_reading_users_ajax') }}",
                type: 'POST',
                dataType: "json",
                data: {
                    name : $('#name').val(),
                },
                success: function(data) {
                    if (data.success === true){
                        $('#list_reading_users_ajax').html(data.view);
                    }
                }
            });
        }
        function search_from_bca() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('reading_users.search_from_bca') }}",
                type: 'POST',
                dataType: "json",
                data: {
                    bca: $('#bca_search').val(),
                },
                success: function(data) {
                    if (data.success === true){
                        $('#list_bca').html(data.view);
                    }
                }
            });
        }
    </script>
@endsection
