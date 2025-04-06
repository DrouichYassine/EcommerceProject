<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .success-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 10px;
            background: #f9f9f9;
        }
        .success-icon {
            font-size: 80px;
            color: #28a745;
            margin-bottom: 20px;
        }
        .order-details {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-top: 30px;
            text-align: left;
        }
    </style>
</head>
<body>


    <div class="success-container">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <h1>Thank You For Your Order!</h1>
        <p class="lead">Your order has been placed successfully.</p>
        <p>Order Number: <strong>{{ $order->order_number }}</strong></p>
        
        <div class="order-details">
            <h4>Order Summary</h4>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Shipping Address:</strong></p>
                    <p>{{ $order->first_name }} {{ $order->last_name }}</p>
                    <p>{{ $order->address }}</p>
                    <p>{{ $order->city }}, {{ $order->state }} {{ $order->zip_code }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Payment Method:</strong> {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</p>
                    <p><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>
                    <p><strong>Order Status:</strong> {{ ucfirst($order->status) }}</p>
                </div>
            </div>
        </div>

        <a href="{{ route('cart.show') }}" class="btn btn-primary mt-4">
            <i class="fas fa-home me-2"></i> Back to Home
        </a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>