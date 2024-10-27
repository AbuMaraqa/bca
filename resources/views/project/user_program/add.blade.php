@extends('layouts.app')
@section('title')
    اضافة برنامج للعميل
@endsection
@section('style')
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    @include('project.clients.menu')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-static mb-4">
                                <label for="exampleFormControlSelect1" class="ms-0">اسم العميل</label>
                                <input type="text" class="form-control" readonly value="{{ $client->name }}">
                                {{-- <select required class="form-control select2" id="user_id">
                                    @foreach ($clients as $key)
                                        <option value="{{ $key->id }}">{{ $key->name }}</option>
                                    @endforeach
                                </select> --}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-static mb-4">
                                <label for="exampleFormControlSelect1" class="ms-0">البرامج</label>
                                <select required class="form-control select2" name="program_category_id"
                                    id="select_program_id">
                                    <option value="">اختر برنامج ...</option>
                                    @foreach ($programs as $key)
                                        <option value="{{ $key->id }}">{{ $key->program_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <form id="button_submit_program" style="display: none"
                            action="{{ route('program.user_program.submit_program') }}" method="post">
                            @csrf
                            <input type="hidden" id="program_meal_id">
                            <input type="hidden" name="program_id" id="program_id">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success">اضافة البرنامج</button>
                            </div>
                            <div class="col-md-12">
                                <button type="button" onclick="open_add_program_name_modal()" class="btn btn-success">اضافة
                                    نموذج برنامج</button>
                            </div>
                        </form>
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
    @include('project.user_program.modals.add_program_name')
@endsection

@section('script')
    <script src="{{ asset('assets/js/choices.min.js') }}" type="text/javascript"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('#select_program_id').on('change', function() {
            alert($(this).val());
            var program_id = $(this).val();
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
                url: "{{ route('program.user_program.add_program_for_user') }}",
                type: 'POST',
                dataType: "json",
                data: {
                    // name : $('#name').val(),
                    // phone : $('#phone').val(),
                    program_id: $(this).val(),
                    user_id: {{ $client->id }},
                },
                success: function(data) {
                    if (data.success === true) {
                        $('#button_submit_program').show();
                        $('#program_id').val(data.program.id);
                        $('#program_id_modal').val(program_id);
                        $('#list_programs').html(data.view);
                    }
                }
            });
        })

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
                    program_id: program_id,
                    // user_id: $('#user_id').val()
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
                    program_id: $('#program_id').val(),
                    supplement_id: supplement_id,
                    program_meal_id: $('#program_meal_id').val(),
                    user_id: {{ $client->id }},
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
                    }

                    $('#spinner_' + supplement_id).css('display', 'none');

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

        $(document).ready(function() {
            // Initialize Select2 for the user_id select box
            $('#user_id').select2({
                placeholder: "Search for a client",
                allowClear: true
            });
            $('#select_program_id').select2({
                placeholder: "Search for a client",
                allowClear: true
            });
        });

        function open_add_program_name_modal() {
            $('#add_program_name_modal').modal('show');
        }
    </script>
@endsection
