<div class="modal fade success" id="delete" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <img class="img-fluid" src="{{ asset('assets/ecommerce/img/delete.png') }}">
                <h4 class="title-sm text-dark text-center" id="deleteModalLabel">
                    {{ __('ecommerce.delete_modal_title') }}
                </h4>
            </div>
            <div class="modal-body">
                <p class="text-center text-default">
                    {{ __('ecommerce.delete_modal_body') }}
                </p>
            </div>

            <form action="{{ route('ecommerce.customer.destroy', Auth::guard('ecommerce')->user()->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-footer">
                    <button  type="submit" class="w-50 btn btn-primary ">{{ __('ecommerce.delete_button') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
