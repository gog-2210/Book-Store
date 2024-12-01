<?php

namespace App\Services;

use App\Models\Order;

class OrderService
{
    protected $model;

    public function __construct(Order $order)
    {
        $this->model = $order;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function getByUserId($user)
    {
        return $this->model->where('user_id', $user)->get();
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

    public function deleteAll()
    {
        return $this->model->where('user_id', auth()->id())->delete();
    }
}
