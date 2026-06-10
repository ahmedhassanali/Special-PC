<div class="modal fade edit" id="add-card" tabindex="-1" data-bs-backdrop="static"
        aria-labelledby="add-cardModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title-sm text-dark" id="add-cardModalLabel">
                        {{ __('ecommerce.add_card_modal_title') }}
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row" action="{{ route('store.payment.card') }}"  method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12 mb-3">
                            <label class="text-default">
                                {{ __('ecommerce.full_name_label') }}
                            </label>
                            <input type="text" class="form-control" id="" placeholder="Your full name" name="name"
                                required>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="text-default">
                                {{ __('ecommerce.card_number_label') }}
                            </label>
                            <input type="text" class="form-control" id="" name="card_number"
                                placeholder="XXXX - XXXX - XXXX - XXXX" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="text-default">
                                {{ __('ecommerce.expiration_date_label') }}
                            </label>
                            <input type="date" class="form-control" id="" placeholder="MM/YY" name="expire_date" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="text-default">
                                {{ __('ecommerce.cvv_label') }}
                            </label>
                            <input type="number" class="form-control" id="" name='cvv' placeholder="xxx" required>
                        </div>

                        <div class="col-6 mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="default" role="switch" id="defaultChecked">
                                <label class="form-check-label text-default" for="defaultChecked">
                                    {{ __('ecommerce.default_card_label') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="w-50 btn btn-primary borderless">حفظ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
