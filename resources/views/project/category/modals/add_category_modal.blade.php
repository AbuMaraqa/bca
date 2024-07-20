<div class="modal fade" id="add_category_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('category.create') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title font-weight-normal" id="exampleModalLabel">اضافة تصنيف جديد</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">اسم التصنيف</label>
                                    <input type="text" id="" name="name" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">اغلاق</button>
                    <button type="submit" class="btn bg-gradient-primary">اضافة</button>
                </div>
            </form>
        </div>
    </div>
</div>
