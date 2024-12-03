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
    public function getAllOrdersWithSearchAndPagination($search = null, $pagination = 10)
    {
        $query = $this->model->query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nameReceiver', 'LIKE', "%$search%")
                  ->orWhere('phoneReceiver', 'LIKE', "%$search%")
                  ->orWhere('order_status', 'LIKE', "%$search%");
            });
        }

        return $query->paginate($pagination);
    }

    /**
     * Lấy chi tiết đơn hàng
     */
    public function getOrderById($id)
    {
        return $this->model->with(['user', 'payment', 'orderDetails'])->findOrFail($id);
    }

    /**
     * Cập nhật thông tin giao hàng (shipping_address, nameReceiver, phoneReceiver, shipping_fee)
     */
    public function updateShippingInfo($orderId, array $shippingData)
    {
        $order = $this->model->findOrFail($orderId);

        $order->update([
            'shipping_address' => $shippingData['shipping_address'],
            'nameReceiver' => $shippingData['nameReceiver'],
            'phoneReceiver' => $shippingData['phoneReceiver'],
            'shipping_fee' => $shippingData['shipping_fee'],
        ]);

        return $order;
    }

    /**
     * Cập nhật trạng thái đơn hàng
     */
    public function updateOrderStatus($orderId, $status)
    {
        $order = $this->model->findOrFail($orderId);

        // Kiểm tra trạng thái hợp lệ
        $validStatuses = ['pending', 'processing', 'shipped', 'completed', 'cancelled'];

        if (!in_array($status, $validStatuses)) {
            throw new \InvalidArgumentException("Trạng thái đơn hàng không hợp lệ");
        }

        $order->update(['order_status' => $status]);

        return $order;
    }

    /**
     * Cập nhật thông tin thanh toán (payment_status)
     */
    public function updatePaymentStatus($orderId, $paymentStatus)
    {
        $order = $this->model->findOrFail($orderId);

        $validPaymentStatuses = ['pending', 'paid', 'failed'];

        if (!in_array($paymentStatus, $validPaymentStatuses)) {
            throw new \InvalidArgumentException("Trạng thái thanh toán không hợp lệ");
        }

        $order->payment()->update(['payment_status' => $paymentStatus]);

        return $order;
    }

    /**
     * Lấy tất cả đơn hàng của một người dùng
     */
    public function getOrdersByUserId($userId)
    {
        return $this->model->where('user_id', $userId)->get();
    }
}
