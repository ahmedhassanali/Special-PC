<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
    integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('assets/ecommerce/bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ asset('assets/ecommerce/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/ecommerce/js/main.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>


@if (session('success'))
    <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'نجاح',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 1500
        })
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            title: 'خطأ',
            icon: 'error',
            text: '{{ session('error') }}',
            confirmButtonText: 'OK'
        });
    </script>
@endif


<script>
    const inputs = document.getElementById("inputs");

    inputs.addEventListener("input", function(e) {
        const target = e.target;
        const val = target.value;

        if (isNaN(val)) {
            target.value = "";
            return;
        }

        if (val != "") {
            const next = target.nextElementSibling;
            if (next) {
                next.focus();
            }
        }
    });

    inputs.addEventListener("keyup", function(e) {
        const target = e.target;
        const key = e.key.toLowerCase();

        if (key == "backspace" || key == "delete") {
            target.value = "";
            const prev = target.previousElementSibling;
            if (prev) {
                prev.focus();
            }
            return;
        }
    });
</script>


<script>
        function adjustSectionHeight() {
            let filterHeight = $('.filter-col').outerHeight();
            // Set the section's height to match the filter's height plus 161px
            $('.category.page').css('min-height', filterHeight + 161);
        }

        // Call the function initially
        adjustSectionHeight();

        // Call the function whenever the filter changes
        $('.filter-option').on('change', adjustSectionHeight);
    </script>

</script>
     
<script>
    $(document).ready(function() {
        $('#newPasswordForm').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,
                success: function(response) {
                    $('#success').modal('show');
                    $('#newPasswordForm')[0].reset();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>




<script>
    function toggleVisibility(index) {
        var slides = document.querySelectorAll('.productSlides');
        slides.forEach(function(slide, i) {
            if (i === index) {
                slide.style.display = 'block';
            } else {
                slide.style.display = 'none';
            }
        });
    }
</script>


<script>
    $(document).ready(function() {
        $('#addOrderForm').submit(function(event) {
            event.preventDefault();
            var selectedAddressId = $('input[name="customer_address_id_radio"]:checked').val();
            $('#customer_address_id').val(selectedAddressId);

            var selectedPaymentType = $('input[name="payment_type_radio"]:checked').val();
            $('#payment_type').val(selectedPaymentType);

            var selectedCoupon = $('input[name="coupon_input"]').val();
            $('#coupon_id').val(selectedCoupon);


            if ($(this).attr('action') ==  "{{route('charge')}}") {
                // To avoid an infinite loop, unbind the submit handler before submitting the form
                $(this).unbind('submit').submit();
            } else {
                var formData = $(this).serialize();
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,

                success: function(response) {
                    if (response == 'walletError') {
                        Swal.fire({
                            title: 'خطأ',
                            icon: 'error',
                            text: 'رصيد المحفظة غير كافٍ. يرجى إعادة شحن المحفظة',
                            confirmButtonText: 'OK'
                        });
                    } else if (response == 'PaymentError') {
                        Swal.fire({
                            title: 'خطأ',
                            icon: 'error',
                            text: 'خطأ في عملية الدفع',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        $('#addOrderForm')[0].reset();
                        $('#orderSuccess').modal('show');
                    }
                },
                error: function(xhr, status, error) {
                    if (xhr.status === 400) {
                        alert(xhr.responseText); // Display the error message
                    } else {
                        alert('An error occurred.'); // Display a generic error message
                    }
                }
            });
            }

 
        });
    });
</script>

<script>
    function submitFavorite(button) {
        var form = button.closest('.favoriteForm');
        var formData = new FormData(form);

        fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    // Handle successful response
                    console.log('Form submitted successfully');
                    button.classList.toggle('active');

                    // Optionally, you can update the UI here
                } else {
                    // Handle error response
                    console.error('Form submission failed');
                }
            })
            .catch(error => {
                // Handle network error
                console.error('Error:', error);
            });
    }
</script>

