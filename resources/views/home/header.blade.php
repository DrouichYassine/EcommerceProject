<header id="header" class="site-header header-scrolled position-fixed text-black bg-light">
  <nav id="header-nav" class="navbar navbar-expand-lg px-2 py-2 mb-2">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{ asset('images/MMY Champions.png') }}" class="logo" style="max-height: 40px;">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul id="navbar" class="navbar-nav text-uppercase justify-content-end align-items-center flex-grow-1 pe-2">
          <li class="nav-item">
            <a class="nav-link me-3 active" href="{{ url('/') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-3" href="#company-services">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-3" href="#our-products">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-3" href="#yearly-sale">Sale</a>
          </li>
          <!-- Cart first (switched position) -->
          <li class="nav-item">
            <a href="{{ url('/show_cart') }}" class="nav-link me-2">
              <i class="fas fa-shopping-cart"></i>
              @auth
                @php
                  $cartCount = \App\Models\Cart::where('user_id', Auth::id())->count();
                @endphp
                @if($cartCount > 0)
                  <span class="badge bg-danger">{{ $cartCount }}</span>
                @endif
              @endauth
            </a>
          </li>
          
          <!-- Account second (switched position) -->
          @if (Route::has('login'))
          @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <span class="pe-1"><i class="fas fa-user"></i></span>
            </a>
            <ul class="dropdown-menu" aria-labelledby="accountDropdown">
              @if(Auth::user()->usertype == '1')
              <li><a href="{{ url('/redirect') }}" class="dropdown-item">Admin Dashboard</a></li>
              @endif
              <li><a href="{{ route('profile.show') }}" class="dropdown-item">My Account</a></li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="dropdown-item">Logout</button>
                </form>
              </li>
            </ul>
          </li>
          @else
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="loginDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <span class="pe-1"><i class="fas fa-user"></i></span>
            </a>
            <ul class="dropdown-menu" aria-labelledby="loginDropdown">
              <li><a href="{{ route('login') }}" class="dropdown-item">Login</a></li>
              <li><a href="{{ route('register') }}" class="dropdown-item">Register</a></li>
            </ul>
          </li>
          @endauth
          @endif
        </ul>
      </div>
    </div>
  </nav>
</header>

<style>
.navbar-nav .nav-link {
  font-size: 0.9rem;
  padding-top: 0.4rem;
  padding-bottom: 0.4rem;
}

/* Fix for account dropdown positioning */
.dropdown-menu {
  right: auto;
  left: auto;
  transform: translateX(-60%); /* Increased offset from -40% to -60% */
}

@media (max-width: 992px) {
  .dropdown-menu {
    transform: none;
  }
}

/* Standardize payment method image sizes */
img[src*="paypal.jpg"],
img[src*="mastercard.jpg"] {
  height: auto;
  width: auto;
  max-height: 30px; /* Adjust this value to match visa.jpg height */
  object-fit: contain;
}
</style>

<script>
  // Fix for the continue shopping button to redirect to home page products section
  document.addEventListener('DOMContentLoaded', function() {
    // Find all "Continue Shopping" buttons (both in cart page and elsewhere)
    const continueShoppingButtons = document.querySelectorAll('.cart-actions .btn-primary, .cart-empty .btn-primary');
    
    // Make them redirect to the home page's products section
    continueShoppingButtons.forEach(button => {
      button.addEventListener('click', function(e) {
        e.preventDefault();
        window.location.href = "{{ url('/') }}#featured-products";
      });
    });
  });
</script>