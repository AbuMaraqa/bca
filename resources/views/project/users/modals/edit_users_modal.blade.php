<div class="modal fade" id="edit_users_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('users.update') }}" method="post">
                @csrf
                <input type="hidden" id="user_id" name="user_id">
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
                                    <input type="text" id="user_name" name="name" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">البريد الالكتروني</label>
                                    <input type="email" id="user_email" name="email" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">كلمة المرور</label>
                                    <input type="password" id="user_password" name="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group input-group-static mb-4">
                                    <label for="exampleFormControlSelect1" class="ms-0">الصلاحية</label>
                                    <select class="form-control" name="user_role" id="user_role">
                                        <option value="admin">مدير</option>
                                        <option value="specialists">دكتور</option>
                                        <option value="reception">استقبال</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">اغلاق</button>
                    <button type="submit" class="btn bg-gradient-primary">تعديل</button>
                </div>
            </form>
        </div>
    </div>
</div>
