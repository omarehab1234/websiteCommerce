<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart — Cilantro</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/cart/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    
</head>
<body>

<x-navbar />


<div class="cart-wrapper">
  <!-- Hero Section -->
  <section class="cart-hero">
    <div class="cart-hero-content">
      <div class="cart-hero-left">
        <span class="cart-eyebrow">Your Shopping Cart</span>
        <h1 class="cart-hero-title">Complete Your Order</h1>
        <p class="cart-hero-subtitle">Fresh, gourmet groceries ready to ship</p>
        <div class="cart-hero-stats">
          <div class="stat-card">
            <span class="stat-value">{{ count($cartItems) }}</span>
            <span class="stat-label">Items</span>
          </div>
          <div class="stat-card">
            <span class="stat-value">${{ number_format($total ?? 0, 2) }}</span>
            <span class="stat-label">Total</span>
          </div>
        </div>
      </div>
      <div class="cart-hero-image">
        <img src="{{ asset('storage/products/cilantro-coffe.png') }}" alt="Fresh produce" />
      </div>
    </div>
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
  </section>

  <!-- Marquee Ticker -->
  <section class="marquee-section">
    <div class="marquee-track">
      <span class="marquee-item">Free shipping on orders over $50</span>
      <span class="marquee-item">Farm Fresh · Chef Grade · Locally Sourced</span>
      <span class="marquee-item">Free shipping on orders over $50</span>
      <span class="marquee-item">Farm Fresh · Chef Grade · Locally Sourced</span>
    </div>
  </section>

  <div class="cart-container">
    <!-- Cart Items -->
    <section class="cart-items" id ='featured'>
      <h2 class="section-title">Items in Cart</h2>

      @forelse($cartItems as $product)
        <div class="cart-item" data-item-id="{{ $product['id'] ?? $loop->index }}" id="product-{{ $product['id'] }}">
          <div class="cart-item-image">
            <img src="{{asset('storage/'.$product['image']) }}" alt="{{ $product['name'] ?? 'Product' }}" />
          </div>
          <div class="cart-item-details">
            <h3 class="cart-item-name">{{ $product['name'] ?? 'Product' }}</h3>
            <p class="cart-item-description">{{ substr($product['description'] ?? 'Premium gourmet item', 0, 60) }}...</p>
            <div class="cart-item-meta">
              <span class="cart-item-price">${{ number_format($product['price'] ?? 0, 2) }}</span>
              @if($product['quantity'] ?? false)
                <span class="cart-item-qty">Qty: {{ $product['quantity'] }}</span>
              @endif
            </div>
          </div>
          <div class="cart-item-actions">
            <div class="quantity-selector">
            <form action="{{route('cart.dec',$product['id'])}}" method="POST">
                @csrf
                <button class="qty-btn" data-action="decrease">−</button>
            </form>

              <input type="number" class="qty-input" readonly value="{{ $product['quantity'] ?? 1 }}" min="1" />
                <form action="{{ route('cart.add', $product['id']) }}" method="POST">
                    @csrf
                    <button type="submit" class="qty-btn">+</button>
                </form>

            </div>
              <form action="{{ route('cart.remove', $product['id']) }}" method="POST">
                    @csrf
                    <button class="remove-btn" data-action="remove">Remove</button>
              </form>
          </div>
        </div>
      @empty
        <div class="empty-cart">
          <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <circle cx="9" cy="21" r="1"></circle>
            <circle cx="20" cy="21" r="1"></circle>
            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
          </svg>
          <h3>Your cart is empty</h3>
          <p>Explore our fresh, gourmet selection and add items to get started.</p>
          <a href="{{route('products.show')}}" class="btn-primary">Continue Shopping</a>
        </div>
      @endforelse
      @if(session('error'))
          <p style="color:red">
              {{ session('error') }}
          </p>
      @endif
    </section>

    <!-- Order Summary -->
    <aside class="order-summary">
      <div class="summary-card">
        <h3 class="summary-title">Order Summary</h3>

        <div class="summary-row">
          <span>Subtotal</span>
          <span>${{ number_format($subtotal ?? 0, 2) }}</span>
        </div>

        <div class="summary-row">
          <span>Shipping</span>
          <span class="shipping-cost">
            @if(($subtotal ?? 0) >= 500)
              <span class="free">FREE</span>
            @else
              ${{$shipping}}
            @endif
          </span>
        </div>

        <div class="summary-row">
          <span>Tax</span>
          <span>{{ $tax  }}%</span>
        </div>
        @if($voucherFirstTime ?? false)
            <div class="summary-row">
                <span>Voucher for first time</span>
                <span>{{$voucherFirstTime}}%</span>
            </div>

        @endif
        <div class="summary-divider"></div>

        <div class="summary-row summary-total">
          <span>Total</span>
            <span class="total-amount">${{ number_format(($total) ?? 0, 2) }}</span>
        </div>
        <form action = "{{route('cart.done')}}" method ='POST'>
            @csrf
            <button class="btn-checkout">
            <span>Proceed to Checkout</span>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
            </button>
        </form>
<!-- here we need form -->
        <button class="btn-continue-shopping">Continue Shopping</button>

        <div class="promo-section">
          <input type="text" class="promo-input" placeholder="Enter promo code" name="voucher"/>
          <button class="btn-apply">Apply</button>
        </div>
      </div>

      <!-- Trust Badges -->
      <div class="trust-badges">
        <div class="badge">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
          </svg>
          <span>Secure Payment</span>
        </div>
        <div class="badge">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M5 12h14"></path>
            <path d="M12 5v14"></path>
          </svg>
          <span>Easy Returns</span>
        </div>
        <div class="badge">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="12 6 12 12 16 14"></polyline>
          </svg>
          <span>Fast Delivery</span>
        </div>
      </div>
    </aside>
  </div>

  <!-- Related Products -->
  <!-- <section class="related-products">
    <h2 class="section-title">Complete Your Order</h2>
    <div class="product-grid">
      @forelse($relatedProducts ?? [] as $product)
        <div class="product-card">
          <div class="product-image">
            <img src="{{ $product->image ?? asset('images/product-placeholder.png') }}" alt="{{ $product->name ?? 'Product' }}" />
            <span class="product-badge">Popular</span>
          </div>
          <div class="product-info">
            <h4 class="product-name">{{ substr($product->name ?? 'Product', 0, 30) }}</h4>
            <div class="product-rating">
              <span class="stars">★★★★★</span>
              <span class="rating-count">({{ rand(10, 200) }})</span>
            </div>
            <div class="product-footer">
              <span class="product-price">${{ number_format($product->price ?? 0, 2) }}</span>
              <button class="btn-add">+</button>
            </div>
          </div>
        </div> -->
      <!-- @empty
      @endforelse -->
    <!-- </div> -->
  <!-- </section> -->
</div>
</body>
</html>
</html>