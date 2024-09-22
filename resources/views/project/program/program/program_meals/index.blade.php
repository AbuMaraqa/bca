@extends('layouts.app')
@section('title')
    انوع الوجبات للبرنامج
@endsection
@section('content')
    <div class="row mb-3">
        <div class="col-md-12">
            @include('alert_message.success')
            @include('alert_message.fail')
        </div>
    </div>
    <input type="hidden" id="program_meal_id">
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target='#add_program_meal_modal'>اضافة نوع وجبة</button>
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
                    <div id="list_programs" class="table-responsive">

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('project.program.program.program_meals.modals.add_program_meal_modal')
    @include('project.program.program.program_meals.modals.add_supplement_for_meal_type')
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            program_meal_list();
            meal_type_list();
            $('#name').keyup(function(){
                program_meal_list();
            });
        });
        function program_meal_list() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('program.program_meal.program_meal_list') }}",
                type: 'POST',
                dataType: "json",
                data: {
                    // name : $('#name').val(),
                    // phone : $('#phone').val(),
                    program_id : {{ $data->id }}
                },
                success: function(data) {
                    if (data.success === true){
                        $('#list_programs').html(data.view);
                    }
                }
            });
        }
        function meal_type_list() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('program.program_meal.meal_type_list') }}",
                type: 'POST',
                dataType: "json",
                data: {
                    name : $('#name').val(),
                    // phone : $('#phone').val(),
                },
                success: function(data) {
                    if (data.success === true){
                        $('#meal_type_list').html(data.view);
                    }
                }
            });
        }
        function add_meal_type_for_program(data) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('program.program_meal.add_meal_type_for_program') }}",
                type: 'POST',
                dataType: "json",
                data: {
                    program_id : {{ $data->id }},
                    meal_type_id : data.id,
                },
                success: function(data) {
                    if (data.success === true){
                        $('#meal_type_list').html(data.view);
                    }
                }
            });
        }

        function open_add_supplement_for_meal_type_modal(data){
            $('#add_supplement_for_meal_type').modal('show');
            $('#program_meal_id').val(data.id)
            program_meal_suplement(data);
        }

        function program_meal_suplement(data) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('program.program_meal.program_meal_suplement') }}",
                type: 'POST',
                dataType: "json",
                data: {
                    program_id : {{ $data->id }},
                },
                success: function(data) {
                    if (data.success === true){
                        $('#list_suplement_for_meal_type').html(data.view);
                    }
                }
            });
        }

        function add_supplement_for_meal_type(supplement_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('program.program_meal.add_supplement_for_meal_type') }}",
                type: 'POST',
                dataType: "json",
                data: {
                    program_id : {{ $data->id }},
                    supplement_id : supplement_id,
                    program_meal_id : $('#program_meal_id').val()
                },
                success: function(data) {
                    if (data.success === true){
                        alert('success');
                    }
                }
            });
        }
    </script>
@endsection
{{-- program.program_meal.add_meal_type_for_program --}}