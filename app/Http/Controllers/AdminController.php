<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    //
    function show(){
        if(!Auth::check() || !Auth::user()->is_admin){
            abort(403);
        }
        else{
            return view("admin.dashboard", [
                "users" => User::count(),
                'products' => Product::count(),
                'categories' => Category::count(),
                'orders' => Order::count(),
            ]);

        }
    }
}
