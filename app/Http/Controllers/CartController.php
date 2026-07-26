<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Http\controllers\OrderController;
use Illuminate\Support\Facades\DB;
use Faker\Provider\Payment;

class CartController extends Controller
{
    public function subtotal($cart){
        $total = 0;
        foreach($cart as $item ){
            $total += $item['quantity'] *$item['price'];
            }
        return $total;
    }
    public function voucherFirstTime(){
        if (!Auth::check()) {
            return 0;
        }

        return Auth::user()->order->count() === 0 ? 15 : 0;
    }

    public function total($tax,$voucher,$subtotal){
        $taxAmount = ($tax / 100) * $subtotal;
        $discount = ($voucher / 100) * $subtotal;

        return $subtotal + $taxAmount - $discount;
    }
    
    public function show(){
        
        $cart = session()->get('cart', []);
        $subtotal = $this->subtotal($cart);
        $voucherFirstTime = $this->voucherFirstTime();
        $tax = 12;
        // here if we do promo codes more
        $voucher = $voucherFirstTime;
        
        // shipping area
        $shipping = $subtotal > 500 ? 0 : 50;
        
        // here to do total after every thing
        $total = $this->total($tax, $voucher, $subtotal) + $shipping;
        return view('cart.index',['cartItems'=>$cart
        ,'subtotal'=>$subtotal
        ,'tax'=>$tax
        ,'total'=>$total
        ,'voucherFirstTime'=>$voucherFirstTime
        ,'voucher'=>$voucher
        ,'shipping'=>$shipping]);
    }

    public function store(Product $product,Request $req){
        $quantity = $req->input('quantity',1);
        $cart = session()->get('cart', []);
        $currentQuantity = $cart[$product->id]['quantity'] ?? 0;

        if ($currentQuantity + $quantity > $product->quantity) {
            return redirect(url()->previous() . '#featured')
            ->with('error', 'Sorry, there is not enough stock available.');
        }
        $cart[$product->id] = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'image' => $product->image,
            'quantity' => ($cart[$product->id]['quantity'] ?? 0) + $quantity,
        ];
        session()->put('cart', $cart);

        return redirect(url()->previous() . '#featured')
        ->with('success', 'Product added to cart.');
    }
    
    public function decrease(Product $product){
        $cart = session()->get('cart',[]);
        $quan = $cart[$product->id]['quantity'] ?? 0;
        if ($quan == 0) {
            return redirect(url()->previous() . '#featured')
            ->with('error', 'Sorry, you can\'t do low than zero(0)');
        }

        $cart[$product->id] = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'image' => $product->image,
            'quantity' => ($cart[$product->id]['quantity'] ?? 0) - 1,
        ];
        session()->put('cart', $cart);
        return redirect(url()->previous() . '#featured')
        ->with('success', 'Product was dec to cart.');

    }
    public  function remove(Product $product){
        $cart = session()->get('cart',[]);
        unset($cart[$product->id]);
        session()->put("cart",array_values($cart));
        return redirect(url()->previous() . '#featured')
        ->with('success', 'Product was removed.');
    }

    public  function showForm(){
        $cart = session()->get('cart',[]);
        $subtotal = $this->subtotal($cart);
        $voucherFirstTime = $this->voucherFirstTime();
        $tax = 12;
        $voucher = $voucherFirstTime;
        $shipping = $subtotal > 500 ? 0 : 50;
        $total = $this->total($tax, $voucher, $subtotal) + $shipping;
        return view('cart.cartForm',['cartItems'=>$cart,'total'=>$total]);
    }

    public function checkOut($total, Request $req){
        $cart = session()->get('cart',[]);
        $validated = $req->validate([
            'name'    => 'required|min:3|max:50',
            'phone'   => 'required|min:10|max:20',
            'address' => 'required|min:10|max:100',
            'city'    => 'required|min:4|max:100',
            'area'    => 'required|min:4|max:100',
            'payment' => 'required|in:cash,visa',
            ]);
        $loc = $validated['city'] . ', ' . $validated['area'] . ', ' . $validated['address'];
        if(!Auth::check()){
            $user = null;
            }
        else{
            $user = Auth::user();
        }
        DB::transaction(function () use ($validated, $user, $total, $loc) {
            $order = OrderController::createOrder($validated, $user, $total, $loc);
            OrderController::orderItemCreate($order);
            foreach ($order->orderItems as $item) {
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->quantity -= $item->quantity;
                    $product->save();
                }
            }
        });
            // dd($validated);
        return redirect()->route('home')->with('success', 'Order placed successfully!');
    }
}
