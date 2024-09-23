@extends('layouts.app')
@section('title')
    انوع الوجبات للبرنامج
@endsection
@section('style')
    <style>
        td.long-text {
    max-width: 300px; /* تحديد الحد الأقصى للعرض */
    white-space: normal; /* السماح للنص بالانتقال إلى سطر جديد */
    word-wrap: break-word; /* كسر الكلمات الطويلة إذا لزم الأمر */
    overflow-wrap: break-word; /* متوافق مع بعض المتصفحات */
}
    </style>
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
                    program_id : {{ $data->id }}
                },
                success: function(data) {
                    if (data.success === true){
                        $('#meal_type_list').html(data.view);
                        program_meal_list();
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
                        meal_type_list();
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
            console.log(data);
            
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
                    day: data.day ,
                    meal_type_id: data.meal_type_id
                },
                success: function(data) {
                    if (data.success === true){
                        $('#list_suplement_for_meal_type').html(data.view);
                    }
                }
            });
        }

        function delete_supplement_from_meal_type(program_meal_type_id) {   
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('program.program_meal.delete_supplement_from_meal_type') }}",
                type: 'POST',
                dataType: "json",
                data: {
                    program_meal_type_id : program_meal_type_id,
                },
                success: function(data) {
                    if (data.success === true){
                        $('#meal_program_meal_supplement_row_' + program_meal_type_id).remove();
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
                        program_meal_suplement(data.program_meal);
                        $('#supplement_for_meal_type_row_' + data.program_meal.id).append(
        `<tr id=meal_program_meal_supplement_row_${data.data.id}>
            <td class="font-weight-bold text-dark long-text" style="padding: 10px; border: 1px solid black; text-align: right; color: black;">
                ${data.supplement.product}
            </td>
            <td style="padding: 10px; border: 1px solid black; text-align: right;">
                <textarea class="form-control form-control-sm" style="width: 100%; box-sizing: border-box;" name="" id="" cols="30" rows="1">${!data.supplement.notes ? '' : data.supplement.notes}</textarea>
            </td>
            <td class="text-center" style="padding: 10px; border: 1px solid black; text-align: right;">
                <span style="cursor: pointer" class="badge badge-danger" onclick="delete_supplement_from_meal_type((${data.data.id}))">X</span>
            </td>
        </tr>
        `
    );
                    }
                }
            });
        }
    </script>
@endsection
{{-- program.program_meal.add_meal_type_for_program --}}