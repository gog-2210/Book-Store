<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CreateCompanyRequest;
use App\Http\Requests\Company\UpdateCompanyRequest;
use App\Services\CompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    protected $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function index(Request $request)
    {
        // Lấy tham số tìm kiếm từ request
        $searchTerm = $request->input('search');
    
        // Sử dụng service để lấy danh sách công ty với tìm kiếm và phân trang
        $companies = $this->companyService->getAllWithSearchAndPagination($searchTerm);
    
        // Trả view và truyền dữ liệu vào
        return view('admin.companies.index', compact('companies'));
    }
    

    public function show($id)
    {
        // Lấy thông tin công ty theo ID
        $company = $this->companyService->getById($id);
    
        // Trả về view hiển thị chi tiết công ty
        return view('admin.companies.show', compact('company'));
    }
    

    public function create()
    {
        return view('admin.companies.create');
    }

    public function store(CreateCompanyRequest $request)
    {
        $validatedData = $request->validated();
        $this->companyService->create($validatedData);
        return redirect()->route('admin.companies.index')->with('success', 'Company created successfully.');
    }

    public function edit($id)
    {
        $company = $this->companyService->update([], $id); // Gọi hàm từ service
        return view('admin.companies.edit', compact('company'));
    }
    

    public function update(UpdateCompanyRequest $request, $id)
    {
        $validatedData = $request->validated();
        $this->companyService->update($validatedData, $id);
        return redirect()->route('admin.companies.index')->with('success', 'Company updated successfully.');
    }

    public function destroy($id)
    {
        $this->companyService->delete($id);
        return redirect()->route('admin.companies.index')->with('success', 'Company deleted successfully.');
    }
}
