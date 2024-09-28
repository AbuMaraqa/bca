@extends('layouts.app')
@section('title')
    اضافة برنامج للعميل
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-static mb-4">
                                <label for="exampleFormControlSelect1" class="ms-0">اسم العميل</label>
                                <select required class="form-control" id="user_id">
                                    @foreach ($clients as $key)
                                        <option value="{{ $key->id }}">{{ $key->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-static mb-4">
                                <label for="exampleFormControlSelect1" class="ms-0">البرامج</label>
                                <select required class="form-control" name="program_category_id" id="select_program_id">
                                    <option value="">اختر برنامج ...</option>
                                    @foreach ($programs as $key)
                                        <option value="{{ $key->id }}">{{ $key->program_name }}</option>
                                    @endforeach
                                </select>
                            </div>
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
@endsection

@section('script')
    <script>
        $('#select_program_id').on('change',function(){
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
                    user_id: $('#user_id').val(),
                },
                success: function(data) {                    
                    if (data.success === true){
                        $('#list_programs').html(data.view);
                    }
                }
            });
        })

        function add_program_for_user(program_id){
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
                    
                    if (data.success === true){
                        alert('success');
                    }
                }
            });
        }
    </script>
@endsection

