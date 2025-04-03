<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->title }} - Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #f7444e;
            --secondary-color: #002c3e;
            --text-color: #212529;
            --light-bg: #f8f9fa;
            --border-color: #e1e1e1;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: var(--text-color);
            margin: 0;
            padding: 0;
        }
        
        /* Header Fix Styles */
        header {
            position: relative !important;
            width: 100%;
            z-index: 1000;
        }
        
        .site-header {
            position: static !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .main-content {
            margin-top: 20px; /* Adjust based on your header height */
        }
        /* End Header Fix */
        
        .breadcrumb-section {
            background-color: var(--light-bg);
            padding: 20px 0;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 40px;
        }
        
        .breadcrumb {
            margin-bottom: 0;
        }
        
        .product-section {
            padding: 40px 0 80px;
        }
        
        .product-img-container {
            position: relative;
            text-align: center;
            margin-bottom: 30px;
            overflow: hidden;
            border-radius: 8px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .product-img {
            max-width: 100%;
            max-height: 400px;
            object-fit: contain;
            transition: transform 0.5s ease;
        }
        
        .product-img:hover {
            transform: scale(1.05);
        }
        
        .product-detail-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .product-title {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--secondary-color);
        }
        
        .product-description {
            color: #6c757d;
            margin-bottom: 25px;
            line-height: 1.7;
        }
        
        .price-container {
            display: flex;
            align-items: baseline;
            margin-bottom: 25px;
        }
        
        .current-price {
            font-size: 28px;
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .original-price {
            font-size: 18px;
            text-decoration: line-through;
            color: #6c757d;
            margin-left: 15px;
        }
        
        .discount-badge {
            background-color: var(--primary-color);
            color: white;
            font-size: 14px;
            padding: 3px 10px;
            border-radius: 30px;
            margin-left: 15px;
        }
        
        .product-meta {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border-color);
        }
        
        .quantity-selector {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .quantity-btn {
            border: 1px solid var(--border-color);
            width: 40px;
            height: 40px;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            transition: all 0.3s;
            cursor: pointer;
        }
        
        .quantity-btn:hover {
            background-color: var(--light-bg);
        }
        
        .quantity-input {
            width: 60px;
            height: 40px;
            text-align: center;
            border: 1px solid var(--border-color);
            border-left: none;
            border-right: none;
        }
        
        .add-to-cart-btn {
            background-color: var(--primary-color);
            border: none;
            color: white;
            padding: 12px 35px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 5px;
            transition: all 0.3s;
            margin-top: 20px;
            display: inline-block;
            text-decoration: none;
        }
        
        .add-to-cart-btn:hover {
            background-color: #e63946;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(230, 57, 70, 0.3);
            color: white;
            text-decoration: none;
        }
        
        .category-tag {
            display: inline-block;
            background-color: var(--light-bg);
            padding: 5px 15px;
            border-radius: 30px;
            font-size: 14px;
            margin-bottom: 10px;
        }
        
        .stock-status {
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        .in-stock {
            color: #28a745;
        }
        
        .out-of-stock {
            color: #dc3545;
        }

        .return-link {
            color: var(--primary-color);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .return-link i {
            margin-right: 5px;
        }

        .return-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .product-section {
                padding: 20px 0 40px;
            }
            
            .product-title {
                font-size: 24px;
            }
            
            .current-price {
                font-size: 24px;
            }
            
            .product-detail-container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    @include('home.header')
    
    <div class="main-content">
        <!-- Breadcrumb Section -->
        <div class="breadcrumb-section">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/products') }}">Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $product->title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        
        <!-- Product Detail Section -->
        <section class="product-section">
            <div class="container">
                <a href="{{ url('/products') }}" class="return-link">
                    <i class="fas fa-arrow-left"></i> Back to Products
                </a>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-img-container">
                            <img src="/product/{{ $product->image }}" alt="{{ $product->title }}" class="product-img">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="product-detail-container">
                            <span class="category-tag">{{ $product->category }}</span>
                            <h1 class="product-title">{{ $product->title }}</h1>
                            
                            <div class="price-container">
                                @if($product->discount_price)
                                    <span class="current-price">${{ $product->discount_price }}</span>
                                    <span class="original-price">${{ $product->price }}</span>
                                    @php
                                        $discount = (($product->price - $product->discount_price) / $product->price) * 100;
                                    @endphp
                                    <span class="discount-badge">{{ round($discount) }}% OFF</span>
                                @else
                                    <span class="current-price">${{ $product->price }}</span>
                                @endif
                            </div>
                            
                            <div class="stock-status {{ $product->quantity > 0 ? 'in-stock' : 'out-of-stock' }}">
                                {{ $product->quantity > 0 ? 'In Stock' : 'Out of Stock' }}
                            </div>
                            
                            <div class="product-description">
                                {{ $product->description }}
                            </div>
                            
                            <form action="{{ url('add_cart', $product->id) }}" method="POST">
                                @csrf
                                <div class="quantity-selector">
                                    <div class="quantity-btn minus-btn" onclick="decrementQuantity()">-</div>
                                    <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->quantity }}" class="quantity-input">
                                    <div class="quantity-btn plus-btn" onclick="incrementQuantity()">+</div>
                                </div>
                                
                                <button type="submit" class="add-to-cart-btn">
                                    <i class="fas fa-shopping-cart"></i> Add to Cart
                                </button>
                            </form>
                            
                            <div class="product-meta">
                                <p><strong>SKU:</strong> PROD-{{ $product->id }}</p>
                                <p><strong>Category:</strong> {{ $product->category }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    <!-- Footer Section -->
    @include('home.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function incrementQuantity() {
            const input = document.getElementById('quantity');
            const max = parseInt(input.getAttribute('max'));
            const currentValue = parseInt(input.value);
            
            if (currentValue < max) {
                input.value = currentValue + 1;
            }
        }
        
        function decrementQuantity() {
            const input = document.getElementById('quantity');
            const currentValue = parseInt(input.value);
            
            if (currentValue > 1) {
                input.value = currentValue - 1;
            }
        }
    </script>
</body>
</html>