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
        /* Previous styles remain the same */
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
        /* Quantity input styling */
        .quantity-input {
            width: 60px;
            text-align: center;
        }
        .quantity-btn {
            width: 30px;
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
        }
        .quantity-btn:hover {
            background-color: #e9ecef;
        }
        .discounted-price {
            color: #f7444e;
            font-weight: bold;
        }
        .original-price {
            text-decoration: line-through;
            color: #999;
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
            <form id="cart-form" action="{{ route('update.cart') }}" method="POST">
                @csrf
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
                                @php
                                    // Determine the actual price to use (discount price if available)
                                    $actualPrice = $item->discount_price ? $item->discount_price : $item->price;
                                    $itemTotal = $actualPrice * $item->quantity;
                                    $totalAmount += $itemTotal;
                                @endphp
                                <tr class="cart-item" data-price="{{ $actualPrice }}">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="/product/{{ $item->image }}" class="me-3" alt="{{ $item->product_title }}">
                                            <h5>{{ $item->product_title }}</h5>
                                        </div>
                                    </td>
                                    <td>
                                        @if($item->discount_price > 0)
                                            <span class="original-price">${{ number_format($item->price, 2) }}</span>
                                            <span class="discounted-price">${{ number_format($item->discount_price, 2) }}</span>
                                        @else
                                            ${{ number_format($item->price, 2) }}
                                        @endif
                                    </td>
                                    <td>
                                        <div class="input-group" style="width: 120px;">
                                            <button type="button" class="quantity-btn minus" data-id="{{ $item->id }}">-</button>
                                            <input type="number" name="quantities[{{ $item->id }}]" value="{{ $item->quantity }}" min="1" class="form-control quantity-input">
                                            <button type="button" class="quantity-btn plus" data-id="{{ $item->id }}">+</button>
                                        </div>
                                    </td>
                                    <td class="item-total">
                                        ${{ number_format($itemTotal, 2) }}
                                    </td>
                                    <td>
                                        <a href="{{ url('remove_cart', $item->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to remove this item?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="cart-total">
                    <h4>Total Amount: $<span id="grand-total">{{ number_format($totalAmount, 2) }}</span></h4>
                </div>
                
                <div class="cart-actions">
                    <a href="{{ url('/') }}#our-products" class="btn btn-primary">Continue Shopping</a>
                    <div>
                        <button type="submit" class="btn btn-secondary me-2">Update Cart</button>
                        <a href="{{ url('/checkout') }}" class="btn checkout-btn">Proceed to Checkout</a>
                    </div>
                </div>
            </form>
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
    
    <script>
       document.addEventListener('DOMContentLoaded', function() {
            // Quantity adjustment buttons
            $('.quantity-btn').on('click', function() {
                const row = $(this).closest('tr');
                const input = row.find('.quantity-input');
                let quantity = parseInt(input.val());
                
                if ($(this).hasClass('minus') && quantity > 1) {
                    input.val(quantity - 1);
                } else if ($(this).hasClass('plus')) {
                    input.val(quantity + 1);
                }
                
                updateRowTotal(row);
            });
            
            $('.quantity-input').on('change', function() {
                if ($(this).val() < 1) $(this).val(1);
                updateRowTotal($(this).closest('tr'));
            });
            
            function updateRowTotal(row) {
                const price = parseFloat(row.data('price')); // This now correctly gets either discount or regular price
                const quantity = parseInt(row.find('.quantity-input').val());
                const total = (price * quantity).toFixed(2);
                
                row.find('.item-total').text('$' + total);
                updateGrandTotal();
            }
            
            function updateGrandTotal() {
                let grandTotal = 0;
                $('.item-total').each(function() {
                    grandTotal += parseFloat($(this).text().replace('$', ''));
                });
                $('#grand-total').text(grandTotal.toFixed(2));
            }
        });
    </script>
</body>
</html>