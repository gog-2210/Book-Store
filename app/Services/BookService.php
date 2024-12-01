<?php
namespace App\Services;

use App\Models\Book;


class BookService
{
    protected $model;

    public function __construct(Book $book)
    {
        $this->model = $book;
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

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($data, $id)
    {
        return $this->model->where('id', $id)->update($data);
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
}
