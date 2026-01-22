<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - EXAMINA Laboratory</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-color: #2196F3;
            --secondary-color: #00BCD4;
            --success-color: #4CAF50;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .register-container {
            max-width: 1000px;
            width: 100%;
        }
        
        .register-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }
        
        .register-left {
            background: linear-gradient(135deg, var(--success-color) 0%, #43A047 100%);
            color: white;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        
        .register-left::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: pulse 15s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        
        .register-left-content {
            position: relative;
            z-index: 1;
        }
        
        .register-icon {
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
            backdrop-filter: blur(10px);
        }
        
        .register-icon i {
            font-size: 50px;
        }
        
        .register-right {
            padding: 60px 50px;
        }
        
        .register-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: #333;
        }
        
        .register-subtitle {
            color: #666;
            margin-bottom: 40px;
        }
        
        .form-control {
            height: 50px;
            border-radius: 10px;
            border: 2px solid #e0e0e0;
            padding: 0 20px;
            font-size: 15px;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--success-color);
            box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.15);
        }
        
        .input-group-text {
            background: transparent;
            border: 2px solid #e0e0e0;
            border-right: none;
            border-radius: 10px 0 0 10px;
            padding: 0 15px;
        }
        
        .input-group .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }
        
        .input-group:focus-within .input-group-text,
        .input-group:focus-within .form-control {
            border-color: var(--success-color);
        }
        
        .btn-register {
            height: 50px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--success-color) 0%, #43A047 100%);
            border: none;
            color: white;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
        }
        
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(76, 175, 80, 0.4);
        }
        
        .form-check-input:checked {
            background-color: var(--success-color);
            border-color: var(--success-color);
        }
        
        .login-link {
            text-align: center;
            margin-top: 30px;
            color: #666;
        }
        
        .login-link a {
            color: var(--success-color);
            text-decoration: none;
            font-weight: 600;
        }
        
        .login-link a:hover {
            color: #43A047;
        }
        
        .alert {
            border-radius: 10px;
            border: none;
        }
        
        .benefit-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .benefit-icon {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }
        
        @media (max-width: 768px) {
            .register-left {
                padding: 40px 30px;
            }
            
            .register-right {
                padding: 40px 30px;
            }
            
            .register-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <div class="row g-0">
                <!-- Left Side - Branding -->
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="register-left">
                        <div class="register-left-content">
                            <div class="register-icon" style="width: 150px; height: 150px; background: white; border-radius: 15px; padding: 15px;">
                                <img src="{{ asset('examina log.jpeg') }}" alt="EXAMINA Laboratory" style="width: 100%; height: 100%; object-fit: contain;">
                            </div>
                            <h2 class="fw-bold mb-3 mt-4">Join EXAMINA Laboratory!</h2>
                            <p class="mb-4">Create your account and get access to our comprehensive laboratory testing services.</p>
                            
                            <div class="benefit-item">
                                <div class="benefit-icon">
                                    <i class="bi bi-check-circle"></i>
                                </div>
                                <div>
                                    <strong>Easy Scheduling</strong><br>
                                    <small>Book tests online anytime</small>
                                </div>
                            </div>
                            
                            <div class="benefit-item">
                                <div class="benefit-icon">
                                    <i class="bi bi-file-earmark-medical"></i>
                                </div>
                                <div>
                                    <strong>Digital Results</strong><br>
                                    <small>Access reports instantly</small>
                                </div>
                            </div>
                            
                            <div class="benefit-item">
                                <div class="benefit-icon">
                                    <i class="bi bi-graph-up"></i>
                                </div>
                                <div>
                                    <strong>Health Tracking</strong><br>
                                    <small>Monitor your health journey</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Side - Register Form -->
                <div class="col-lg-7">
                    <div class="register-right">
                        <div class="text-center mb-4 d-lg-none">
                            <h3 class="text-success"><i class="bi bi-heart-pulse"></i> Lab Test System</h3>
                        </div>
                        
                        <h1 class="register-title">Create Account</h1>
                        <p class="register-subtitle">Sign up to get started</p>
                        
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                                <strong>Oops!</strong>
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Full Name</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <input type="text" 
                                           class="form-control" 
                                           name="name" 
                                           value="{{ old('name') }}"
                                           placeholder="Enter your full name"
                                           required 
                                           autofocus 
                                           autocomplete="name">
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input type="email" 
                                           class="form-control" 
                                           name="email" 
                                           value="{{ old('email') }}"
                                           placeholder="Enter your email"
                                           required 
                                           autocomplete="username">
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input type="password" 
                                           class="form-control" 
                                           name="password" 
                                           placeholder="Create a password"
                                           required 
                                           autocomplete="new-password">
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock-fill"></i>
                                    </span>
                                    <input type="password" 
                                           class="form-control" 
                                           name="password_confirmation" 
                                           placeholder="Confirm your password"
                                           required 
                                           autocomplete="new-password">
                                </div>
                            </div>
                            
                            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                <div class="mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
                                        <label class="form-check-label" for="terms">
                                            I agree to the 
                                            <a href="{{ route('terms.show') }}" target="_blank" class="text-success">Terms of Service</a> 
                                            and 
                                            <a href="{{ route('policy.show') }}" target="_blank" class="text-success">Privacy Policy</a>
                                        </label>
                                    </div>
                                </div>
                            @endif
                            
                            <button type="submit" class="btn btn-register w-100">
                                <i class="bi bi-person-plus"></i> Create Account
                            </button>
                        </form>
                        
                        <div class="login-link">
                            Already have an account? <a href="{{ route('login') }}">Login here</a>
                        </div>
                        
                        <div class="text-center mt-4">
                            <a href="{{ route('welcome') }}" class="text-muted text-decoration-none">
                                <i class="bi bi-arrow-left"></i> Back to Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
