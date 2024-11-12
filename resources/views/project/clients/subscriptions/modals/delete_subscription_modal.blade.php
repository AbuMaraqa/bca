<div class="modal fade" id="delete_subscription_modal" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('clients.subscriptions.delete') }}" method="post">
                @csrf
                <input type="hidden" name="client_id" id="client_id">
                <input type="hidden" name="subscription_id" id="subscription_id">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-normal" id="exampleModalLabel">سحب اشتراك</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>سعر الاشتراك <span id="subscription_price"></span></h5>
                    <div class="input-group input-group-lg input-group-outline my-3">
                        <label class="form-label">المبلغ المخصوم</label>
                        <input name="price_discount" type="text" class="form-control form-control-lg">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">اغلاق</button>
                    <button type="submit" class="btn bg-gradient-primary">الغاء الاشتراك</button>
                </div>
            </form>
        </div>
    </div>
</div>
