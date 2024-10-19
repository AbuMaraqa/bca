@extends('layouts.app')
@section('title')
    اضافة برنامج للعميل
@endsection
@section('content')
    <input type="hidden" id="program_meal_id">
    <input type="hidden" name="program_id" id="program_id">
    @include('project.clients.menu')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="text-center">البرنامج الخاص بالمستخدم <span class="">{{ $client->name }}</span>
                                بتاريخ :
                                <span>{{ $user_program->created_at }}</span>
                            </h4>
                        </div>
                        <div class="col-md-12 text-center">
                            <h5>اسم البرنامج : <span>{{ $user_program->program_name }}</span></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#add_program_meal_modal">اضافة نوع وجبة</button>
                            <a href="{{ route('program.user_program.print_pdf', ['program_id' => $user_program->id]) }}"
                                class="btn btn-warning"><i class="fas fa-print"></i></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="list_programs">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('project.user_program.modals.add_program_meal_modal')
    @include('project.user_program.modals.add_supplement_for_meal_type')
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            list_program();
            meal_type_list();
        });

        function list_program() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#list_programs').html(`<div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
                </div>`);
            $.ajax({
                // url: "{{ route('program.user_program.program_meal_list') }}",
                url: "{{ route('program.user_program.program_meal_list') }}",
                type: 'POST',
                dataType: "json",
                data: {
                    // name : $('#name').val(),
                    // phone : $('#phone').val(),
                    program_id: {{ $user_program->id }},
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
                url: "{{ route('program.user_program.meal_type_list') }}",
                type: 'POST',
                dataType: "json",
                data: {
                    name: $('#name').val(),
                    // phone : $('#phone').val(),
                    program_id: {{ $user_program->id }}
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
                url: "{{ route('program.user_program.add_meal_type_for_program') }}",
                type: 'POST',
                dataType: "json",
                data: {
                    program_id: {{ $user_program->id }},
                    meal_type_id: data.id,
                    user_id: {{ $user_program->client_id }}
                },
                success: function(data) {
                    if (data.success === true) {
                        meal_type_list();
                        list_program();
                        $('#meal_type_list').html(data.view);
                    }
                }
            });
        }

        function add_program_for_user(program_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('program.user_program.add_program_for_user') }}",
                type: 'POST',
                dataType: "json",
                data: {
                    program_id: {{ $user_program->id }},
                    user_id: {{ $user_program->client_id }}
                },
                success: function(data) {
                    console.log(data);

                    if (data.success === true) {
                        alert('success');
                    }
                }
            });
        }


        function open_add_supplement_for_meal_type_modal(data) {
            $('#add_supplement_for_meal_type').modal('show');
            $('#program_meal_id').val(data.id)
        }

        $('#product_name').keyup(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('program.user_program.program_meal_suplement') }}", // Add page parameter
                type: 'POST',
                dataType: "json",
                data: {
                    product_name: $(this).val(),
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
        })

        function add_supplement_for_meal_type(supplement_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#spinner_' + supplement_id).css('display', 'inline-block');
            $.ajax({
                url: "{{ route('program.user_program.add_supplement_for_meal_type') }}",
                type: 'POST',
                dataType: "json",
                data: {
                    program_id: {{ $user_program->id }},
                    supplement_id: supplement_id,
                    program_meal_id: $('#program_meal_id').val(),
                    user_id: {{ $user_program->client_id }},
                },
                success: function(data) {
                    if (data.success === true) {
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
                        <span style="cursor: pointer" class="badge badge-danger" onclick="delete_supplement_from_meal_type(${data.data.id})">X</span>
                    </td>
                        </tr>
                        `
                        );
                        $('#calories_' + data.program_meal.day).html(data.calories)
                        $('#carbohydrates_' + data.program_meal.day).html(data.carbohydrates)
                        $('#fats_' + data.program_meal.day).html(data.fats)
                        $('#protein_' + data.program_meal.day).html(data.protein)
                        $('#fibers_' + data.program_meal.day).html(data.fibers)

                        $('#spinner_' + supplement_id).css('display', 'none');
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
                url: "{{ route('program.user_program.delete_supplement_from_meal_type') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    program_meal_type_id: program_meal_type_id,
                },
                success: function(data) {
                    if (data.success === true) {
                        // Remove the row for the deleted supplement
                        $('#meal_program_meal_supplement_row_' + program_meal_type_id).remove();

                        // Update the nutrition data
                        $('#calories_' + data.program_meal.day).html(data.calories);
                        $('#carbohydrates_' + data.program_meal.day).html(data.carbohydrates);
                        $('#fats_' + data.program_meal.day).html(data.fats);
                        $('#protein_' + data.program_meal.day).html(data.protein);
                        $('#fibers_' + data.program_meal.day).html(data.fibers);
                    } else {
                        alert('Failed to delete supplement: ' + data.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred. Please try again.');
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
                url: "{{ route('program.user_program.update_data_ajax') }}",
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
    </script>
@endsection
