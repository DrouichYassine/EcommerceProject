<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="home/css/checkout.css">
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

        <form method="POST" action="{{ route('place.order') }}">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h3><i class="fas fa-shipping-fast me-2"></i>Shipping Information</h3>
                        </div>
                        <div class="card-body">
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
                                    <label for="state" class="form-label">State</label>
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
                                    <strong>Credit/Debit Card</strong>
                                    <p class="mb-0">Pay securely with your card</p>
                                </label>
                            </div>
                            
                            <!-- Credit Card Information (initially hidden) -->
                            <div id="card-details" class="card-payment-details mt-3" style="display: none;">
                                <div class="mb-3">
                                    <label for="card_holder" class="form-label">Cardholder Name</label>
                                    <input type="text" class="form-control" id="card_holder" name="card_holder">
                                </div>
                                <div class="mb-3">
                                    <label for="card_number" class="form-label">Card Number</label>
                                    <input type="text" class="form-control" id="card_number" name="card_number" 
                                           placeholder="XXXX XXXX XXXX XXXX">
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="expiry_date" class="form-label">Expiry Date</label>
                                        <input type="text" class="form-control" id="expiry_date" name="expiry_date" 
                                               placeholder="MM/YY">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="cvv" class="form-label">CVV</label>
                                        <input type="text" class="form-control" id="cvv" name="cvv" 
                                               placeholder="XXX">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="payment_method" 
                                       id="paypal" value="paypal">
                                <label class="form-check-label" for="paypal">
                                    <strong>PayPal</strong>
                                    <p class="mb-0">Pay via PayPal you can pay with your credit card if you don't have a PayPal account.</p>
                                </label>
                            </div>
                            
                            <!-- PayPal Button (initially hidden) -->
                            <div id="paypal-button-container" class="mt-3" style="display: none;">
                                <div class="paypal-button-placeholder">
                                    <button type="button" class="btn btn-primary paypal-button w-100">
                                        <i class="fab fa-paypal me-2"></i> Proceed with PayPal
                                    </button>
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
                                    <div>${{ number_format($item->product->price * $item->quantity, 2) }}</div>
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
            // Simple form submission handler
            $('form').on('submit', function() {
                $('button[type="submit"]').prop('disabled', true)
                    .html('<i class="fas fa-spinner fa-spin me-2"></i> Processing...');
            });
            
            // Payment method toggle
            $('input[name="payment_method"]').change(function() {
                // Hide all payment details first
                $('#card-details, #paypal-button-container').hide();
                
                // Show the appropriate payment details
                if ($(this).val() === 'card') {
                    $('#card-details').show();
                } else if ($(this).val() === 'paypal') {
                    $('#paypal-button-container').show();
                }
            });
        });
    </script>
</body>
</html>