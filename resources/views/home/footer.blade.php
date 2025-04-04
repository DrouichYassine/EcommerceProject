<footer id="footer" class="mt-5 bg-light py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-4 mb-4">
        <h3>About Us</h3>
        <p>Junior developers Who made this website and this is our first fullstuck project</p>
      </div>
      <div class="col-md-4 mb-4">
        <h3>Quick Links</h3>
        <ul class="list-unstyled">
          <li><a href="{{ url('/') }}">Home</a></li>
          <li><a href="#our-products">Products</a></li>
          <li><a href="{{ url('/show_cart') }}">Cart</a></li>
        </ul>
      </div>
      <div class="col-md-4 mb-4">
        <h3>Contact Info</h3>
        <ul class="list-unstyled">
          <li><i class="fa fa-map-marker"></i> Tilila Agadir ,Morocco</li>
          <li><i class="fa fa-phone"></i> +212 6 12 34 56 78</li>
          <li><i class="fa fa-envelope"></i> admin@gmail.com</li>
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
    </div>
  </div>
</div>