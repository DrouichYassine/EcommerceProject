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
    
    <style>
        :root {
            --primary-color: #2c3e50;
            --primary-light: #34495e;
            --primary-dark: #1a252f;
            --accent-color: #e74c3c;
            --accent-hover: #c0392b;
            --text-color: #2c3e50;
            --text-light: #7f8c8d;
            --light-bg: #f8f9fa;
            --medium-gray: #e9ecef;
            --dark-gray: #adb5bd;
            --success-color: #27ae60;
            --box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            --hover-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            --border-radius: 8px;
            --input-border-radius: 6px;
            --border-color: #e0e0e0;
        }
        
        body {
            font-family: 'Segoe UI', Roboto, -apple-system, BlinkMacSystemFont, 'Helvetica Neue', sans-serif;
            color: var(--text-color);
            background-color: var(--light-bg);
            line-height: 1.6;
        }
        
        .checkout-section {
            padding: 80px 0;
        }
        
        .checkout-header {
            margin-bottom: 40px;
        }
        
        .checkout-header h2 {
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 30px;
            font-size: 32px;
            letter-spacing: -0.5px;
        }
        
        /* Enhanced checkout steps */
        .checkout-steps {
            display: flex;
            position: relative;
            margin-bottom: 50px;
            background: linear-gradient(to right, #ffffff, #f8f9fa);
            padding: 25px 30px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            border: 1px solid var(--border-color);
        }
        
        .checkout-steps:before {
            content: '';
            position: absolute;
            top: 30px;
            left: 80px;
            right: 80px;
            height: 2px;
            background: var(--medium-gray);
            z-index: 1;
        }
        
        .step {
            position: relative;
            z-index: 2;
            text-align: center;
            width: 33.333%;
        }
        
        .step-number {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: white;
            border: 2px solid var(--border-color);
            color: var(--text-light);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-weight: 600;
            font-size: 18px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .step.active .step-number {
            background: linear-gradient(135deg, var(--accent-color), var(--accent-hover));
            border-color: var(--accent-color);
            color: white;
            transform: scale(1.1);
            box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
        }
        
        .step.completed .step-number {
            background: linear-gradient(135deg, var(--success-color), #2ecc71);
            border-color: var(--success-color);
            color: white;
        }
        
        .step-title {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-light);
            transition: all 0.3s ease;
            letter-spacing: 0.3px;
        }
        
        .step.active .step-title {
            color: var(--accent-color);
            font-weight: 600;
        }
        
        .step.completed .step-title {
            color: var(--success-color);
        }
        
        /* Improved form containers */
        .checkout-form {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 40px;
            margin-bottom: 35px;
            transition: all 0.3s ease;
            border: 1px solid var(--border-color);
        }
        
        .checkout-form:hover {
            box-shadow: var(--hover-shadow);
        }
        
        .checkout-form h3 {
            font-size: 22px;
            margin-bottom: 30px;
            color: var(--text-color);
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
            font-weight: 600;
            position: relative;
        }
        
        .checkout-form h3:after {
            content: '';
            position: absolute;
            width: 60px;
            height: 3px;
            background: var(--accent-color);
            bottom: -2px;
            left: 0;
        }
        
        /* Enhanced form elements */
        .form-group {
            margin-bottom: 28px;
            position: relative;
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 12px;
            color: var(--text-color);
            font-size: 15px;
            display: block;
        }
        
        .form-control {
            padding: 14px 18px;
            border: 1px solid var(--border-color);
            border-radius: var(--input-border-radius);
            font-size: 15px;
            transition: all 0.3s ease;
            height: auto;
            color: var(--text-color);
            background-color: #fff;
        }
        
        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.2rem rgba(231, 76, 60, 0.15);
            outline: none;
        }
        
        .form-control::placeholder {
            color: #bdc3c7;
            font-size: 14px;
        }
        
        .is-focused .form-control {
            border-color: var(--accent-color);
        }
        
        .is-filled .form-label {
            color: var(--text-color);
        }
        
        /* Professional order summary */
        .order-summary {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 40px;
            position: sticky;
            top: 30px;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }
        
        .order-summary:hover {
            box-shadow: var(--hover-shadow);
        }
        
        .order-summary h3 {
            font-size: 22px;
            margin-bottom: 30px;
            color: var(--text-color);
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
            font-weight: 600;
            position: relative;
        }
        
        .order-summary h3:after {
            content: '';
            position: absolute;
            width: 60px;
            height: 3px;
            background: var(--accent-color);
            bottom: -2px;
            left: 0;
        }
        
        .order-items {
            max-height: 300px;
            overflow-y: auto;
            padding-right: 10px;
            margin-bottom: 25px;
            scrollbar-width: thin;
            scrollbar-color: var(--dark-gray) var(--light-bg);
        }
        
        .order-items::-webkit-scrollbar {
            width: 6px;
        }
        
        .order-items::-webkit-scrollbar-track {
            background: var(--light-bg);
            border-radius: 10px;
        }
        
        .order-items::-webkit-scrollbar-thumb {
            background: var(--dark-gray);
            border-radius: 10px;
        }
        
        .order-item {
            padding: 16px 0;
            border-bottom: 1px solid var(--light-bg);
            transition: all 0.2s ease;
        }
        
        .order-item:hover {
            background-color: rgba(0,0,0,0.01);
        }
        
        .order-item:last-child {
            border-bottom: none;
        }
        
        .order-item img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .order-item h6 {
            font-weight: 600;
            color: var(--text-color);
            font-size: 15px;
            margin-bottom: 5px;
        }
        
        .order-item small {
            color: var(--text-light);
            font-size: 13px;
        }
        
        .subtotal-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            color: var(--text-light);
            font-size: 15px;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 20px 0;
            font-weight: 700;
            font-size: 20px;
            border-top: 2px solid var(--light-bg);
            margin-top: 15px;
            color: var(--text-color);
        }
        
        /* Professional payment method options */
        .payment-method {
            margin-top: 35px;
        }
        
        .payment-option {
            margin-bottom: 16px;
            padding: 20px;
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            background-color: white;
        }
        
        .payment-option:hover {
            border-color: #3498db;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        
        .payment-option.active {
            border-color: var(--accent-color);
            background-color: rgba(231, 76, 60, 0.03);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.1);
        }
        
        .payment-option .form-check {
            margin: 0;
            padding: 0;
            width: 100%;
        }
        
        .payment-option .form-check-input {
            margin-right: 15px;
            width: 22px;
            height: 22px;
            border: 2px solid var(--border-color);
        }
        
        .payment-option .form-check-input:checked {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
        }
        
        .payment-option .form-check-label {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-weight: 500;
            font-size: 16px;
            color: var(--text-color);
            width: 100%;
        }
        
        .payment-option i {
            font-size: 28px;
            margin-right: 15px;
        }
        
        .payment-option small {
            color: var(--text-light);
            font-weight: normal;
        }
        
        .fab.fa-cc-visa {
            color: #1a1f71;
        }
        
        .fab.fa-paypal {
            color: #003087;
        }
        
        .fas.fa-money-bill-wave {
            color: #2ecc71;
        }
        
        /* Professional credit card form */
        #credit_card_form {
            background-color: #f8f9fa;
            padding: 25px;
            border-radius: var(--border-radius);
            margin-top: 25px;
            transition: all 0.3s ease;
            border: 1px solid var(--border-color);
        }
        
        /* Professional terms and checkout button */
        .terms {
            margin: 30px 0;
        }
        
        .form-check-input {
            width: 18px;
            height: 18px;
            margin-right: 10px;
            border: 2px solid var(--border-color);
        }
        
        .form-check-input:checked {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
        }
        
        .terms a {
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        
        .terms a:hover {
            color: var(--accent-hover);
            text-decoration: underline;
        }
        
        .place-order-btn {
            background: linear-gradient(135deg, var(--accent-color), var(--accent-hover));
            color: white;
            padding: 16px 30px;
            border: none;
            border-radius: var(--input-border-radius);
            font-size: 16px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.2);
        }
        
        .place-order-btn:hover {
            box-shadow: 0 7px 20px rgba(231, 76, 60, 0.4);
            transform: translateY(-3px);
        }
        
        .place-order-btn:active {
            transform: translateY(-1px);
            box-shadow: 0 3px 10px rgba(231, 76, 60, 0.3);
        }
        
        /* Terms modal improvements */
        .modal-content {
            border-radius: var(--border-radius);
            border: none;
            box-shadow: 0 15px 35px rgba(0,0,0,0.25);
        }
        
        .modal-header {
            border-bottom: 1px solid var(--border-color);
            padding: 25px 30px;
            background-color: #f8f9fa;
        }
        
        .modal-body {
            padding: 30px;
        }
        
        .modal-body h6 {
            color: var(--text-color);
            font-weight: 600;
            margin-top: 25px;
            margin-bottom: 15px;
            font-size: 17px;
        }
        
        .modal-body p {
            color: var(--text-light);
            line-height: 1.7;
        }
        
        .modal-footer {
            border-top: 1px solid var(--border-color);
            padding: 20px 30px;
            background-color: #f8f9fa;
        }
        
        .modal-footer .btn-primary {
            background: var(--accent-color);
            border-color: var(--accent-color);
            padding: 10px 25px;
            font-weight: 500;
            border-radius: var(--input-border-radius);
            transition: all 0.3s ease;
        }
        
        .modal-footer .btn-primary:hover {
            background: var(--accent-hover);
            border-color: var(--accent-hover);
            box-shadow: 0 4px 12px rgba(231, 76, 60, 0.2);
        }
        
        .same-address-check {
            margin-bottom: 25px;
        }
        
        .same-address-check .form-check-label {
            font-weight: 500;
            font-size: 15px;
            color: var(--text-color);
        }
        
        /* Alert improvements */
        .alert-success {
            background-color: rgba(46, 204, 113, 0.1);
            border-color: rgba(46, 204, 113, 0.3);
            color: #27ae60;
            border-radius: var(--border-radius);
            padding: 15px 20px;
            font-weight: 500;
        }
        
        /* Responsive adjustments */
        @media (max-width: 991px) {
            .checkout-section {
                padding: 60px 0;
            }
            
            .checkout-steps:before {
                left: 60px;
                right: 60px;
            }
            
            .order-summary {
                margin-top: 30px;
                position: static;
            }
            
            .checkout-form, .order-summary {
                padding: 30px;
            }
        }
        
        @media (max-width: 767px) {
            .checkout-form, .order-summary {
                padding: 25px;
            }
            
            .checkout-steps:before {
                left: 40px;
                right: 40px;
            }
            
            .step-number {
                width: 50px;
                height: 50px;
                font-size: 16px;
            }
            
            .step-title {
                font-size: 13px;
            }
            
            .place-order-btn {
                padding: 14px 20px;
                font-size: 15px;
            }
            
            .checkout-header h2 {
                font-size: 28px;
            }
        }
    </style>
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
                    
                    <!-- Billing Information -->
                    <div class="checkout-form">
                        <h3><i class="fas fa-file-invoice-dollar me-2"></i>Billing Information</h3>
                        
                        <div class="same-address-check form-check">
                            <input class="form-check-input" type="checkbox" id="same_address" name="same_address" checked>
                            <label class="form-check-label" for="same_address">
                                Same as shipping address
                            </label>
                        </div>
                        
                        <div id="billing_address_form" style="display: none;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="billing_first_name" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="billing_first_name" name="billing_first_name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="billing_last_name" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="billing_last_name" name="billing_last_name">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="billing_address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="billing_address" name="billing_address">
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="billing_city" class="form-label">City</label>
                                        <input type="text" class="form-control" id="billing_city" name="billing_city">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="billing_state" class="form-label">State</label>
                                        <input type="text" class="form-control" id="billing_state" name="billing_state">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="billing_zip" class="form-label">Zip Code</label>
                                        <input type="text" class="form-control" id="billing_zip" name="billing_zip">
                                    </div>
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
                                    <input class="form-check-input" type="radio" name="payment_method" id="credit_card" value="credit_card" checked>
                                    <label class="form-check-label" for="credit_card">
                                        <div>
                                            <i class="fab fa-cc-visa"></i> Credit Card
                                        </div>
                                        <small>Visa, Mastercard, American Express</small>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="payment-option">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="paypal" value="paypal">
                                    <label class="form-check-label" for="paypal">
                                        <div>
                                            <i class="fab fa-paypal"></i> PayPal
                                        </div>
                                        <small>Pay with your PayPal account</small>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="payment-option">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="cash_on_delivery" value="cash_on_delivery">
                                    <label class="form-check-label" for="cash_on_delivery">
                                        <div>
                                            <i class="fas fa-money-bill-wave"></i> Cash on Delivery
                                        </div>
                                        <small>Pay when you receive your order</small>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Credit Card Form -->
                        <div id="credit_card_form" class="mt-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="card_name" class="form-label">Name on Card</label>
                                        <input type="text" class="form-control" id="card_name" name="card_name">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="card_number" class="form-label">Card Number</label>
                                <input type="text" class="form-control" id="card_number" name="card_number" placeholder="XXXX XXXX XXXX XXXX">
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="expiry_date" class="form-label">Expiry Date</label>
                                        <input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="MM/YY">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cvv" class="form-label">CVV</label>
                                        <input type="text" class="form-control" id="cvv" name="cvv" placeholder="XXX">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- PayPal Account Form -->
                        <div id="paypal_account_form" class="mt-4" style="display: none;">
                            <div class="form-group">
                                <label for="paypal_email" class="form-label">PayPal Account Email</label>
                                <input type="email" class="form-control" id="paypal_email" name="paypal_email" placeholder="your.email@example.com">
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
                        
                        <button type="submit" class="place-order-btn">
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
            // Show/hide billing address form
            const sameAddressCheckbox = document.getElementById('same_address');
            const billingAddressForm = document.getElementById('billing_address_form');
            
            sameAddressCheckbox.addEventListener('change', function() {
                billingAddressForm.style.display = this.checked ? 'none' : 'block';
            });
            
            // Payment method options
            const paymentOptions = document.querySelectorAll('.payment-option');
            const creditCardForm = document.getElementById('credit_card_form');
            const paypalAccountForm = document.getElementById('paypal_account_form');
            
            paymentOptions.forEach(option => {
                option.addEventListener('click', function() {
                    // Remove active class from all options
                    paymentOptions.forEach(opt => opt.classList.remove('active'));
                    // Add active class to clicked option
                    this.classList.add('active');
                    // Check the radio button
                    const radio = this.querySelector('input[type="radio"]');
                    radio.checked = true;
                    
                    // Show/hide payment forms based on selection
                    creditCardForm.style.display = 'none';
                    paypalAccountForm.style.display = 'none';
                    
                    if (radio.id === 'credit_card') {
                        creditCardForm.style.display = 'block';
                    } else if (radio.id === 'paypal') {
                        paypalAccountForm.style.display = 'block';
                    }
                });
            });
            
            // Format credit card number with spaces
            const cardNumberInput = document.getElementById('card_number');
            if(cardNumberInput) {
                cardNumberInput.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\s+/g, '');
                    if (value.length > 0) {
                        value = value.match(new RegExp('.{1,4}', 'g')).join(' ');
                    }
                    e.target.value = value;
                });
            }
            
            // Format expiry date with slash
            const expiryDateInput = document.getElementById('expiry_date');
            if(expiryDateInput) {
                expiryDateInput.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\D/g, '');
                    if (value.length > 2) {
                        value = value.slice(0, 2) + '/' + value.slice(2, 4);
                    }
                    e.target.value = value;
                });
            }
            
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
