<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    function showOrder(){
        $orders = Order::all();
        return view('order.showOrders',['orders'=>$orders]);
    }

    public static function createOrder($validatedData,User $user ,$total ,$loc){
        $order = Order::create([
            'user_id' => $user->id,
            'total_price' => $total,
            'address' => $loc,
            'payment_method' => $validatedData['payment'],
            'phone' => $validatedData['phone'],
            'note' => $validatedData['note'] ?? null,
        ]);
        return $order;
    }

    public static function orderItemCreate($order){
        $cart = session()->get('cart', []);
        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'product_name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }
        session()->forget('cart');
    }
}
