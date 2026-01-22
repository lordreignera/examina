<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'EXAMINA - Laboratory Testing Services')</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('examina log.jpeg') }}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-color: #2196F3;
            --secondary-color: #00BCD4;
            --success-color: #4CAF50;
            --danger-color: #F44336;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 100px 0 80px;
            margin-bottom: 50px;
        }
        
        .hero-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
        }
        
        .hero-subtitle {
            font-size: 1.3rem;
            margin-bottom: 30px;
            opacity: 0.95;
        }
        
        /* Branch Search Filter Styles */
        .search-filter-container {
            animation: slideDown 0.5s ease-out;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .search-filter-container .card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
        }
        
        .search-filter-container .form-select {
            border: 2px solid #e0e0e0;
            transition: all 0.3s;
        }
        
        .search-filter-container .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(33, 150, 243, 0.25);
        }
        
        .test-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            margin-bottom: 30px;
            overflow: visible;
            min-height: 400px;
            display: flex;
            flex-direction: column;
        }
        
        .test-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .test-card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 20px;
            font-size: 1.3rem;
            font-weight: 600;
            flex-shrink: 0;
        }
        
        .test-card .card-body {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        
        .test-info-summary {
            flex-shrink: 0;
        }
        
        .dropdown-menu-custom {
            max-width: 100%;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
            max-height: 500px;
            overflow: hidden;
        }
        
        .dropdown-search {
            background-color: #f8f9fa;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        
        .dropdown-scroll {
            max-height: 400px;
            overflow-y: auto;
            overflow-x: hidden;
        }
        
        .dropdown-scroll::-webkit-scrollbar {
            width: 8px;
        }
        
        .dropdown-scroll::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        .dropdown-scroll::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }
        
        .dropdown-scroll::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        
        .dropdown-item-custom {
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
            cursor: default;
            transition: background-color 0.2s;
        }
        
        .dropdown-item-custom:last-child {
            border-bottom: none;
        }
        
        .dropdown-item-custom:hover {
            background-color: #f8f9fa;
        }
        
        .test-category-preview {
            padding: 12px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            margin-bottom: 10px;
            background: #f8f9fa;
            transition: all 0.2s;
        }
        
        .test-category-preview:hover {
            background: #e9ecef;
            border-color: var(--primary-color);
        }
        
        .all-categories-wrapper {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 10px;
            background: #fff;
        }
        
        .category-search {
            position: sticky;
            top: 0;
            z-index: 10;
            background: white;
        }
        
        .categories-scroll {
            max-height: 300px;
            overflow-y: auto;
            overflow-x: hidden;
            padding-right: 5px;
        }
        
        .categories-scroll::-webkit-scrollbar {
            width: 6px;
        }
        
        .categories-scroll::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }
        
        .categories-scroll::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 3px;
        }
        
        .categories-scroll::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        
        .test-category-item {
            padding: 12px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            margin-bottom: 8px;
            background: #f8f9fa;
            transition: all 0.2s;
        }
        
        .test-category-item:hover {
            background: #e9ecef;
            border-color: var(--primary-color);
        }
        
        .price-badge-small {
            background-color: var(--success-color);
            color: white;
            padding: 3px 10px;
            border-radius: 15px;
            font-weight: 600;
            font-size: 0.75rem;
            white-space: nowrap;
        }
        
        .price-badge {
            background-color: var(--success-color);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            white-space: nowrap;
        }
        
        .btn-add-cart {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 20px;
            transition: all 0.3s;
        }
        
        .btn-add-cart:hover {
            background-color: var(--secondary-color);
            transform: scale(1.05);
        }
        
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: var(--danger-color);
            color: white;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: bold;
        }
        
        .navbar-custom {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .footer {
            background-color: #263238;
            color: white;
            padding: 40px 0 20px;
            margin-top: 80px;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('welcome') }}">
                <img src="{{ asset('examina log.jpeg') }}" alt="EXAMINA Laboratory" style="height: 50px; margin-right: 10px;">
                <span class="text-primary">Laboratory</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('welcome') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tests">Tests</a>
                    </li>
                    <li class="nav-item position-relative me-3">
                        <a class="nav-link" href="{{ route('cart.index') }}">
                            <i class="bi bi-cart3 fs-4"></i>
                            <span class="cart-badge" id="cart-count">0</span>
                        </a>
                    </li>
                    @auth
                        @if(Auth::user()->is_admin)
                            <li class="nav-item">
                                <a class="btn btn-primary btn-sm" href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-speedometer2"></i> Admin Dashboard
                                </a>
                            </li>
                        @endif
                        <li class="nav-item dropdown ms-2">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); this.closest('form').submit();">
                                            Logout
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="btn btn-outline-primary btn-sm me-2" href="{{ route('login') }}">Login</a>
                        </li>
                       <!-- <li class="nav-item">
                            <a class="btn btn-primary btn-sm" href="{{ route('register') }}">Register</a>
                        </li> -->
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                     <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('welcome') }}">
                    <img src="{{ asset('examina log.jpeg') }}" alt="EXAMINA Laboratory" style="height: 50px; margin-right: 10px;">
                    <span class="text-primary">Laboratory</span>
                     </a>
                    <p class="mt-3">Professional laboratory testing services. Know your health status with our comprehensive test packages.</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled mt-3">
                        <li><a href="{{ route('welcome') }}" class="text-white-50 text-decoration-none">Home</a></li>
                        <li><a href="#tests" class="text-white-50 text-decoration-none">Available Tests</a></li>
                        <li><a href="{{ route('cart.index') }}" class="text-white-50 text-decoration-none">Cart</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact Us</h5>
                    <ul class="list-unstyled mt-3">
                        <li><i class="bi bi-telephone"></i> +256 70 567 890</li>
                        <li><i class="bi bi-envelope"></i> examina@labtest.com</li>
                        <li><i class="bi bi-geo-alt"></i> wadegeya-kampala city -Uganda</li>
                    </ul>
                </div>
            </div>
            <hr class="bg-light">
            <div class="text-center">
                <p class="mb-0">&copy; {{ date('Y') }} Lab Test System. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Update cart count from localStorage
        function updateCartCount() {
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            document.getElementById('cart-count').textContent = cart.length;
        }
        
        // Add to cart function
        function addToCart(testId, testName, price, branchId, branchName) {
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            
            // Check if already in cart
            if (cart.find(item => item.id == testId)) {
                alert('This test is already in your cart!');
                return;
            }
            
            cart.push({
                id: testId,
                name: testName,
                price: parseFloat(price),
                branchId: branchId,
                branchName: branchName || 'Any Branch'
            });
            
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
            alert('Test added to cart successfully!');
        }
        
        // Initialize cart count on page load
        document.addEventListener('DOMContentLoaded', updateCartCount);
    </script>
    
    @stack('scripts')
</body>
</html>
