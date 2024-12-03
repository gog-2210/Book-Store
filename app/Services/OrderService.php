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

    public function query()
    {
        return $this->model->query()->orderBy('created_at', 'desc');
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getAllOrders($request)
    {
        $searchTerm = $request->input('search');
        $orders = $this->model->with(['user'])
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->where('order_status', 'like', "%{$searchTerm}%");
            })
            ->paginate(10);

        return $orders;
    }

    public function getOrderDetail($id)
    {
        $order = $this->model->with(['user', 'orderDetails.book'])->findOrFail($id);
        return $order;
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

    public function updateOrderStatus($id, $status)
    {
        $order = $this->model->findOrFail($id);
        $order->order_status = $status;
        $order->save();
    }

    // public function delete($id)
    // {
    //     return $this->model->where('id', $id)->delete();
    // }

    // public function deleteAll()
    // {
    //     return $this->model->where('user_id', auth()->id())->delete();
    // }
}
