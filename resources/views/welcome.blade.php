<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cilantro — Fresh, gourmet, delivered</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>

<body>

<x-navbar />

{{-- ============ HERO ============ --}}
<section class="hero">
    <div class="hero-blob hero-blob--one"></div>
    <div class="hero-blob hero-blob--two"></div>

    <div class="container hero-inner text-center">
        <span class="hero-eyebrow">
            <i class="bi bi-stars"></i> Fresh · Gourmet · Delivered
        </span>

        <h1 class="hero-title">
            Welcome to <span class="hero-title-accent">Cilantro</span>
        </h1>

        <p class="hero-lead">
            Chef-grade produce, herbs and pantry staples sourced from local
            growers — thousands of products at the best prices, delivered to your door.
        </p>

        <div class="hero-actions">
            <a href="#featured" class="btn btn-hero-primary btn-lg">
                <i class="bi bi-bag-heart"></i> Shop Now
            </a>
            <a href="{{ route('contact')}}" class="btn btn-hero-ghost btn-lg">
                Explore Stores <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="hero-stats">
            <div class="hero-stat">
                <span class="hero-stat-num">2k+</span>
                <span class="hero-stat-label">Products</span>
            </div>
            <div class="hero-stat">
                <span class="hero-stat-num">30<small>min</small></span>
                <span class="hero-stat-label">Avg. delivery</span>
            </div>
            <div class="hero-stat">
                <span class="hero-stat-num">4.9<small>★</small></span>
                <span class="hero-stat-label">Rated by 10k+</span>
            </div>
        </div>
    </div>
</section>

{{-- ============ BENEFITS STRIP ============ --}}
<section class="container">
    <div class="benefits">
        <div class="benefit">
            <span class="benefit-icon"><i class="bi bi-truck"></i></span>
            <div>
                <strong>Fast delivery</strong>
                <span>Same-day to your door</span>
            </div>
        </div>
        <div class="benefit">
            <span class="benefit-icon"><i class="bi bi-shield-check"></i></span>
            <div>
                <strong>Quality first</strong>
                <span>Hand-picked, chef-grade</span>
            </div>
        </div>
        <div class="benefit">
            <span class="benefit-icon"><i class="bi bi-arrow-repeat"></i></span>
            <div>
                <strong>Easy returns</strong>
                <span>No questions asked</span>
            </div>
        </div>
    </div>
</section>

{{-- ============ FEATURED PRODUCTS ============ --}}
<section id="featured" class="container products-section">
    <div class="section-head">
        <div>
            <span class="section-kicker">Handpicked for you</span>
            <h2 class="section-title">Featured Products</h2>
        </div>
        <a href="#" class="section-link">View all <i class="bi bi-arrow-right"></i></a>
    </div>

    <div class="row g-4">
        @forelse($products as $product)
            @if($product->quantity != 0)
            <div class="col-6 col-md-4 col-lg-3" id="product-{{$product->id}}">
                <div class="card product-card h-100">
                    <div class="product-media">
                        <img src="{{ asset('storage/' . $product->image) }}"
                             class="card-img-top"
                             loading="lazy"
                             alt="{{ $product->name }}">
                        @if($product->quantity <= 5)
                            <span class="product-badge product-badge--low">
                                Only {{ $product->quantity }} left
                            </span>
                        @else
                            <span class="product-badge">Fresh</span>
                        @endif
                    </div>

                    <div class="card-body d-flex flex-column">
                        <h5 class="product-name">{{ $product->name }}</h5>

                        <p class="product-desc">
                            {{ Str::limit($product->description, 60) }}
                        </p>

                        <div class="product-footer">
                            <span class="product-price">
                                ${{ number_format($product->price, 2) }}
                            </span>
                            
                            <form action="{{ route('cart.add', $product) }}" method="POST">
                                @csrf
                                <button class="btn btn-add" aria-label="Add {{ $product->name }} to cart">
                                    <i class="bi bi-plus-lg"></i>
                                    <span>Add</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @empty
            <div class="col-12">
                <div class="empty-state">
                    <i class="bi bi-basket3"></i>
                    <p>No products available right now. Check back soon!</p>
                </div>
            </div>
        @endforelse
    </div>
</section>
<br>
{{-- ============ CTA BANNER ============ --}}
@auth
    @if(Auth::user()->order->count() == 0)
        <section class="container">
            <div class="cta-banner">
                <div class="cta-blob"></div>
                <div class="cta-content">
                    <h3>Get 15% off your first order</h3>
                    <p>Join the Cilantro club for exclusive deals, seasonal boxes and early access.</p>
                </div>
                <a href="#" class="btn btn-hero-primary btn-lg">
                    <i class="bi bi-envelope-heart"></i> Join now
                </a>
            </div>
        </section>
    @endif
@endauth
{{-- ============ FOOTER ============ --}}
<footer class="site-footer">
    <div class="container footer-inner">
        <span class="footer-brand"><i class="bi bi-flower1"></i> Cilantro</span>
        <p class="footer-copy">© {{ date('Y') }} Cilantro. Fresh, gourmet, delivered.</p>
        <div class="footer-social">
            <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
