<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Lấy tham số tìm kiếm từ request
        $searchTerm = $request->input('search');

        // Sử dụng service để lấy danh sách categories với tìm kiếm và phân trang
        $categories = $this->categoryService->getAllWithSearchAndPagination($searchTerm);

        // Trả view và truyền dữ liệu vào
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parentCategories = $this->categoryService->getByParentId(0); // Lấy các danh mục cha
        return view('admin.categories.create', compact('parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoryRequest $request)
    {
        $validated = $request->validated();
        $this->categoryService->create($validated); // Sử dụng service để tạo danh mục mới

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = $this->categoryService->getById($id); // Lấy danh mục theo ID
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = $this->categoryService->getById($id); // Lấy danh mục để chỉnh sửa
        $parentCategories = $this->categoryService->getByParentId(0); // Lấy danh mục cha
        return view('admin.categories.edit', compact('category', 'parentCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $validated = $request->validated();
        $this->categoryService->update($validated, $id); // Sử dụng service để cập nhật danh mục

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->categoryService->delete($id); // Sử dụng service để xóa danh mục
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }

    public function getSubCategories(Request $request)
    {
        $subCategories = $this->categoryService->getSubCategories($request->parent_id);
        return response()->json($subCategories);
    }

}
