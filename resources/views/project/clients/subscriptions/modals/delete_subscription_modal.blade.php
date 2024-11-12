<div class="modal fade" id="freezing_subscription_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('clients.freezing_subscription.add_freezing_subscription') }}" method="post">
                @csrf
                <input type="hidden" name="client_id" id="client_id">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-normal" id="exampleModalLabel">تجميد اشتراك المستخدم</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">اغلاق</button>
                    <button type="submit" class="btn bg-gradient-primary">الغاء الاشتراك</button>
                </div>
            </form>
        </div>
    </div>
</div>
