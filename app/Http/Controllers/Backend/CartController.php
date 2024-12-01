<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\StoreCartRequest;
use App\Http\Requests\Cart\UpdateCartRequest;
use App\Services\CartService;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = $this->cartService->getCart();

        return view('client.cart', compact('cart'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request)
    {
        if ($request->input('action') === 'addToCart') {
            $validated = $request->validated();

            $result = $this->cartService->addToCart($validated);

            if ($result) {
                return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng');
            }

            return redirect()->back()->with('error', 'Thêm sản phẩm vào giỏ hàng thất bại');
        }
        $validated = $request->validated();

        $result = $this->cartService->addToCart($validated);

        return redirect()->route('cart');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, string $id)
    {
        $validated = $request->validated();
        $result = $this->cartService->update($validated, $id);

        if (!$result) {
            return redirect()->back()->with('error', 'Cập nhật giỏ hàng thất bại');
        }

        return redirect()->route('cart');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->cartService->delete($id);

        if (!$result) {
            return redirect()->back()->with('error', 'Xóa sản phẩm khỏi giỏ hàng thất bại');
        }

        return redirect()->route('cart');
    }

    public function deleteAll()
    {
        $result = $this->cartService->deleteAll();

        if (!$result) {
            return redirect()->back()->with('error', 'Xóa toàn bộ sản phẩm khỏi giỏ hàng thất bại');
        }

        return redirect()->route('cart');
    }
}
