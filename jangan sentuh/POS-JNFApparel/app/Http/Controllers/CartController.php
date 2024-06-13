<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->with('cart_item.product')->first();

        return view('pages.cart', compact('cart'));
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
        $user = Auth::user();
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        // Cek apakah keranjang belanja sudah ada untuk pengguna
        $cart = Cart::where('user_id', $user->id)->first();

        // Jika belum ada, buat keranjang baru
        if (!$cart) {
            $cart = Cart::create([
                'user_id' => $user->id,
                'total_product' => 0,
            ]);
        }

        // Cek apakah produk sudah ada di keranjang
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product_id)
            ->first();

        // Jika sudah ada, tambahkan jumlahnya
        if ($cartItem) {
            $cartItem->update([
                'quantity' => $cartItem->quantity + $quantity,
            ]);
        } else {
            // Jika belum ada, buat item baru di keranjang
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product_id,
                'quantity' => $quantity,
            ]);
        }

        // Update total produk di keranjang
        $cart->update([
            'total_product' => $cart->cart_item()->sum('quantity'),
        ]);

        return redirect()->route('cart')->with('success', 'Product added to cart successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }

    public function removeFromCart($cartItemId)
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();

        // Cek apakah item keranjang ditemukan
        $cartItem = CartItem::find($cartItemId);

        if ($cartItem) {
            // Kurangi quantity sebanyak 1
            if ($cartItem->quantity > 1) {
                $cartItem->update([
                    'quantity' => $cartItem->quantity - 1,
                ]);
            } else {
                // Jika quantity tinggal 1, hapus item dari keranjang
                $cartItem->delete();
            }

            // Update total produk di keranjang
            $cart->update([
                'total_product' => $cart->cart_item()->sum('quantity'),
            ]);

            return redirect()->route('cart')->with('success', 'Item removed from cart successfully.');
        }

        return redirect()->route('cart')->with('error', 'Item not found in cart.');
    }
}
