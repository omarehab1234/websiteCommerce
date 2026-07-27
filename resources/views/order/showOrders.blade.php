<!-- Order admin Index -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders | Cilantro Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel ='stylesheet' href="{{asset('css/product/index.css')}}">
</head>
<div class="d-flex justify-content-between align-items-center mb-4" >

        <h2 class="fw-bold">Orders</h2>

        <div>

            <a href="{{ route('admin') }}"
            class="btn btn-outline-dark me-2">
                ← Dashboard
            </a>

        </div>

    </div>
@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10" >
    <tr>
        <th>ID</th>
        <th>User-Name</th>
        <th>Total</th>
        <th>status</th>
        <th>payment-method</th>
        <th>payment-status</th>
        <th>phone</th>
        <th>location</th>
        <th>Actions</th>
    </tr>

    @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->user->name }}</td>
            <td>{{ $order->total_price }}EGP</td>
            <td>
                <select name="status"  value ="{{ $order->status }}">
                    <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Processing" {{ $order->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                    <option value="Shipped" {{ $order->status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="Delivered" {{ $order->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="Cancelled" {{ $order->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </td>
            <td>
                <select name="payment_method">
                    <option value="Cash" {{ $order->payment_method == 'Cash' ? 'selected' : '' }}>Cash</option>
                    <option value="Card" {{ $order->payment_method == 'Card' ? 'selected' : '' }}>Card</option>
                </select>
            </td>

            <td>
                <select name="payment_status">
                    <option value="Pending" {{ $order->payment_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Paid" {{ $order->payment_status == 'Paid' ? 'selected' : '' }}>Paid</option>
                    <option value="Failed" {{ $order->payment_status == 'Failed' ? 'selected' : '' }}>Failed</option>
                    <option value="Refunded" {{ $order->payment_status == 'Refunded' ? 'selected' : '' }}>Refunded</option>
                </select>
            </td>
            <td>{{ $order->phone }}</td>
            <td>{{Str::limit( $order->address,30) }}</td>
            <td>
                
                <form action="{{ route('orders.update', $order) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- status select -->
                    <!-- payment status select -->

                    <button class="btn btn-success btn-sm">
                        Save
                    </button>
                </form>
                <form action="{{ route('orders.destroy', $order) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>