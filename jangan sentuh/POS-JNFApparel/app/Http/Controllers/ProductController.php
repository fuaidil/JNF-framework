<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;

class ProductController extends Controller
{

    public function index()
    {
        $product = Product::all();
        return view('product.dashboard', compact('product'));
    }

    public function dashboard()
    {
        $product = Product::all();
        $category = Category::all();
        $user = User::all();
        $order = Order::all();

        $totalProductsSold = 0;
        $totalRevenue = 0;
    
        foreach ($order as $order) {
            foreach ($order->product_order as $productOrder) {
                $totalProductsSold += $productOrder->amount;
                $totalRevenue += ($productOrder->amount * $productOrder->product->price);
            }
        }
        return view('pages.dashboard', compact('product','category','user','order','totalProductsSold','totalRevenue'));
    }

    // public function catalog()
    // {
    //     $product = Product::all();
    //     return view('pages.catalog', compact('product'));
        
    // }

    public function catalog(Request $request)
    {
        $categories = Category::all();

        $categoryId = $request->input('category');
        $products = Product::when($categoryId, function ($query) use ($categoryId) {
            $query->where('category_id', $categoryId);
        })->get();

        return view('pages.catalog', compact('products', 'categories', 'categoryId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::get();
        return view('product.add', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->image) {

            $fileName = time() . '.' . $request->image->extension();  
            $request->file('image')->storeAs('public/images', $fileName);

            Product::create([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'stock' => $request->stock,
                'price' => $request->price,
                'description' => $request->description,
                'pictures' => $fileName
            ]);
        } else {
            Product::create([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'stock' => $request->stock,
                'price' => $request->price,
                'description' => $request->description,
            ]);
        }
        return redirect(route('product'));            
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($product)
    {
        $product = Product::with('category')->findOrFail($product);
        $category = Category::all();
        return view('product.edit', compact('product', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        if ($request->image) {
            
            $fileName = time() . '.' . $request->image->extension();  
            $request->file('image')->storeAs('public/images', $fileName);

            $product->update([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'stock' => $request->stock,
                'price' => $request->price,
                'description' => $request->description,
                'pictures' => $fileName
            ]);
        } else {
            $product->update([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'stock' => $request->stock,
                'price' => $request->price,
                'description' => $request->description
            ]);
        }
        return redirect()->route('product');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product');
    }
}
