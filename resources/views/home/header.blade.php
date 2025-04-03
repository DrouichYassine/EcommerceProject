<header id="header" class="site-header header-scrolled position-fixed text-black bg-light">
  <nav id="header-nav" class="navbar navbar-expand-lg px-3 mb-3">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{ asset('images/main-logo.png') }}" class="logo">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul id="navbar" class="navbar-nav text-uppercase justify-content-end align-items-center flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link me-4 active" href="{{ url('/') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-4" href="#company-services">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-4" href="{{ url('/products') }}">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-4" href="#smart-watches">Watches</a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-4" href="#yearly-sale">Sale</a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-4" href="#latest-blog">Blog</a>
          </li>
          
          <li class="nav-item dropdown">
            <a class="nav-link me-4 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Pages</a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a href="about.html" class="dropdown-item">About</a></li>
              <li><a href="blog.html" class="dropdown-item">Blog</a></li>
              <li><a href="{{ url('/products') }}" class="dropdown-item">Shop</a></li>
              <li><a href="{{ url('/show_cart') }}" class="dropdown-item">Cart</a></li>
              <li><a href="checkout.html" class="dropdown-item">Checkout</a></li>
              <li><a href="single-post.html" class="dropdown-item">Single Post</a></li>
              <li><a href="single-product.html" class="dropdown-item">Single Product</a></li>
              <li><a href="contact.html" class="dropdown-item">Contact</a></li>
            </ul>
          </li>
          
          <!-- Cart first (switched position) -->
          <li class="nav-item">
            <a href="{{ url('/show_cart') }}" class="nav-link me-4">
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
              <span class="pe-1"><i class="fas fa-user"></i></span> Account
            </a>
            <ul class="dropdown-menu" aria-labelledby="accountDropdown">
              <li><a href="{{ url('/account') }}" class="dropdown-item">My Account</a></li>
              @if(Auth::user()->usertype == '1')
              <li><a href="{{ url('/redirect') }}" class="dropdown-item">Admin Dashboard</a></li>
              @endif
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
              <span class="pe-1"><i class="fas fa-user"></i></span> Account
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