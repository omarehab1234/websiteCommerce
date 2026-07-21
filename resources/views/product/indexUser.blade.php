<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | Cilantro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product/show.css') }}">
</head>
<body>
 <x-navbar/>
<section class="products-hero">
  <div class="hero-overlay"></div>
  <div class="hero-content">
    <div class="hero-eyebrow"><i class="bi bi-star-fill"></i> FRESH SELECTION</div>
    <h1>Our Products</h1>
    <p>Chef-grade ingredients sourced from local growers. Discover the finest fresh produce, herbs, and pantry staples.</p>
  </div>
</section>
 
<section class="products-section">
  <div class="container-xl">
    @forelse($products as $product)
    <div class="product-card-wrapper">
      <div class="product-card">
        <div class="product-image-container">
          <img src="{{asset('storage/'. $product->image)}}" class="product-image" alt="Organic Baby Spinach">
            <div class="product-overlay">
            <!-- here form to make the user open main page -->
             <form action="{{route('product.view',$product)}}" method="GET">
                <button class="btn-quick-view"><i class="bi bi-eye"></i> Quick View</button>
             <form>
            </div>
          <div class="product-badge">Fresh</div>
          <div class="product-badge-urgent">Only {{$product->quantity}} left</div>
        </div>
        <div class="product-content">
          <h3 class="product-name">{{$product->name}}</h3>
          <p class="product-description">{{Str::limit($product->description, 60)}}</p>
          <div class="product-rating">
            <div class="stars">
              <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i>
            </div>
            <span class="rating-text">(120 reviews)</span>
          </div>
          <div class="product-price-section">
            <span class="product-price">EGP {{number_format($product->price,2)}}</span>
          </div>
          <form class="product-form" action="{{route('product.view',$product)}}" method="GET">
            
            <button type="submit" class="btn-add-to-cart"><i class="bi bi-bag-plus"></i> Add to Cart</button>
          </form>
          <div class="product-meta">
            <div class="meta-item"><i class="bi bi-lightning-charge-fill"></i> Fast Delivery</div>
            <div class="meta-item"><i class="bi bi-shield-check"></i> Quality Guaranteed</div>
          </div>
        </div>
      </div>
    </div>
    @empty
    @endforelse
    
</section>
 
<section class="cta-banner">
  <h2>Can't find what you're looking for?</h2>
  <p>Contact us for custom orders and bulk requests</p>
  <a href="{{route('contact')}}" class="btn-contact">Get in Touch</a>
</section>
 
</body>
</html>