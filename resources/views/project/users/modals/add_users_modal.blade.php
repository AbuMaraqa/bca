<div class="modal fade" id="add_users_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('users.create') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title font-weight-normal" id="exampleModalLabel">اضافة مستخدم جديد</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">اسم المستخدم</label>
                                    <input type="text" id="" name="name" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">البريد الالكتروني</label>
                                    <input type="email" id="" name="email" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">كلمة المرور</label>
                                    <input type="password" id="" name="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group input-group-static mb-4">
                                    <label for="exampleFormControlSelect1" class="ms-0">الصلاحية</label>
                                    <select class="form-control" name="user_role" id="user_role">
                                        <option value="1">مدير</option>
                                        <option value="2">دكتور</option>
                                        <option value="3">استقبال</option>
                                    </select>
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
