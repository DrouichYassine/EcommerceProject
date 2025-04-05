<!DOCTYPE html>
<html>
<head>
    <title>My Cart</title>
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
        .cart-section {
            padding: 80px 0;
        }
        .cart-header {
            margin-bottom: 30px;
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
        }
        .cart-empty {
            text-align: center;
            padding: 50px 0;
        }
        .cart-item {
            border-bottom: 1px solid #eee;
            padding: 20px 0;
        }
        .cart-item img {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
        }
        .cart-total {
            font-size: 18px;
            font-weight: 500;
            padding: 20px 0;
            text-align: right;
        }
        .checkout-btn {
            background-color: #f7444e;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
        }
        .checkout-btn:hover {
            background-color: #e63946;
            color: white;
        }
        .cart-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }
        /* Center the continue shopping button in empty cart view */
        .cart-empty .btn-primary {
            display: block;
            margin: 20px auto 0;
            max-width: 200px;
        }
        /* Make buttons more visible */
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 10px 20px;
        }
        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }
    </style>
</head>

<body>
    <!-- Include header -->
    @include('home.header')
    
    <div class="container cart-section">
        <div class="cart-header">
            <h2>My Shopping Cart</h2>
        </div>
        
        @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @if(count($cart) > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $totalAmount = 0; @endphp
                        @foreach($cart as $item)
                            <tr class="cart-item">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="/product/{{ $item->image }}" class="me-3" alt="{{ $item->product_title }}">
                                        <h5>{{ $item->product_title }}</h5>
                                    </div>
                                </td>
                                <td>${{ $item->price / $item->quantity }}</td>
                                <td>
                                    <div class="input-group" style="width: 100px;">
                                        <span class="input-group-text">{{ $item->quantity }}</span>
                                    </div>
                                </td>
                                <td>${{ $item->price }}</td>
                                <td>
                                    <a href="{{ url('remove_cart', $item->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to remove this item?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @php $totalAmount += $item->price; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="cart-total">
                <h4>Total Amount: ${{ $totalAmount }}</h4>
            </div>
            
            <div class="cart-actions">
                <a href="{{ url('/') }}#our-products" class="btn btn-primary">Continue Shopping</a>
                <a href="#" class="btn checkout-btn">Proceed to Checkout</a>
            </div>
        @else
        <div class="cart-empty">
            <h3>Your cart is empty</h3>
            <p>Looks like you haven't added any products to your cart yet.</p>
            <a href="{{ url('/') }}#our-products" class="btn btn-primary mt-3">Continue Shopping</a>
        </div>
        @endif
    </div>
    
    <!-- Include footer -->
    @include('home.footer')
    
    <!-- jQuery and Bootstrap Bundle -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Initialize dropdowns -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize all dropdowns
            var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
            dropdownElementList.forEach(function(dropdownToggleEl) {
                new bootstrap.Dropdown(dropdownToggleEl);
            });
            
            // Make sure "Continue Shopping" buttons redirect to featured products section
            document.querySelectorAll('.cart-empty .btn-primary, .cart-actions .btn-primary').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    window.location.href = "{{ url('/') }}#our-products";
                });
            });
        });
    </script>
</body>
</html>