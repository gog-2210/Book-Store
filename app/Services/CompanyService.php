<?php

namespace App\Services;

use App\Models\Company;

class CompanyService
{
    protected $model;

    public function __construct(Company $company)
    {
        // Khởi tạo model được truyền từ Laravel Service Container
        $this->model = $company;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getAllWithSearchAndPagination($searchTerm = null, $perPage = 10)
    {
        $query = $this->model->query();
    
        if ($searchTerm) {
            $query->where('company_name', 'like', '%' . $searchTerm . '%');
        }
    
        return $query->paginate($perPage);
    }
    

    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        $company = $this->model->findOrFail($id); 
        $company->update($data);
        return $company;
    }

    public function delete($id)
    {
        $company = $this->model->findOrFail($id);
        $company->delete();
        return true;
    }
}
