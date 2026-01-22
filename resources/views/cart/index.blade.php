@extends('layouts.landing')

@section('title', 'Schedule Lab Tests - Lab Test System')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4"><i class="bi bi-calendar-check"></i> Your Test Schedule</h2>
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div id="cart-items-container">
                        <p class="text-center text-muted py-5">
                            <i class="bi bi-calendar-x display-1"></i><br>
                            No tests scheduled yet
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-4">Schedule Summary</h5>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Total Items:</span>
                        <strong id="total-items">0</strong>
                    </div>
                    <div id="branch-summary" class="mb-3"></div>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="h5">Total Amount:</span>
                        <strong class="h5 text-success" id="total-amount">UGX 0</strong>
                    </div>
                    <hr>
                    
                    <form id="checkout-form" action="{{ route('cart.checkout') }}" method="POST">
                        @csrf
                        <input type="hidden" name="cart_items" id="cart-items-input">
                        
                        <div class="mb-3">
                            <label for="schedule_date" class="form-label">
                                <i class="bi bi-calendar3"></i> Preferred Test Date *
                            </label>
                            <input type="date" class="form-control" id="schedule_date" name="schedule_date" 
                                   min="{{ date('Y-m-d') }}" required>
                            <small class="text-muted">Select your preferred date for the lab test</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="customer_name" class="form-label">Full Name *</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="customer_email" class="form-label">Email Address *</label>
                            <input type="email" class="form-control" id="customer_email" name="customer_email" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="customer_phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="customer_phone" name="customer_phone">
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 py-2" id="checkout-btn" disabled>
                            <i class="bi bi-check-circle"></i> Schedule Test(s)
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Load and display cart
    function loadCart() {
        const cart = JSON.parse(localStorage.getItem('cart') || '[]');
        const container = document.getElementById('cart-items-container');
        const checkoutBtn = document.getElementById('checkout-btn');
        const cartItemsInput = document.getElementById('cart-items-input');
        
        if (cart.length === 0) {
            container.innerHTML = `
                <p class="text-center text-muted py-5">
                    <i class="bi bi-calendar-x display-1"></i><br>
                    No tests scheduled yet
                </p>
            `;
            checkoutBtn.disabled = true;
            updateSummary(cart);
            return;
        }
        
        let html = '<div class="list-group">';
        cart.forEach((item, index) => {
            html += `
                <div class="list-group-item">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <h6 class="mb-1">${item.name}</h6>
                            <p class="mb-1 text-success fw-bold">UGX ${parseFloat(item.price).toFixed(0)}</p>
                            ${item.branchName ? `<small class="text-muted"><i class="bi bi-building"></i> Branch: ${item.branchName}</small>` : ''}
                        </div>
                        <button class="btn btn-sm btn-danger" onclick="removeFromCart(${index})">
                            <i class="bi bi-trash"></i> Remove
                        </button>
                    </div>
                </div>
            `;
        });
        html += '</div>';
        
        container.innerHTML = html;
        checkoutBtn.disabled = false;
        cartItemsInput.value = JSON.stringify(cart);
        updateSummary(cart);
    }
    
    // Remove item from cart
    function removeFromCart(index) {
        const cart = JSON.parse(localStorage.getItem('cart') || '[]');
        cart.splice(index, 1);
        localStorage.setItem('cart', JSON.stringify(cart));
        loadCart();
        updateCartCount();
    }
    
    // Update summary
    function updateSummary(cart) {
        const totalItems = cart.length;
        const totalAmount = cart.reduce((sum, item) => sum + parseFloat(item.price), 0);
        
        document.getElementById('total-items').textContent = totalItems;
        document.getElementById('total-amount').textContent = 'UGX ' + totalAmount.toFixed(0);
        
        // Group items by branch and display
        const branchGroups = {};
        cart.forEach(item => {
            const branchName = item.branchName || 'Any Branch';
            if (!branchGroups[branchName]) {
                branchGroups[branchName] = {
                    count: 0,
                    amount: 0
                };
            }
            branchGroups[branchName].count++;
            branchGroups[branchName].amount += parseFloat(item.price);
        });
        
        // Display branch summary
        let branchSummaryHtml = '';
        if (Object.keys(branchGroups).length > 0) {
            branchSummaryHtml = '<div class="border rounded p-2 bg-light">';
            branchSummaryHtml += '<small class="text-muted fw-bold">Tests by Branch:</small>';
            for (const [branch, data] of Object.entries(branchGroups)) {
                branchSummaryHtml += `
                    <div class="d-flex justify-content-between align-items-center mt-2 small">
                        <span><i class="bi bi-building"></i> ${branch}</span>
                        <span class="badge bg-primary">${data.count} test(s) - UGX ${data.amount.toFixed(0)}</span>
                    </div>
                `;
            }
            branchSummaryHtml += '</div>';
        }
        document.getElementById('branch-summary').innerHTML = branchSummaryHtml;
    }
    
    // Handle form submission
    document.getElementById('checkout-form').addEventListener('submit', function(e) {
        const cart = JSON.parse(localStorage.getItem('cart') || '[]');
        if (cart.length === 0) {
            e.preventDefault();
            alert('Please select at least one test to schedule!');
            return;
        }
    });
    
    // Load cart on page load
    document.addEventListener('DOMContentLoaded', loadCart);
</script>
@endpush
