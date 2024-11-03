@extends('layouts.app')
@section('title')
    شاشة الاستقبال
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
                    <div class="row">
                        @foreach ($rooms as $key)
                            <div class="col-lg-3 col-md-6">
                                <a href="{{ route('reception.room', ['id' => $key->id]) }}">

                                    <div class="card bg-gradient-primary">
                                        <div class="card-header bg-transparent mx-4 p-3 text-center">
                                            <div>
                                                <span class="text-white">{{ $key->name }}</span>
                                                <span class="fa fa-bed text-white"></span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            {{-- <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{ route('reception.room', ['id' => $key->id]) }}"
                                            class="btn btn-primary btn-sm">{{ $key->name }}</a>
                                    </div>
                                </div>
                            </div> --}}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">بحث عن اسم العميل</label>
                                <input type="text" id="search_client" class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <select onchange="list_reception_ajax()" class="select-control my-3" name="search_status"
                                    id="search_status" placeholder="اختيار حالة">
                                    <option value="" selected="">جميع الحالات</option>
                                    <option value="waiting">قيد الانتظار</option>
                                    <option value="under_examination">تحت الفحص</option>
                                    <option value="done">جاهز</option>
                                    <option value="not_attend">لم يحضر</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <select onchange="list_reception_ajax()" class="select-control my-3" name="search_room"
                                    id="search_status" placeholder="اختيار غرفة">
                                    <option value="" selected="">جميع الغرف</option>
                                    @foreach ($rooms as $key)
                                        <option value="{{ $key->id }}">{{ $key->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group input-group-static my-3">
                                <input type="datetime-local" value="{{ date('Y-m-d') . 'T00:00' }}"
                                    onchange="list_reception_ajax()" id="from_date_time" class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group input-group-static my-3">
                                <input type="datetime-local" value="{{ date('Y-m-d') . 'T23:59' }}"
                                    onchange="list_reception_ajax()" id="to_date_time" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 table-responsive" id="list_receptions">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="row mt-3">
        <div class="col-md-12">
            <div class="card card-calendar">
                <div class="card-body p-3">
                    <div class="calendar" data-bs-toggle="calendar" id="calendar"></div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
@section('script')
    <script src="{{ asset('assets/js/plugins/fullcalendar.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            list_reception_ajax();

            $('#search_client').on('keyup', function() {
                list_reception_ajax();
            });
        })

        function list_reception_ajax() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('reception.list_reception_ajax') }}",
                type: 'POST',
                dataType: "json",
                data: {
                    // program_id: program_id,
                    // user_id: $('#user_id').val()
                    search_client: $('#search_client').val(),
                    search_status: $('#search_status').val(),
                    search_room: $('#search_room').val(),
                    from_date_time: $('#from_date_time').val(),
                    to_date_time: $('#to_date_time').val(),
                },
                success: function(data) {
                    if (data.success === true) {
                        $('#list_receptions').html(data.view);
                    }
                }
            });
        }

        function update_status(id, status) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('supplements.update_status') }}",
                type: 'POST',
                dataType: "json",
                data: {
                    id: id,
                    status: status,
                    // phone : $('#phone').val(),
                },
                success: function(data) {
                    if (data.success == true) {
                        window.location.reload();
                    }
                }
            });
        }
    </script>
    <script>
        var calendar = new FullCalendar.Calendar(document.getElementById("calendar"), {
            initialView: "dayGridMonth",
            headerToolbar: {
                start: 'title', // will normally be on the left. if RTL, will be on the right
                center: '',
                end: 'today prev,next' // will normally be on the right. if RTL, will be on the left
            },
            selectable: true,
            editable: true,
            initialDate: '2020-12-01',
            events: [{
                    title: 'Call with Dave',
                    start: '2020-11-18',
                    end: '2020-11-18',
                    className: 'bg-gradient-danger'
                },

                {
                    title: 'Lunch meeting',
                    start: '2020-11-21',
                    end: '2020-11-22',
                    className: 'bg-gradient-warning'
                },

                {
                    title: 'All day conference',
                    start: '2020-11-29',
                    end: '2020-11-29',
                    className: 'bg-gradient-success'
                },

                {
                    title: 'Meeting with Mary',
                    start: '2020-12-01',
                    end: '2020-12-01',
                    className: 'bg-gradient-info'
                },

                {
                    title: 'Winter Hackaton',
                    start: '2020-12-03',
                    end: '2020-12-03',
                    className: 'bg-gradient-danger'
                },

                {
                    title: 'Digital event',
                    start: '2020-12-07',
                    end: '2020-12-09',
                    className: 'bg-gradient-warning'
                },

                {
                    title: 'Marketing event',
                    start: '2020-12-10',
                    end: '2020-12-10',
                    className: 'bg-gradient-primary'
                },

                {
                    title: 'Dinner with Family',
                    start: '2020-12-19',
                    end: '2020-12-19',
                    className: 'bg-gradient-danger'
                },

                {
                    title: 'Black Friday',
                    start: '2020-12-23',
                    end: '2020-12-23',
                    className: 'bg-gradient-info'
                },

                {
                    title: 'Cyber Week',
                    start: '2020-12-02',
                    end: '2020-12-02',
                    className: 'bg-gradient-warning'
                },

            ],
            views: {
                month: {
                    titleFormat: {
                        month: "long",
                        year: "numeric"
                    }
                },
                agendaWeek: {
                    titleFormat: {
                        month: "long",
                        year: "numeric",
                        day: "numeric"
                    }
                },
                agendaDay: {
                    titleFormat: {
                        month: "short",
                        year: "numeric",
                        day: "numeric"
                    }
                }
            },
        });

        calendar.render();
    </script>
@endsection
