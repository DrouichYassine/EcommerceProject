<section class="products_section layout_padding">
  <div class="container">
      <div class="heading_container heading_center">
        <h2>Our Products</h2>
      </div>
      <div class="row">
        @foreach ($products as $product)
        <div class="col-sm-6 col-md-4 col-lg-4">
          <div class="product_box">
            <div class="img-box">
              <img src="product/{{$product->image}}" alt="">
              <div class="overlay">
                <div class="options">
                  <a href="javascript:void(0)" onclick="openQuantityModal({{ $product->id }}, '{{ $product->title }}', {{ $product->quantity }})" class="option1">Add to Cart</a>
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

<!-- Quantity Modal -->
<div class="modal fade" id="quantityModal" tabindex="-1" aria-labelledby="quantityModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="quantityModalLabel">Add to Cart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="addToCartForm" action="" method="POST">
        @csrf
        <div class="modal-body">
          <h6 id="productTitle" class="mb-3"></h6>
          <div class="quantity-selector-modal">
            <label for="quantityInput" class="form-label">Select Quantity:</label>
            <div class="d-flex align-items-center">
              <button type="button" class="btn btn-outline-secondary" onclick="decreaseQuantity()">-</button>
              <input type="number" id="quantityInput" name="quantity" class="form-control mx-2" value="1" min="1" max="100">
              <button type="button" class="btn btn-outline-secondary" onclick="increaseQuantity()">+</button>
            </div>
            <div class="text-muted small mt-1">
              <span id="stockInfo"></span>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Add to Cart</button>
        </div>
      </form>
    </div>
  </div>
</div>

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
    font-size: 14px;
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
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
  let quantityModal;
  let maxQuantity = 100;

  document.addEventListener('DOMContentLoaded', function() {
    quantityModal = new bootstrap.Modal(document.getElementById('quantityModal'));
  });
  
  function openQuantityModal(productId, productTitle, stockQuantity) {
    // Set the form action
    const form = document.getElementById('addToCartForm');
    form.action = "{{ url('add_cart') }}/" + productId;
    
    // Set product title and max quantity
    document.getElementById('productTitle').textContent = productTitle;
    
    // Reset quantity to 1
    document.getElementById('quantityInput').value = 1;
    
    // Set max available quantity
    maxQuantity = stockQuantity;
    
    // Show stock information
    document.getElementById('stockInfo').textContent = stockQuantity + ' items available';
    
    // Limit max input to stock quantity
    document.getElementById('quantityInput').setAttribute('max', stockQuantity);
    
    // Show the modal
    quantityModal.show();
  }
  
  function increaseQuantity() {
    const input = document.getElementById('quantityInput');
    const currentValue = parseInt(input.value);
    
    if (currentValue < maxQuantity) {
      input.value = currentValue + 1;
    }
  }
  
  function decreaseQuantity() {
    const input = document.getElementById('quantityInput');
    const currentValue = parseInt(input.value);
    
    if (currentValue > 1) {
      input.value = currentValue - 1;
    }
  }
  
  // Validation to ensure quantity is within bounds
  document.getElementById('quantityInput').addEventListener('change', function() {
    if (this.value < 1) {
      this.value = 1;
    } else if (this.value > maxQuantity) {
      this.value = maxQuantity;
    }
  });
</script>