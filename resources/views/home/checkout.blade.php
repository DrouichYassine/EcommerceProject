<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" type="text/css" href="{{ asset('home/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="home/css/checkout.css"/>
 
</head>

<body>
    <!-- Include header -->
    @include('home.header')
    
    <div class="container checkout-section">
        <div class="checkout-header">
            <h2>Complete Your Purchase</h2>
            
            <div class="checkout-steps">
                <div class="step completed">
                    <div class="step-number"><i class="fas fa-check"></i></div>
                    <div class="step-title">Shopping Cart</div>
                </div>
                <div class="step active">
                    <div class="step-number">2</div>
                    <div class="step-title">Checkout</div>
                </div>
                <div class="step inactive">
                    <div class="step-number">3</div>
                    <div class="step-title">Order Complete</div>
                </div>
            </div>
        </div>
        
        @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <form method="POST" action="{{ url('place_order') }}">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <!-- Shipping Information -->
                    <div class="checkout-form">
                        <h3><i class="fas fa-shipping-fast me-2"></i>Shipping Information</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" name="city" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="state" class="form-label">State</label>
                                    <input type="text" class="form-control" id="state" name="state" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="zip" class="form-label">Zip Code</label>
                                    <input type="text" class="form-control" id="zip" name="zip" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Payment Method -->
                    <div class="checkout-form">
                        <h3><i class="fas fa-credit-card me-2"></i>Payment Method</h3>
                        
                        <div class="payment-method">
                            <div class="payment-option active">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="cash_on_delivery" value="cash_on_delivery" checked>
                                    <label class="form-check-label" for="cash_on_delivery">
                                        <div>
                                            <i class="fas fa-money-bill-wave"></i> Cash on Delivery
                                        </div>
                                        <small>Pay when you receive your order</small>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <!-- Order Summary -->
                    <div class="order-summary">
                        <h3><i class="fas fa-shopping-basket me-2"></i>Order Summary</h3>
                        
                        <div class="order-items">
                            @php $total = 0; @endphp
                            @foreach($cart as $item)
                                <div class="order-item d-flex align-items-center">
                                    <img src="/product/{{ $item->image }}" class="me-3" alt="{{ $item->product_title }}">
                                    <div class="flex-grow-1">
                                        <h6>{{ $item->product_title }}</h6>
                                        <small>Qty: {{ $item->quantity }}</small>
                                    </div>
                                    <div class="ms-auto fw-bold">${{ $item->price }}</div>
                                </div>
                                @php $total += $item->price; @endphp
                            @endforeach
                        </div>
                        
                        <div class="order-totals mt-4">
                            <div class="subtotal-row">
                                <span>Subtotal</span>
                                <span>${{ $total }}</span>
                            </div>
                            <div class="subtotal-row">
                                <span>Shipping</span>
                                <span>$0.00</span>
                            </div>
                            <div class="total-row">
                                <span>Total</span>
                                <span>${{ number_format($total, 2) }}</span>
                            </div>
                        </div>
                        
                        <div class="terms">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                                <label class="form-check-label" for="terms">
                                    I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">terms and conditions</a>
                                </label>
                            </div>
                        </div>
                        
                        <button type="submit" class="place-order-btn" id="place_order_btn">
                            <i class="fas fa-lock me-2"></i> Complete Order
                        </button>
                        
                        <div class="text-center mt-4">
                            <small class="text-muted d-block mb-2">Secure Checkout</small>
                            <div class="payment-icons">
                                <i class="fab fa-cc-visa mx-1" style="font-size: 24px; color: #1a1f71;"></i>
                                <i class="fab fa-cc-mastercard mx-1" style="font-size: 24px; color: #eb001b;"></i>
                                <i class="fab fa-cc-amex mx-1" style="font-size: 24px; color: #006fcf;"></i>
                                <i class="fab fa-cc-paypal mx-1" style="font-size: 24px; color: #003087;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
    <!-- Terms and Conditions Modal -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>1. Introduction</h6>
                    <p>These terms and conditions govern your use of our website and the purchase of products from our online store.</p>
                    
                    <h6>2. Acceptance of Terms</h6>
                    <p>By placing an order, you agree to be bound by these terms and conditions.</p>
                    
                    <h6>3. Prices and Payment</h6>
                    <p>All prices are in USD and include applicable taxes. Payment is required at the time of ordering.</p>
                    
                    <h6>4. Shipping and Delivery</h6>
                    <p>We aim to deliver products within the estimated timeframes, but cannot guarantee delivery times.</p>
                    
                    <h6>5. Returns and Refunds</h6>
                    <p>You may return products within 30 days of delivery for a full refund or exchange.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Include footer -->
    @include('home.footer')
    
    <!-- jQuery and Bootstrap Bundle -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form submission - Update steps before submitting
            const orderForm = document.querySelector('form');
            const placeOrderBtn = document.getElementById('place_order_btn');
            
            placeOrderBtn.addEventListener('click', function(event) {
                // If form is not valid, don't do anything (browser validation will handle it)
                if (!orderForm.checkValidity()) {
                    return;
                }
                
                // Prevent default form submission temporarily
                event.preventDefault();
                
                // Update the step indicators
                const steps = document.querySelectorAll('.checkout-steps .step');
                steps[0].classList.remove('active');
                steps[0].classList.add('completed');
                steps[1].classList.remove('active');
                steps[1].classList.add('completed');
                steps[2].classList.remove('inactive');
                steps[2].classList.add('active');
                
                // Disable the submit button to prevent multiple submissions
                placeOrderBtn.disabled = true;
                placeOrderBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Processing...';
                
                // Submit the form after a short delay to show the UI update
                setTimeout(function() {
                    orderForm.submit();
                }, 800);
            });
            
            // Add validation feedback animations
            const formInputs = document.querySelectorAll('.form-control');
            formInputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('is-focused');
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('is-focused');
                    if (this.value.trim() !== '') {
                        this.parentElement.classList.add('is-filled');
                    } else {
                        this.parentElement.classList.remove('is-filled');
                    }
                });
                
                // Set initial state for pre-filled inputs
                if(input.value.trim() !== '') {
                    input.parentElement.classList.add('is-filled');
                }
            });
            
            // Smoother scroll to error messages
            if(document.querySelector('.is-invalid')) {
                document.querySelector('.is-invalid').scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        });
    </script>
</body>
</html>
