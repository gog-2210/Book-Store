<?php
namespace App\Services;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class BookService
{
    protected $model;

    public function __construct(Book $book)
    {
        $this->model = $book;
    }

    public function search($keyword)
    {
        return $this->model->where('book_name', 'like', '%' . $keyword . '%')->get();
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function getByCategory($category)
    {
        return $this->model->where('category_id', $category)->get();
    }

    public function getByAuthor($author)
    {
        return $this->model->where('author_id', $author)->get();
    }

    public function getByCompany($company)
    {
        return $this->model->where('company_id', $company)->get();
    }

    public function getBySuggest()
    {
        return $this->model->where('suggest', 1)->get();
    }

    public function create(array $data)
    {
        if (isset($data['book_image'])) {
            $data['book_image'] = $data['book_image']->store('book_images', 'public');
        }

        return Book::create($data);
    }

    public function update(Book $book, array $data)
    {
        if (isset($data['book_image'])) {
            if ($book->book_image) {
                Storage::disk('public')->delete($book->book_image);
            }

            $data['book_image'] = $data['book_image']->store('book_images', 'public');
        }

        return $book->update($data);
    }


    public function updateQuantityAndSold($id, $quantity)
    {
        $book = $this->model->where('id', $id)->first();
        $book->quantity -= $quantity;
        $book->sold += $quantity;
        return $book->save();
    }

    public function delete($id)
    {
        return $this->model->where('id', $id)->delete();
    }

    public function getWithFilters($filters = [], $perPage = 10)
    {
        $query = $this->model->query();

        // Lọc theo tên sách
        if (!empty($filters['book_name'])) {
            $query->where('book_name', 'like', '%' . $filters['book_name'] . '%');
        }

         // Lọc theo tên sách
        if (!empty($filters['author'])) {
            $query->where('author', 'like', '%' . $filters['author'] . '%');
        }

        // Lọc theo thể loại cha
        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        // Lọc theo danh mục con
        if (!empty($filters['subcategory_id'])) {
            $query->where('subcategory_id', $filters['subcategory_id']);
        }

        return $query->paginate($perPage);
    }

    public function getSubCategories($parentId)
    {
        return Category::where('parent_id', $parentId)->get();
    }

}
