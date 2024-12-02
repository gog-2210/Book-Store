<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Services\BookService;
use App\Services\CategoryService;
use App\Services\CompanyService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    protected $bookService;
    protected $categoryService;
    protected $companyService;


    public function __construct(BookService $bookService, CategoryService $categoryService, CompanyService $companyService)
    {
        $this->bookService = $bookService;
        $this->categoryService = $categoryService;
        $this->companyService = $companyService;

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Lấy tất cả category con
        $categories = $this->categoryService->getCategoriesByParentID(0); // Lấy category con có parent_id khác 0

        // Lọc sách theo các filter được truyền qua request
        $filters = [
            'book_name' => $request->book_name,
            'category_id' => $request->subCategory,
            'author' => $request->author,
        ];

        $books = $this->bookService->getWithFilters($filters);

        return view('admin.books.index', [
            'books' => $books,
            'categories' => $categories,
        ]);
    }
    
    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Lấy danh sách danh mục con từ BookService hoặc CategoryService
        $categories = $this->categoryService->getCategoriesByParentID(0); // Lấy category con có parent_id khác 0
        $companies = $this->companyService->getAll(); // Giả định `getAll()` trả về tất cả công ty
        return view('admin.books.create', compact('categories', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request
        $validatedData = $request->validate([
            'book_name' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'company_id' => 'nullable|exists:companies,id',
            'publishing_house' => 'nullable|string|max:255',
            'publish_date' => 'nullable|date',
            'translator' => 'nullable|string|max:255',
            'number_of_pages' => 'nullable|integer',
            'quantity' => 'required|integer',
            'sold' => 'nullable|integer',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'book_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Gọi service để lưu sách
        $book = $this->bookService->create($validatedData);

        // Kiểm tra nếu thành công
        if ($book) {
            return redirect()->route('admin.books.index')->with('success', 'Sách đã được thêm thành công!');
        } else {
            return redirect()->back()->with('error', 'Không thể tạo sách!');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $book = $this->bookService->getById($id);
        if (!$book) {
            return redirect()->route('admin.books.index')->with('error', 'Sách không tồn tại!');
        }
        
        return view('admin.books.show', compact('book'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $book = $this->bookService->getById($id);
        $categories = $this->categoryService->getCategoriesByParentID(0);  // Lấy tất cả các danh mục
        $companies = $this->companyService->getAll();

        if (!$book) {
            return redirect()->route('admin.books.index')->with('error', 'Sách không tồn tại!');
        }
    
        return view('admin.books.edit', compact('book', 'categories', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        // Validate request
        $validatedData = $request->validate([
            'book_name' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'company_id' => 'nullable|exists:companies,id',
            'publishing_house' => 'nullable|string|max:255',
            'publish_date' => 'nullable|date',
            'translator' => 'nullable|string|max:255',
            'number_of_pages' => 'nullable|integer',
            'quantity' => 'required|integer',
            'sold' => 'nullable|integer',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'book_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Gọi service để cập nhật sách
        $updated = $this->bookService->update($book, $validatedData);

        // Kiểm tra nếu thành công
        if ($updated) {
            return redirect()->route('admin.books.index')->with('success', 'Sách đã được cập nhật thành công!');
        } else {
            return redirect()->back()->with('error', 'Không thể cập nhật sách!');
        }
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $this->bookService->delete($book->id);
        return redirect()->route('admin.books.index')->with('success', 'Sách đã được xóa.');
    }
}
