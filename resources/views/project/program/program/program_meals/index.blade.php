@extends('layouts.app')
@section('title')
    انوع الوجبات للبرنامج
@endsection
@section('style')
    <style>
        td.long-text {
            max-width: 300px;
            /* تحديد الحد الأقصى للعرض */
            white-space: normal;
            /* السماح للنص بالانتقال إلى سطر جديد */
            word-wrap: break-word;
            /* كسر الكلمات الطويلة إذا لزم الأمر */
            overflow-wrap: break-word;
            /* متوافق مع بعض المتصفحات */
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
    <input type="hidden" id="day">
    <input type="hidden" id="program_meal_type">
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target='#add_program_meal_modal'>اضافة نوع وجبة</button>
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
        $(document).ready(function() {
            program_meal_list();
            meal_type_list();
            $('#name').keyup(function() {
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
                    program_id: {{ $data->id }}
                },
                success: function(data) {
                    if (data.success === true) {
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
                    name: $('#name').val(),
                    // phone : $('#phone').val(),
                    program_id: {{ $data->id }}
                },
                success: function(data) {
                    if (data.success === true) {
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
                    program_id: {{ $data->id }},
                    meal_type_id: data.id,
                },
                success: function(data) {
                    if (data.success === true) {
                        meal_type_list();
                        $('#meal_type_list').html(data.view);
                    }
                }
            });
        }

        function open_add_supplement_for_meal_type_modal(data) {
            $('#add_supplement_for_meal_type').modal('show');
            $('#program_meal_id').val(data.id)
            program_meal_suplement(data);
        }

        var program_meal_suplement_page = 1;

        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            program_meal_suplement_page = $(this).attr('href').split('page=')[1];
            program_meal_suplement({});
        });

        $('#product_name').keyup(function() {
            program_meal_suplement({
                meal_type_id: $('#program_meal_type').val(),
                day: $('#day').val(),
                program_id: {{ $data->id }},
                product_name: $('#product_name').val(),
            });
        });

        function program_meal_suplement(data) {
            $('#program_meal_type').val(data.meal_type_id);
            $('#day').val(data.day);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('program.program_meal.program_meal_suplement') }}", // Add page parameter
                type: 'POST',
                dataType: "json",
                data: {
                    program_id: {{ $data->id }},
                    day: data.day || null, // Ensure day is defined or pass null
                    meal_type_id: data.meal_type_id || null, // Ensure meal_type_id is defined or pass null
                    product_name: $('#product_name').val(),
                    page: program_meal_suplement_page,
                },
                success: function(response) {
                    if (response.success === true) {
                        $('#list_suplement_for_meal_type').html(response.view);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('An error occurred:', error);
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
                    program_meal_type_id: program_meal_type_id,
                },
                success: function(data) {
                    if (data.success === true) {
                        $('#meal_program_meal_supplement_row_' + program_meal_type_id).remove();
                        $('#calories_' + data.program_meal.day).html(data.calories)

                        $('#carbohydrates_' + data.program_meal.day).html(data.carbohydrates)
                        $('#fats_' + data.program_meal.day).html(data.fats)
                        $('#protein_' + data.program_meal.day).html(data.protein)
                        $('#fibers_' + data.program_meal.day).html(data.fibers)

                    }
                }
            });
        }

        function update_data_ajax(data_type, program_meal_type_id, value) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('program.program_meal.update_data_ajax') }}",
                type: 'POST',
                dataType: "json",
                data: {
                    data_type: data_type,
                    program_meal_type_id: program_meal_type_id,
                    value: value
                },
                success: function(data) {
                    if (data.success === true) {
                        $('#calories_' + data.program_meal.day).html(data.calories)
                        $('#carbohydrates_' + data.program_meal.day).html(data.carbohydrates)
                        $('#fats_' + data.program_meal.day).html(data.fats)
                        $('#protein_' + data.program_meal.day).html(data.protein)
                        $('#fibers_' + data.program_meal.day).html(data.fibers)

                    }
                }
            });
        }

        function delete_meal_type_from_program(data) {
            if (confirm('هل انت متاكد من حذف البيانات')) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('program.program_meal.delete_meal_type_from_program') }}",
                    type: 'POST',
                    dataType: "json",
                    data: {
                        program_meal_type_id: data.id,
                    },
                    success: function(data) {
                        console.log(data);

                        if (data.success === true) {
                            program_meal_list();
                        }
                    }
                });
            }
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
                    program_id: {{ $data->id }},
                    supplement_id: supplement_id,
                    program_meal_id: $('#program_meal_id').val(),
                },
                success: function(data) {

                    if (data.success === true) {
                        program_meal_suplement(data.program_meal);
                        $('#supplement_for_meal_type_row_' + data.program_meal.id).append(
                            `<tr id=meal_program_meal_supplement_row_${data.data.id}>
            <td class="font-weight-bold text-dark long-text" style="padding: 10px; border: 1px solid black; text-align: right; color: black;">
                <input type="number" value="1" onchange="update_data_ajax('qty', ${data.data.id} , this.value)" class="form-control text-center">
            </td>
            <td class="font-weight-bold text-dark long-text" style="padding: 10px; border: 1px solid black; text-align: right; color: black;">
                ${data.supplement.product}
            </td>
            <td style="padding: 10px; border: 1px solid black; text-align: right;">
                <textarea class="form-control form-control-sm" style="width: 100%; box-sizing: border-box;" name="" id="" cols="30" rows="1">${!data.data.notes ? '' : data.data.notes}</textarea>
            </td>
            <td class="text-center" style="padding: 10px; border: 1px solid black; text-align: right;">
                <span style="cursor: pointer" class="badge badge-danger" onclick="delete_supplement_from_meal_type((${data.data.id}))">X</span>
            </td>
        </tr>
        `
                        );
                        $('#calories_' + data.program_meal.day).html(data.calories)
                        $('#carbohydrates_' + data.program_meal.day).html(data.carbohydrates)
                        $('#fats_' + data.program_meal.day).html(data.fats)
                        $('#protein_' + data.program_meal.day).html(data.protein)
                        $('#fibers_' + data.program_meal.day).html(data.fibers)
                    }
                }
            });
        }

        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
        });
    </script>
@endsection
{{-- program.program_meal.add_meal_type_for_program --}}
