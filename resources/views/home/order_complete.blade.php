<!DOCTYPE html>
<html>
<head>
    <title>Order Complete</title>
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
    
    <style>
        .order-complete-container {
            padding: 80px 0;
            text-align: center;
        }
        
        .order-complete-icon {
            color: #28a745;
            font-size: 100px;
            margin-bottom: 30px;
            animation: pulse 1.5s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        
        .countdown {
            font-size: 18px;
            margin-top: 30px;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <!-- Include header -->
    @include('home.header')
    
    <div class="container checkout-section">
        <div class="checkout-header">
            <h2>Order Confirmation</h2>
            
            <div class="checkout-steps">
                <div class="step completed">
                    <div class="step-number"><i class="fas fa-check"></i></div>
                    <div class="step-title">Shopping Cart</div>
                </div>
                <div class="step completed">
                    <div class="step-number"><i class="fas fa-check"></i></div>
                    <div class="step-title">Checkout</div>
                </div>
                <div class="step active">
                    <div class="step-number">3</div>
                    <div class="step-title">Order Complete</div>
                </div>
            </div>
        </div>
        
        <div class="order-complete-container">
            <div class="order-complete-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            
            <h1>Thank You for Your Order!</h1>
            <p class="lead">Your order has been placed successfully and is now being processed.</p>
            <p>We have sent a confirmation email to your inbox.</p>
            
            @if(isset($order))
                <div class="alert alert-success mt-4">
                    <h5>Order #{{ $order->id }}</h5>
                    <p>Your order status is currently <strong>{{ $order->order_status }}</strong>.</p>
                </div>
            @endif
            
            <div class="countdown mt-4">
                <p>You will be redirected to the home page in <span id="countdown">5</span> seconds...</p>
            </div>
        </div>
    </div>
    
    <!-- Include footer -->
    @include('home.footer')
    
    <!-- jQuery and Bootstrap Bundle -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Countdown and redirect
        document.addEventListener('DOMContentLoaded', function() {
            let seconds = 5;
            const countdownElement = document.getElementById('countdown');
            
            const interval = setInterval(function() {
                seconds--;
                countdownElement.textContent = seconds;
                
                if (seconds <= 0) {
                    clearInterval(interval);
                    window.location.href = "{{ url('/') }}";
                }
            }, 1000);
        });
    </script>
</body>
</html>
