<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Not Found</title>
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
            margin-top: 20px;
        }
        
        .not-found-container {
            max-width: 600px;
            margin: 80px auto;
            text-align: center;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .not-found-icon {
            font-size: 60px;
            color: var(--primary-color);
            margin-bottom: 20px;
        }
        
        .not-found-title {
            font-size: 28px;
            margin-bottom: 15px;
            color: var(--secondary-color);
        }
        
        .not-found-text {
            color: #6c757d;
            margin-bottom: 30px;
        }
        
        .search-query {
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 10px 25px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background-color: #e63946;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(230, 57, 70, 0.3);
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    @include('home.header')
    
    <div class="main-content">
        <div class="container">
            <div class="not-found-container">
                <div class="not-found-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h1 class="not-found-title">Product Not Found</h1>
                <p class="not-found-text">
                    Sorry, we couldn't find any product matching "<span class="search-query">{{ $search }}</span>".
                </p>
                <div class="buttons">
                    <a href="{{ url('/') }}" class="btn btn-primary me-2">
                        <i class="fas fa-home"></i> Back to Home
                    </a>
                    <a href="#" onclick="history.back()" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Go Back
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer Section -->
    @include('home.footer')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
