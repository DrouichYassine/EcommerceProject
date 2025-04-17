<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="home/css/checkout.css">
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>

    <div class="checkout-container">
        <div class="checkout-header mb-4">
            <h1 class="text-center">Checkout</h1>
            <div class="checkout-steps">
                <div class="step completed">
                    <div class="step-number"><i class="fas fa-check"></i></div>
                    <div class="step-title">Shopping Cart</div>
                </div>
                <div class="step active">
                    <div class="step-number">2</div>
                    <div class="step-title">Checkout</div>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-title">Order Complete</div>
                </div>
            </div>
        </div>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('place.order') }}" id="checkout-form">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h3><i class="fas fa-shipping-fast me-2"></i>Shipping Information</h3>
                        </div>
                        <div class="card-body">
                        <div class="row">
                        <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" 
                                           value="{{ old('first_name', Auth::user()->first_name ?? '') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" 
                                           value="{{ old('last_name', Auth::user()->last_name ?? '') }}" required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="{{ old('email', Auth::user()->email ?? '') }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="phone" 
                                       value="{{ old('phone', Auth::user()->phone ?? '') }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" 
                                       value="{{ old('address', Auth::user()->address ?? '') }}" required>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" name="city" 
                                           value="{{ old('city', Auth::user()->city ?? '') }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="state" class="form-label">Region</label>
                                    <input type="text" class="form-control" id="state" name="state" 
                                           value="{{ old('state', Auth::user()->state ?? '') }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="zip_code" class="form-label">Zip Code</label>
                                    <input type="text" class="form-control" id="zip_code" name="zip_code" 
                                           value="{{ old('zip_code', Auth::user()->zip_code ?? '') }}" required>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3><i class="fas fa-credit-card me-2"></i>Payment Method</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="payment_method" 
                                       id="cash_on_delivery" value="cash_on_delivery" checked>
                                <label class="form-check-label" for="cash_on_delivery">
                                    <strong>Cash on Delivery</strong>
                                    <p class="mb-0">Pay when you receive your order</p>
                                </label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="payment_method" 
                                       id="card" value="card">
                                <label class="form-check-label" for="card">
                                    <strong>Credit/Debit Card (Stripe)</strong>
                                    <p class="mb-0">Pay securely with your card</p>
                                </label>
                            </div>
                            
                            <!-- Stripe Card Element (initially hidden) -->
                            <div id="stripe-card-section" class="mt-3" style="display: none;">
                                <div class="mb-3">
                                    <label for="cardholder-name" class="form-label">Cardholder Name</label>
                                    <input type="text" class="form-control" id="cardholder-name" name="cardholder_name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Card Details</label>
                                    <div id="card-element" class="form-control p-2" style="height: 40px;">
                                        <!-- Stripe will inject the card elements here -->
                                    </div>
                                    <div id="card-errors" role="alert" class="text-danger mt-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                <div class="card order-summary">
                        <div class="card-header bg-success text-white">
                            <h3><i class="fas fa-shopping-basket me-2"></i>Order Summary</h3>
                        </div>
                        <div class="card-body">
                            <div class="order-items mb-3">
                                @foreach($cartItems as $item)
                                <div class="order-item d-flex" >
                                    <img src="{{ asset('storage/products/' . $item->product->image) }}" 
                                         alt="{{ $item->product->name }}" width="60" class="me-3">
                                    <div class="flex-grow-1">
                                        <h6>{{ $item->product->title }}</h6>
                                        <div>Qty: {{ $item->quantity }}</div>
                                    </div>
                                    <div>${{ number_format(($item->discount_price ?: $item->price) * $item->quantity, 2) }}</div>
                                </div>
                                @endforeach
                            </div>

                            <div class="order-totals">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal:</span>
                                    <span>${{ number_format($total, 2) }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Shipping:</span>
                                    <span>$0.00</span>
                                </div>
                                <div class="d-flex justify-content-between fw-bold fs-5">
                                    <span>Total:</span>
                                    <span>${{ number_format($total, 2) }}</span>
                                </div>
                            </div>

                            <div class="form-check mt-4">
                                <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                                <label class="form-check-label" for="terms">
                                    I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">terms and conditions</a>
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg place-order-btn mt-3">
                                <i class="fas fa-lock me-2"></i> Complete Order
                            </button>
                            <a href="{{ route('cart.show') }}" class="btn btn-primary btn-lg cancel-btn mt-3">
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Terms Modal -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Terms and Conditions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>By placing an order, you agree to our terms and conditions...</p>
                    <!-- Add full terms content here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Stripe with your publishable key
            const stripe = Stripe('{{ config("services.stripe.key") }}');
            const elements = stripe.elements();
            let cardElement;

            // Set up Stripe Elements when card payment is selected
            $('input[name="payment_method"]').change(function() {
                $('#stripe-card-section').hide();
                
                if ($(this).val() === 'card') {
                    initStripeElements();
                    $('#stripe-card-section').show();
                    $('#cardholder-name').attr('required', true);
                } else {
                    $('#cardholder-name').attr('required', false);
                }
            });
            
            // Initialize with the default selected payment method
            if ($('input[name="payment_method"]:checked').val() === 'card') {
                initStripeElements();
                $('#stripe-card-section').show();
                $('#cardholder-name').attr('required', true);
            } else {
                $('#cardholder-name').attr('required', false);
            }

            function initStripeElements() {
                if (!cardElement) {
                    const style = {
                        base: {
                            fontSize: '16px',
                            color: '#32325d',
                            '::placeholder': {
                                color: '#aab7c4'
                            }
                        },
                        invalid: {
                            color: '#fa755a',
                            iconColor: '#fa755a'
                        }
                    };
                    
                    cardElement = elements.create('card', { style: style });
                    cardElement.mount('#card-element');
                    
                    cardElement.on('change', function(event) {
                        const displayError = document.getElementById('card-errors');
                        if (event.error) {
                            displayError.textContent = event.error.message;
                        } else {
                            displayError.textContent = '';
                        }
                    });
                }
            }

            // Handle form submission
            $('#checkout-form').on('submit', function(e) {
                const paymentMethod = $('input[name="payment_method"]:checked').val();
                const submitButton = $('button[type="submit"]');
                
                // Only intercept for Stripe card payments
                if (paymentMethod === 'card') {
                    e.preventDefault();
                    
                    // Disable submit button to prevent multiple submissions
                    submitButton.prop('disabled', true)
                        .html('<i class="fas fa-spinner fa-spin me-2"></i> Processing...');

                    // Create payment token with Stripe
                    stripe.createToken(cardElement).then(function(result) {
                        if (result.error) {
                            
                            $('#card-errors').text(result.error.message);
                            submitButton.prop('disabled', false)
                                .html('<i class="fas fa-lock me-2"></i> Complete Order');
                        } else {
                            // Add the token to the form
                            $('<input>')
                                .attr({ type: 'hidden', name: 'stripeToken', value: result.token.id })
                                .appendTo('#checkout-form');
                            
                            // Add payment method
                            $('<input>')
                                .attr({ type: 'hidden', name: 'payment_method', value: 'card' })
                                .appendTo('#checkout-form');
                            
                            // Submit the form
                            document.getElementById('checkout-form').submit();
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>