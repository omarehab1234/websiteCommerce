<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} | Cilantro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/product/view.css') }}">
</head>
<body>
<x-navbar/>

<section class="product-view-section">
    <div class="product-view-grid">

        <div class="product-view-image-col" id ='featured'>
            <div class="product-view-image-wrap">
                <img src="{{ asset('storage/' . $product->image) }}"
                     class="product-view-image"
                     alt="{{ $product->name }}">
                <div class="product-view-fresh-badge">Fresh</div>
            </div>
        </div>

        <div class="product-view-content-col">

            <span class="product-view-category">
                <i class="bi bi-tag-fill"></i> {{ $product->category->name }}
            </span>

            <h1 class="product-view-title">{{ $product->name }}</h1>

            <div class="product-view-price-row">
                <span class="product-view-price">${{ number_format($product->price, 2) }}</span>
                @if($product->quantity <= 5)
                    <span class="product-view-stock product-view-stock-low">
                        <i class="bi bi-exclamation-circle-fill"></i> Only {{ $product->quantity }} left
                    </span>
                @else
                    <span class="product-view-stock product-view-stock-ok">
                        <i class="bi bi-check-circle-fill"></i> In Stock ({{ $product->quantity }})
                    </span>
                @endif
            </div>

            <p class="product-view-description">
                {{ $product->description }}
            </p>

            <div class="product-view-actions">
                <form action="{{ route('cart.add', $product) }}" method="POST" class="product-view-form">
                    @csrf
                    <h5>Quantity</h5>
                    <div class="quantity-selector">
                        <button type="button" class="qty-btn" onclick="minus()">&minus;</button>
                        <input type="number" value="1" min="1" class="qty-input" readonly name='quantity' id="qua">
                        <button type="button" class="qty-btn" onclick="add()">+</button>
                    </div>
                    <button class="btn-add-to-cart">
                        <i class="bi bi-bag-plus"></i> Add to Cart
                    </button>
                </form>
                
                <a href="{{ route('products.show') }}" class="btn-back-ghost">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
            @if(session('error'))
                <p style="color:red">
                    {{ session('error') }}
                </p>
            @endif

        </div>

    </div>
</section>
<script>
function add(){
    let qua = document.getElementById('qua');
    qua.value  = parseInt(qua.value)+1;
}    
function minus(){
    let qua = document.getElementById('qua');
    
    if(! (parseInt(qua.value) <= 1)){
        qua.value  = parseInt(qua.value)-1;
    }
}    
</script>
</body>
</html>