<div class="modal fade" id="add_program_name_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('program.user_program.add_new_program_with_name') }}" method="post">
                @csrf
                <input type="hidden" name="user_id" value="{{ $client->id }}">
                <input type="hidden" name="program_id" id="program_id_modal">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-normal" id="exampleModalLabel">اضافة نموذج لبرنامج</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">اسم البرنامج</label>
                            <input type="text" name="program_name" placeholder="ادخل اسم البرنامج"
                                class="form-control" id="program_name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="input-group input-group-static mb-4">
                                <label for="exampleFormControlSelect1" class="ms-0">تصنيف البرنامج</label>
                                <select class="form-control" name="program_category_id" id="user_role">
                                    @foreach ($program_category as $key)
                                        <option value="{{ $key->id }}">{{ $key->program_category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="input-group input-group-static mb-4">
                                <label for="exampleFormControlSelect1" class="ms-0">تصنيف البرنامج</label>
                                <select class="form-control" name="Instructions" id="user_role">
                                    @foreach ($instructions as $key)
                                        <option value="{{ $key->id }}">{{ $key->instructions_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn bg-gradient-success">اضافة</button>
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">اغلاق</button>
                </div>
            </form>
        </div>
    </div>
</div>
