<?php

namespace App\Services;

use App\Models\OrderDetail;

class OrderDetailService
{
    protected $model;

    public function __construct(OrderDetail $orderDetail)
    {
        $this->model = $orderDetail;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function getByOrderId($orderId)
    {
        return $this->model->where('order_id', $orderId)->get();
    }

    public function getTotalPrice($orders)
    {
        if (is_numeric($orders)) {
            $orders = collect([$orders]);
        }

        return $this->model
            ->whereIn('order_id', $orders->pluck('id'))
            ->sum(\DB::raw('price * quantity'));
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

    public function deleteByOrderId($orderId)
    {
        return $this->model->where('order_id', $orderId)->delete();
    }
}
