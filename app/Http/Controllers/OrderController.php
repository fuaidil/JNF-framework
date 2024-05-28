<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\UserOrder;
use App\Models\ProductOrder;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartId = auth()->user()->cart->id;
        $cartItem = CartItem::where('cart_id', $cartId)->get();
        
        if ($cartItem->isNotEmpty()) {
            $totalQuantity = $cartItem->sum('quantity');
            $totalPrice = $cartItem->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });
    
            return view('pages.checkout', compact('cartItem', 'totalQuantity', 'totalPrice'));
        } else {
            return redirect()->route('cart')->with('error', 'Your cart is empty. Cannot proceed with checkout.');
        }
    }

    public function order()
    {
        $user = Auth::user();
        $orders = Order::with('user_order', 'product_order.product')
        ->whereHas('user_order', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        return view('pages.order', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cartId = auth()->user()->cart->id;
        $cartItem = CartItem::where('cart_id', $cartId)->get();

        if ($cartItem->isNotEmpty()) {
            $totalPrice = $cartItem->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });

            $order = Order::create([
                'order_address' => $request->address, 
                'order_date' => now(),
                'total_price' => $totalPrice,
            ]);

            foreach ($cartItem as $cartItem) {
                UserOrder::create([
                    'user_id' => $request->user()->id,
                    'order_id' => $order->id,
                    'order_at' => now(),
                ]);

                ProductOrder::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product->id,
                    'amount' => $cartItem->quantity,
                ]);
                $cartItem->product->decrement('stock', $cartItem->quantity);
            }

            CartItem::where('cart_id', $cartId)->delete();
            auth()->user()->cart->delete();

            return redirect()->route('order');
        }
        return redirect()->route('cart')->with('error', 'Your cart is empty. Cannot proceed with checkout.');
    }

    /**
     * Display the specified resource.
     */
    
    public function sales()
    {
        $orders = Order::with('user_order', 'product_order')->get();

        return view('pages.sales', compact('orders'));
    }

    public function showSales(Order $order)
    {
        $order->load('user_order', 'product_order');

        return view('pages.detailSales', compact('order'));
    }

    /**
     * Show the form for edistting the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
