<footer id="footer" class="mt-5 bg-light py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-4 mb-4">
        <h3>About Us</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean malesuada fringilla sem, at dictum lectus ultricies quis. Etiam eu bibendum orci.</p>
      </div>
      <div class="col-md-4 mb-4">
        <h3>Quick Links</h3>
        <ul class="list-unstyled">
          <li><a href="{{ url('/') }}">Home</a></li>
          <li><a href="{{ url('/products') }}">Products</a></li>
          <li><a href="#">About Us</a></li>
          <li><a href="#">Contact</a></li>
          <li><a href="{{ url('/show_cart') }}">Cart</a></li>
        </ul>
      </div>
      <div class="col-md-4 mb-4">
        <h3>Contact Info</h3>
        <ul class="list-unstyled">
          <li><i class="fa fa-map-marker"></i> 123 Main Street, City, Country</li>
          <li><i class="fa fa-phone"></i> +1 234 567 8901</li>
          <li><i class="fa fa-envelope"></i> info@example.com</li>
        </ul>
        <div class="social-icons">
          <a href="#"><i class="fab fa-facebook"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
    </div>
  </div>
</footer>

<div id="footer-bottom">
  <div class="container">
    <div class="row d-flex flex-wrap justify-content-between">
      <div class="col-md-4 col-sm-6">
        <div class="Shipping d-flex">
          <div class="card-wrap ps-2">
            <img src="{{ asset('images/shippingcard.png') }}" alt="shipping">
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-6">
        <div class="payment-method d-flex">
          <p>Payment options:</p>
          <div class="card-wrap ps-2">
            <img src="{{ asset('images/visa.jpg') }}" alt="visa">
            <img src="{{ asset('images/mastercard.jpg') }}" alt="mastercard">
            <img src="{{ asset('images/paypal.jpg') }}" alt="paypal">
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-6">
        <div class="copyright">
          <p>© Copyright 2025 MiniStore. Design by <a href="https://templatesjungle.com/">TemplatesJungle</a> Distribution by <a href="https://themewagon.com">ThemeWagon</a></p>
        </div>
      </div>
    </div>
  </div>
</div>