<script>
    function submitAddToCart(productId) {
        var form = document.getElementById('addToCartForm');
        var formData = new FormData(form);

        // Append the product ID to the form data
        formData.append('product_id', productId);

        fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Item added to cart successfully');

                    var cartIconCounter = document.getElementById('cartIconCounter');
                    if (cartIconCounter) {
                        var count = parseInt(cartIconCounter.innerText);
                        cartIconCounter.innerText = count + 1;
                    }

                    Swal.fire({
                        title: 'تمت العملية بنجاح!',
                        text: 'تمت إضافة المنتج إلى السلة بنجاح',
                        icon: 'success',
                        confirmButtonText: 'حسناً'
                    });

                } else {
                    console.error('Failed to add item to cart:', data.message);
                    Swal.fire({
                        title: 'خطأ!',
                        text: 'فشلت عملية إضافة المنتج إلى السلة',
                        icon: 'error',
                        confirmButtonText: 'حسناً'
                    });
                }
            })
            .catch(error => {
                // Handle network error
                //  console.error('Error:', error);

                // Swal.fire({
                //     title: 'خطأ!',
                //     text: 'يرجا التاكد من تسجيل الدخول اولا',
                //     icon: 'error',
                //     confirmButtonText: 'حسناً'
                // });

                $("#hello").modal('show');

            });
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const plusButtons = document.querySelectorAll('.plus-btn');
        const minusButtons = document.querySelectorAll('.minus-btn');

        plusButtons.forEach(button => {
            button.addEventListener('click', function() {
                updateQuantity(this.dataset.itemId, 'plus');
            });
        });

        minusButtons.forEach(button => {
            button.addEventListener('click', function() {
                updateQuantity(this.dataset.itemId, 'minus');
            });
        });

        function updateQuantity(itemId, action) {
            const quantityInput = document.querySelector(`.quantity-input[data-item-id="${itemId}"]`);
            let newQuantity = parseInt(quantityInput.value);

            if (action === 'plus') {
                newQuantity++;
            } else if (action === 'minus' && newQuantity > 1) {
                newQuantity--;
            } else {
                return; // Prevent decreasing quantity below 1
            }

            // Send AJAX request to update quantity
            fetch(`/update-quantity/${itemId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        quantity: newQuantity
                    })
                })
                .then(response => {
                    if (response.ok) {
                        quantityInput.value = newQuantity; // Update input field value
                    } else {
                        console.error('Failed to update quantity');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    });
</script>

<script>
    // Event listeners for plus and minus buttons
    document.querySelectorAll('.plus-button').forEach(button => {
        button.addEventListener('click', () => {
            updateQuantity(button, 1); // Increase quantity by 1
        });
    });

    document.querySelectorAll('.minus-button').forEach(button => {
        button.addEventListener('click', () => {
            updateQuantity(button, -1); // Decrease quantity by 1
        });
    });

    // Function to update quantity
    function updateQuantity(button, change) {
        const inputField = button.parentElement.querySelector('.quantity-input');
        const productInputField = button.parentElement.querySelector('.product-input');

        let newQuantity = parseInt(inputField.value) + change;

        let oldQuantity = parseInt(inputField.value);
        // Validate new quantity
        if (newQuantity < 1) {
            console.error('Error: Quantity cannot be less than 1');
            return;
        }

        var allPrice = document.getElementById('item-price-' + productInputField.value);
        var price = parseFloat(allPrice.textContent) / oldQuantity;

        inputField.value = newQuantity;

        // Submit form with updated quantity
        submitAddQuantity(inputField, newQuantity, productInputField, price);
    }

    function submitAddQuantity(inputField, quantity, productInputField, price) {
        const form = document.getElementById('quantityForm');
        const formData = new FormData(form);

        formData.set('quantity', inputField.value);
        formData.set('product_id', productInputField.value);

        fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    handleQuantityUpdateSuccess(inputField, quantity, productInputField, price);
                } else {
                    handleQuantityUpdateError(data.message);
                }
            })
            .catch(error => {
                handleQuantityUpdateError('An error occurred while updating quantity. Please try again later.');
            });
    }

    function handleQuantityUpdateSuccess(inputField, quantity, productInputField, price) {
        console.log('Quantity updated successfully');

        // Update the item price
        const itemPrice = document.getElementById('item-price-' + productInputField.value);
        itemPrice.textContent = (price * quantity) + ' {{ __('ecommerce.currency') }}';

        updateTotalQuantity();
        updateTotalPrice();
    }

    function handleQuantityUpdateError(errorMessage) {
        console.error('Error: Quantity update failed');
        Swal.fire({
            title: 'خطأ!',
            text: errorMessage,
            icon: 'error',
            confirmButtonText: 'حسناً'
        });
    }

    function updateTotalQuantity() {
        const totalQuantityInput = document.getElementById('total-quantity');
        const quantityInputs = document.querySelectorAll('.quantity-input');
        const cartIconCounter = document.getElementById('cartIconCounter');

        let totalQuantity = 0;
        quantityInputs.forEach(input => {
            totalQuantity += parseInt(input.value);
        });
        totalQuantityInput.textContent = totalQuantity;
        cartIconCounter.textContent = totalQuantity;
    }

    function updateTotalPrice() {
        const totalPriceInput = document.getElementById('total-price');
        const totalOrderPrice = document.getElementById('order-price');
        const priceInputs = document.querySelectorAll('.item-price');
        let totalPrice = 0;
        priceInputs.forEach(input => {
            totalPrice += parseFloat(input.textContent.replace('{{ __('ecommerce.currency') }}', ''));
        });
        totalPriceInput.textContent = totalPrice;
        totalOrderPrice.textContent = totalPrice + ' {{ __('ecommerce.currency') }}';
    }
</script>
