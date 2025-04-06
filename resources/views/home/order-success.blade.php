<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e8edf2 100%);
            font-family: 'Poppins', sans-serif;
            color: #2c3e50;
        }
        
        .success-container {
            max-width: 850px;
            margin: 60px auto;
            padding: 40px;
            text-align: center;
            border: none;
            border-radius: 15px;
            background: white;
            box-shadow: 0 15px 35px rgba(50, 50, 93, 0.1), 0 5px 15px rgba(0, 0, 0, 0.07);
            transition: all 0.3s ease;
        }
        
        .success-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 18px 38px rgba(50, 50, 93, 0.15), 0 8px 18px rgba(0, 0, 0, 0.1);
        }
        
        .success-icon {
            font-size: 85px;
            color: #3fbf48;
            margin-bottom: 25px;
            text-shadow: 0 2px 5px rgba(63, 191, 72, 0.2);
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        h1 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: #1a2a3a;
        }
        
        .lead {
            font-size: 1.2rem;
            color: #5a6a7a;
            margin-bottom: 20px;
        }
        
        .order-number {
            display: inline-block;
            background: linear-gradient(45deg, #2c3e50, #4a5568);
            color: white;
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 600;
            margin: 10px 0 25px;
            letter-spacing: 1px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        
        .order-details {
            background: #f8fafc;
            border-radius: 12px;
            padding: 30px;
            margin-top: 35px;
            text-align: left;
            border: 1px solid #e9ecef;
            position: relative;
        }
        
        .order-details h4 {
            font-family: 'Playfair Display', serif;
            color: #1a2a3a;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid rgba(63, 191, 72, 0.3);
        }
        
        .order-detail-row {
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eaeaea;
        }
        
        .order-detail-row:last-child {
            border-bottom: none;
        }
        
        .action-btn {
            margin-top: 30px;
            padding: 12px 30px;
            font-weight: 500;
            border-radius: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }
        
        .action-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
        }
        
        .home-btn {
            background: linear-gradient(45deg, #3fbf48, #2a9d8f);
            border: none;
            color: white;
        }
        
        .detail-label {
            font-weight: 600;
            color: #2c3e50;
        }
        
        .detail-value {
            color: #5a6a7a;
        }
        
        .address-card {
            background: white;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            height: 100%;
        }
    </style>
</head>
<body>

    <div class="success-container">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <h1>Thank You For Your Purchase!</h1>
        <p class="lead">Your order has been processed successfully and is now being prepared.</p>
        <div class="order-number">ORDER #{{ $order->order_number }}</div>
        
        <div class="order-details">
            <h4>Order Summary</h4>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="address-card">
                        <p class="detail-label mb-2"><i class="fas fa-map-marker-alt me-2"></i>Shipping Address:</p>
                        <p class="detail-value mb-1">{{ $order->first_name }} {{ $order->last_name }}</p>
                        <p class="detail-value mb-1">{{ $order->address }}</p>
                        <p class="detail-value">{{ $order->city }}, {{ $order->state }} {{ $order->zip_code }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="address-card">
                        <p class="order-detail-row">
                            <span class="detail-label"><i class="fas fa-credit-card me-2"></i>Payment Method:</span><br>
                            <span class="detail-value">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</span>
                        </p>
                        <p class="order-detail-row">
                            <span class="detail-label"><i class="fas fa-money-bill-wave me-2"></i>Total Amount:</span><br>
                            <span class="detail-value">${{ number_format($order->total_amount, 2) }}</span>
                        </p>
                        <p class="mb-0">
                            <span class="detail-label"><i class="fas fa-tasks me-2"></i>Order Status:</span><br>
                            <span class="badge bg-success px-3 py-2 mt-1">{{ ucfirst($order->status) }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <a href="{{ route('cart.show') }}" class="btn action-btn home-btn mt-4">
            <i class="fas fa-home me-2"></i> Continue Shopping
        </a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>