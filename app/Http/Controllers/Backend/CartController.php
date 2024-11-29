<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        // $totalPrice = $cartItems->sum(function ($item) {
        //     return $item->quantity * $item->product->price;
        // });

        // return view('client.cart', compact('cartItems', 'totalPrice'));
        return view('client.cart');
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
        //
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
        // $request->validate([
        //     'quantity' => 'required|integer|min:1',
        // ]);

        // $cartItem = Cart::findOrFail($id);
        // $cartItem->update(['quantity' => $request->quantity]);

        // return redirect()->route('cart.index')->with('success', 'Cập nhật số lượng thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cart::findOrFail($id)->delete();

        // return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xóa');
    }

    public function clear()
    {
        // Cart::where('user_id', auth()->id())->delete();

        // return redirect()->route('cart.index')->with('success', 'Giỏ hàng đã được làm trống');
    }
}
