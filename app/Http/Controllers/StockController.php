<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.stocks.index', compact('products'));
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
        $request->validate([
            'products' => 'required|array',
            'products.*' => 'distinct',
            'quantities' => 'required|array',
            'quantities.*' => 'numeric|min:0',
        ]);

        foreach ($request->input('products') as $key => $productId) {
            $product = Product::findOrFail($productId);
            $quantity = $request->input('quantities')[$key];

            $stock = new Stock([
                'quantity' => $quantity
            ]);

            $product->stock()->save($stock);
        }

        return redirect()->route('stocks.index')->with('success', 'Stocks added successfully.');
    }

    public function fetchStock(Product $product)
    {
        return response()->json(['stock' => $product->stock->quantity ?? 0]);
    }

    public function getProductStock($productId)
{
    $product = Product::findOrFail($productId);
    $currentStock = $product->stock; // Assuming you have a one-to-one relationship between Product and Stock models

    return response()->json(['stock' => $currentStock]);
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
