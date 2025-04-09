<section class="products_section layout_padding">
  <div class="container">
      <div class="heading_container heading_center " id="our-products">
        <h2>Our Products</h2>
      </div>
      
      <!-- Add Category Filter -->
      <div class="category-filter text-center mb-4">
        <button class="btn btn-outline-dark filter-btn active" data-category="all">All Categories</button>
        @php
            // Get unique categories from products
            $categories = collect($products->items())
                        ->pluck('category')
                        ->unique()
                        ->sort();
        @endphp
        @foreach($categories as $category)
          <button class="btn btn-outline-dark filter-btn" data-category="{{ Str::slug($category) }}">{{ $category }}</button>
        @endforeach
      </div>
      
      <div class="row">
      @foreach ($products as $product)
            <div class="col-sm-6 col-md-4 col-lg-4 product-item" data-category="{{ Str::slug($product->category) }}">
              <div class="product_box">
                <div class="img-box">
                  <img src="product/{{$product->image}}" alt="">
                  <div class="overlay">
                    <div class="options">
                      <a href="javascript:void(0)" onclick="openQuantityModal('{{ $product->id }}', '{{ $product->title }}', '{{ $product->quantity }}')" class="option1">Add to Cart</a>
                      <a href="{{ url('product_details', $product->id) }}" class="option2">View Details</a>
                    </div>
                  </div>
                </div>
                <div class="detail-box">
                  <div class="title-price-row">
                    <div class="product-title">
                      <h5>{{ $product->title }}</h5>
                    </div>
                    <div class="product-price">
                      @if($product->discount_price)
                        <h6>
                          <span class="original-price">${{ $product->price }}</span>
                          <span class="discount-price">${{ $product->discount_price }}</span>
                        </h6>
                      @else
                        <h6>${{ $product->price }}</h6>
                      @endif
                    </div>
                  </div>
                  <div class="product-category">
                    <span class="category-badge">{{ $product->category }}</span>
                  </div>
                  <p class="product-description">
                    {{ \Illuminate\Support\Str::limit($product->description, 100, '...') }}
                  </p>
                </div>
              </div>
            </div>
          @endforeach
      </div>
      
      @if(method_exists($products, 'links'))
        <div class="d-flex justify-content-center mt-4">
          @if(class_exists(\Illuminate\Pagination\AbstractPaginator::class) && method_exists(\Illuminate\Pagination\AbstractPaginator::class, 'useBootstrapFive'))
            {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
          @elseif(class_exists(\Illuminate\Pagination\AbstractPaginator::class) && method_exists(\Illuminate\Pagination\AbstractPaginator::class, 'useBootstrap'))
            {{ $products->withQueryString()->links('pagination::bootstrap-4') }}
          @else
            {{ $products->withQueryString()->links() }}
          @endif
        </div>
      @endif
      
  </div>
</section>

<!-- Quantity Modal (keep existing modal code) -->

<style>
  .product_box {
    border-radius: 10px;
    overflow: hidden;
    background-color: #ffffff;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    margin-bottom: 25px;
    height: 100%;
    transition: transform 0.3s;
  }
  
  .product_box:hover {
    transform: translateY(-5px);
  }
  
  .img-box {
    padding: 15px;
    height: 250px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
  }
  
  .img-box img {
    max-height: 220px;
    object-fit: contain;
    transition: all 0.3s;
  }
  
  .overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.3s ease;
  }
  
  .img-box:hover .overlay {
    opacity: 1;
  }
  
  .img-box:hover img {
    transform: scale(1.05);
  }
  
  .detail-box {
    padding: 15px;
  }
  
  .title-price-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
  }
  
  .product-title {
    flex: 1;
    padding-right: 10px;
  }
  
  .product-title h5 {
    margin: 0;
    font-weight: 500;
  }
  
  .product-price {
    text-align: right;
  }
  
  .original-price {
    text-decoration: line-through;
    color: #999;
    display: block;
  }
  
  .discount-price {
    color: #f00;
    font-weight: bold;
  }
  
  .product-description {
    font-size: 14px;
    color: #777;
    margin-top: 10px;
    height: 60px;
    overflow: hidden;
  }
  .product-category {
  margin: 5px 0;
  font-size: 20px;
  font-weight:600;
  }

.category-badge {
  font-size: 0.8rem;
  text-align: center;
  color: white;
  background-color:black;
  padding: 2px 8px;
  border-radius: 12px;
  display: inline-block;
  width: 100px;
}
  
  .options {
    display: flex;
    flex-direction: column;
    gap: 10px;
    width: 80%;
  }
  
  .option1, .option2 {
    padding: 8px 15px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s;
    text-align: center;
  }
  
  .option1 {
    background-color: #f7444e;
    color: white;
  }
  
  .option1:hover {
    background-color: #ff2c38;
    transform: translateY(-2px);
  }
  
  .option2 {
    background-color: #002c3e;
    color: white;
  }
  
  .option2:hover {
    background-color: #004b6a;
    transform: translateY(-2px);
  }
  .heading_container {
    display: flex;
    justify-content: center;
    margin-bottom: 40px;
  }
  
  .heading_center {
    text-align: center;
  }
  
  .heading_center h2 {
    position: relative;
    font-weight: bold;
    font-size: 2.5rem;
    padding-bottom: 10px;
  }
  
  .heading_center h2::before {
    content: "";
    position: absolute;
    width: 50px;
    height: 3px;
    background-color: #f7444e;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
  }
  .modal-content {
    border-radius: 10px;
    border: none;
  }
  
  .modal-header {
    background-color: #f7444e;
    color: white;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
  }
  
  .btn-close {
    filter: brightness(0) invert(1);
  }
  
  .quantity-selector-modal {
    padding: 10px 0;
  }
  
  .quantity-selector-modal input {
    text-align: center;
    width: 80px;
  }
  
  .btn-primary {
    background-color: #f7444e;
    border-color: #f7444e;
  }
  
  .btn-primary:hover {
    background-color: #e63946;
    border-color: #e63946;
  }
  .category-filter {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
    margin-bottom: 20px;
  }
  
  .filter-btn {
    border-radius: 20px;
    padding: 5px 15px;
    font-size: 14px;
    transition: all 0.3s;
  }
  
  .filter-btn.active {
    background-color: #f7444e;
    color: white;
    border-color: #f7444e;
  }
  
  .filter-btn:hover:not(.active) {
    background-color: #f8f9fa;
  }
  
  .product-item {
    transition: all 0.3s ease;
  }
</style>

<script>
  // Add this to your existing script section
  document.addEventListener('DOMContentLoaded', function() {
    // Category filtering functionality
    const filterButtons = document.querySelectorAll('.filter-btn');
    const productItems = document.querySelectorAll('.product-item');
    
    filterButtons.forEach(button => {
      button.addEventListener('click', function() {
        // Remove active class from all buttons
        filterButtons.forEach(btn => btn.classList.remove('active'));
        // Add active class to clicked button
        this.classList.add('active');
        
        const category = this.dataset.category;
        
        // Filter products
        productItems.forEach(item => {
          if (category === 'all' || item.dataset.category === category) {
            item.style.display = 'block';
          } else {
            item.style.display = 'none';
          }
        });
      });
    });
    
    // Keep your existing modal code
    let quantityModal = new bootstrap.Modal(document.getElementById('quantityModal'));
    window.openQuantityModal = function(productId, productTitle, stockQuantity) {
      // ... keep your existing modal function code ...
    };
  });
  
  // Keep your existing quantity functions
  function increaseQuantity() { /* ... */ }
  function decreaseQuantity() { /* ... */ }
</script>