<?php

namespace App\Services;

use App\Models\Cart;

class CartService
{
    protected $model;

    public function __construct(Cart $cart)
    {
        $this->model = $cart;
    }

    public function getCartById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function getCartByIds($ids)
    {
        return $this->model->whereIn('id', $ids)->get();
    }

    public function getCart()
    {
        return $this->model->where('user_id', auth()->id())->get();
    }

    public function addToCart($data)
    {
        $data['user_id'] = auth()->id();
        if ($cart = $this->model->where('user_id', $data['user_id'])->where('book_id', $data['book_id'])->first()) {
            $cart->quantity += $data['quantity'];
            return $cart->save();
        }
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

    public function deleteByUserId($userId)
    {
        return $this->model->where('user_id', $userId)->delete();
    }

    public function deleteAll()
    {
        return $this->model->where('user_id', auth()->id())->delete();
    }
}
