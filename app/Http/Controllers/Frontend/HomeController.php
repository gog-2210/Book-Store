<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\BookService;
use App\Services\CategoryService;
use App\Services\OrderDetailService;
use App\Services\OrderService;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $bookService;
    protected $categoryService;
    protected $orderService;
    protected $orderDetailService;
    protected $paymentService;

    public function __construct(BookService $bookService, CategoryService $categoryService,OrderService $orderService, OrderDetailService $orderDetailService, PaymentService $paymentService)
    {
        $this->bookService = $bookService;
        $this->categoryService = $categoryService;
        $this->orderService = $orderService;
        $this->orderDetailService = $orderDetailService;
        $this->paymentService = $paymentService;
    }


    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        $booksBySuggest = $this->bookService->getBySuggest();
        $categories = $this->categoryService->getAll();

        return view('client.index', compact('booksBySuggest'));
    }

    public function book($bookId)
    {
        $book = $this->bookService->getById($bookId);
        $booksCategory = $this->bookService->getByCategory($book->category_id);
        return view('client.book', compact('book', 'booksCategory'));
    }

    public function category($categoryId)
    {
        return view('client.category');
    }

    public function purchaseOrder()
    {
        $orders = $this->orderService->getByUserId(auth()->id());
        return view('client.purchase-order', compact('orders'));
    }

    public function purchaseOrderDetail($orderId)
    {
        $order = $this->orderService->getById($orderId);
        $orderDetails = $this->orderDetailService->getByOrderId($orderId);
        $totalPrice = $order->payment->amount;
        return view('client.purchase-order-detail', compact('order', 'orderDetails', 'totalPrice'));
    }
}
