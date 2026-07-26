<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link rel ="stylesheet" href="{{asset('css/cart/checkout.css')}}">
    <title>Checkout | Cilantro</title>
</head>
<body>

<section class="checkout-section container py-5">
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="card shadow-sm border-0 rounded-4 p-4">
        <h3 class="mb-4"><i class="bi bi-person-circle"></i> Delivery Information</h3>
        <form action="{{ route('checkout.store',[$total]) }}" method="POST">
          
            @csrf
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Full Name</label>
              <input name = 'name' type="text" class="form-control" value="{{ old('name',  Auth::check() ? Auth::user()->name : '')  }}">
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Phone Number</label>
              <input name = 'phone' type="text" class="form-control" placeholder="+20 10xxxxxxxx">
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Street Address</label>
            <input name = 'address' type="text" class="form-control" placeholder="Building, Street, Apartment">
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">City</label>
              <input name = 'city' type="text" class="form-control" value="Cairo">
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Area</label>
              <input name = 'area' type="text" class="form-control" placeholder="Nasr City, New Cairo...">
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Notes (Optional)</label>
            <textarea name = 'note' class="form-control" rows="4" placeholder="Extra sugar, call before delivery..."></textarea>
          </div>
          <hr>
          <h5 class="mb-3">Payment Method</h5>
          <div class="form-check mb-2">
            <input name = 'payment' class="form-check-input" type="radio"  value="cash" checked>
            <label class="form-check-label">Cash on Delivery</label>
          </div>
          <div class="form-check mb-4">
            <input name = 'payment' class="form-check-input" type="radio"  value="visa">
            <label class="form-check-label">Visa</label>
          </div>
          <button class="btn btn-warning btn-lg w-100">Place Order</button>
        </form>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card shadow-sm border-0 rounded-4 p-4">
        <h4>Order Summary</h4>
        <hr>
        <div class="d-flex justify-content-between mb-2">
          @foreach(session('cart', []) as $item)
          
              <span>{{ $item['name'] }} × {{ $item['quantity'] }}</span>
          @endforeach
          <strong>${{ number_format($item['price'] * $item['quantity'],2) }}</strong>
        </div>
        
        
        <hr>

        <div class="d-flex justify-content-between">
            <strong>Total</strong>
            <strong>${{ number_format($total,2) }}</strong>
        </div>
    </div>
  </div>
</section>

   
</body>
</html>