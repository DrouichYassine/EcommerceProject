<!DOCTYPE html>
<html>
  <head>
    <title>MMY Champions</title>
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
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Remix Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    
    <!-- Theme CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('home/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    
    <!-- Custom styles from home.css -->
    <style>
      @font-face {
        font-family: 'LightSport';
        src: url('{{ asset("Fonts/toxigenesis bd.otf") }}') format('opentype');
        font-weight: normal;
        font-style: normal;
        font-display: swap;
      }
      
      /* Fix dropdown styles */
      .dropdown-menu {
        margin-top: 0;
      }
      .dropdown:hover .dropdown-menu {
        display: block;
      }
      
      /* Fix icon display */
      .fa-user, .fa-shopping-cart {
        font-size: 16px;
      }
      
      /* Badge positioning */
      .badge {
        position: relative;
        top: -8px;
        left: -5px;
        font-size: 0.7em;
      }
      
      /* Hero slider styles */
      .hero-slider-container {
        position: relative;
        width: 100%;
        height: 95vh;
        overflow: hidden;
        margin-top: 0;
      }

      .hero-slider {
        display: flex;
        width: 100%;
        height: 100%;
        transition: transform 0.5s ease;
      }

      .hero-slide {
        min-width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
        transition: opacity 0.5s ease;
        display: flex;
        align-items: center;
      }

      .hero-slide.active {
        opacity: 1;
        z-index: 1;
      }

      .hero-slide-content {
        padding: 0 2rem;
        max-width: 50%;
        color: white;
      }

      .hero-slide-content h1 {
        font-size: 3rem;
        font-weight: 500;
        margin-bottom: 1.5rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
      }

      .hero-slide-content p {
        font-size: 1.25rem;
        margin-bottom: 2.5rem;
        line-height: 1.75;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
        max-width: 42rem;
      }

      .hero-slide-content .buttons {
        display: flex;
        flex-direction: column;
      }

      .hero-slide-content .buttons a {
        border: 2px solid white;
        padding: 0.75rem 2rem;
        color: white;
        text-decoration: none;
        transition: background-color 0.3s, color 0.3s;
        font-weight: 500;
        margin-bottom: 1rem;
        text-align: center;
        border-radius: 99999px;
      }

      .hero-slide-content .buttons a:hover {
        background-color: white;
        color: black;
      }

      .nav-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255,255,255,0.3);
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
        transition: all 0.3s ease;
      }

      .nav-arrow:hover {
        background: rgba(255,255,255,0.6);
      }

      .arrow-left {
        left: 20px;
      }

      .arrow-right {
        right: 20px;
      }

      .text-shadow {
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
      }
    
      /* Responsive styles */
      @media (min-width: 640px) {
        .hero-slide-content .buttons {
          flex-direction: row;
          gap: 1.5rem;
        }

        .hero-slide-content .buttons a {
          margin-bottom: 0;
        }
      }

      @media (max-width: 768px) {
        .promo-grid {
          grid-template-columns: 1fr;
        }

        .hero-slide-content {
          max-width: 90%;
          padding: 0 1rem;
        }

        .hero-slide-content h1 {
          font-size: 2.5rem;
        }
      }

      @media (min-width: 768px) {
        .hero-slide-content h1 {
          font-size: 4.5rem;
        }

        .hero-slide-content p {
          font-size: 1.5rem;
        }
      }
      
      @media (max-width: 1366px) {
        .hero-slide-content h1 {
          font-size: 3.5rem;
        }
        
        .promo-card {
          height: 600px;
        }
      }
      
      @media (max-width: 1024px) {
        .hero-slide-content {
          max-width: 60%;
        }
        
        .promo-card {
          height: 500px;
        }
      }
      
      @media (max-width: 480px) {
        .hero-slide-content h1 {
          font-size: 2rem;
        }
        
        .hero-slide-content p {
          font-size: 1rem;
        }
        
        .hero-slider-container {
          height: 50vh;
        }
        
        .promo-card {
          height: 400px;
        }
      }
    </style>
    
    <!-- script -->
    <script src="{{ asset('home/js/modernizr.js') }}"></script>
  </head>
  <body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
    <!-- Include header -->
    @include('home.header')
    
    <!-- Hero Slider Container -->
    <div class="hero-slider-container">
        <!-- Slider Arrows -->
        <div class="nav-arrow arrow-left" onclick="prevSlide()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </div>
        <div class="nav-arrow arrow-right" onclick="nextSlide()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </div>

        <!-- Slides -->
        <div class="hero-slider" id="heroSlider">
            <!-- Slide 1 -->
            <div class="hero-slide" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.4)), url('https://images.unsplash.com/photo-1535914254981-b5012eebbd15?ixlib=rb-1.2.1&auto=format&fit=crop&w=1800&q=80')">
                <div class="hero-slide-content">
                    <h1 class="text-shadow">RECOVER STRONGER</h1>
                    <p class="text-shadow">
                        Premium supplements to rebuild, refuel, and reduce recovery time.
                    </p>
                    <div class="buttons">
                      <a href="#our-products">SHOP NOW</a>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="hero-slide" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.4)), url('https://wallpapers.com/images/hd/football-cleats-corner-arc-6xyoye4hw1zj1cav.webp')">
                <div class="hero-slide-content">
                    <h1 class="text-shadow">PLAY BETTER</h1>
                    <p class="text-shadow">
                        The ultimate expression of speed and power.
                    </p>
                    <div class="buttons">
                        <a href="#our-products">SHOP NOW</a>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="hero-slide" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.4)), url('https://wallpapers.com/images/high/new-balance-background-xrronyyadne48760.webp')">
                <div class="hero-slide-content">
                    <h1 class="text-shadow">TRAINING ESSENTIAL</h1>
                    <p class="text-shadow">
                        Gear that keeps up with your toughest workouts. Sweat-wicking, flexible, and durable.
                    </p>
                    <div class="buttons">
                      <a href="#our-products">SHOP NOW</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Promo Grid -->
    
    <!-- Keep the original content sections -->
    @include('home.services')
    @include('home.products')
    @include('home.yearlysale')
    @include('home.testimonials')
    @include('home.subscribe')
    @include('home.footer')
    
    <div id="footer-bottom">
      <div class="container">
        <div class="row d-flex flex-wrap justify-content-between">
          <div class="col-md-4 col-sm-6">
            <div class="Shipping d-flex">
              <p>We ship with:</p>
              <div class="card-wrap ps-2">
                <img src="{{ asset('images/dhl.png') }}" alt="dhl">
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
              <p>© Copyright 2025 MMY Champions</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Required scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script src="{{ asset('home/js/plugins.js') }}"></script>
    <script src="{{ asset('home/js/script.js') }}"></script>
    
    <!-- Hero Slider Script -->
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        // Initialize Bootstrap dropdowns
        var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
        dropdownElementList.forEach(function (dropdownToggleEl) {
          new bootstrap.Dropdown(dropdownToggleEl);
        });
        
        // Hero slider functionality
        const slides = document.querySelectorAll('.hero-slide');
        let currentSlide = 0;
        
        // Set the first slide as active
        slides[0].classList.add('active');
        
        // Function to change slides
        window.nextSlide = function() {
          slides[currentSlide].classList.remove('active');
          currentSlide = (currentSlide + 1) % slides.length;
          slides[currentSlide].classList.add('active');
        }
        
        window.prevSlide = function() {
          slides[currentSlide].classList.remove('active');
          currentSlide = (currentSlide - 1 + slides.length) % slides.length;
          slides[currentSlide].classList.add('active');
        }
        
        // Auto slide every 5 seconds
        setInterval(nextSlide, 5000);
      });
    </script>
  </body>
</html>