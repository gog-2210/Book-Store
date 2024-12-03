<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Payment;
use App\Models\User;

class DashboardService
{
    public function getRevenueByDate($date)
    {
        return Payment::whereHas('orders', function ($query) use ($date) {
            $query->whereDate('created_at', $date)
                ->where('order_status', 'delivered');
        })->sum('amount');
    }

    public function getRevenueByMonth($month, $year)
    {
        return Payment::whereHas('orders', function ($query) use ($month, $year) {
            $query->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->where('order_status', 'delivered');
        })->sum('amount');
    }

    public function getRevenueByYear($year)
    {
        return Payment::whereHas('orders', function ($query) use ($year) {
            $query->whereYear('created_at', $year)
                ->where('order_status', 'delivered');
        })->sum('amount');
    }

    public function getOrderStatistics()
    {
        return [
            'pending' => Order::where('order_status', 'pending')->count(),
            'delivered' => Order::where('order_status', 'delivered')->count(),
            'canceled' => Order::where('order_status', 'canceled')->count(),
            'total' => Order::count(),
        ];
    }

    public function getLatestOrders($limit = 5)
    {
        return Order::orderBy('created_at', 'desc')->take($limit)->get();
    }

    public function getNewCustomersByDate($date)
    {
        return User::whereDate('created_at', $date)->count();
    }
}
