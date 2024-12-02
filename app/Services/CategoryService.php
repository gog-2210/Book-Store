<?php
namespace App\Services;

use App\Models\Category;

class CategoryService
{
    protected $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getAllWithSearchAndPagination($searchTerm = null, $perPage = 10)
    {
        $query = $this->model->query();

        if ($searchTerm) {
            $query->where('category_name', 'like', '%' . $searchTerm . '%');
        }

        return $query->paginate($perPage); 
    }

    public function getById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function getByParentId($parentId)
    {
        return $this->model->where('parent_id', $parentId)->get();
    }

    public function getByParentIdAndOrder($parentId, $order)
    {
        return $this->model->where('parent_id', $parentId)->where('order', $order)->get();
    }

    public function getCategoriesByParentID($parentId)
    {
        return $this->model->where('parent_id', '!=', 0)->get();
    }

    
    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($data, $id)
    {
        return $this->model->where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->model->where('id', $id)->delete();
    }

    public function getSubCategories($parentId)
    {
        return $this->model->where('parent_id', $parentId)->get();
    }

    // Lấy danh sách category cha
    public function getParentCategories()
    {
        return $this->model->where('parent_id', 0)->get();
    }



}
