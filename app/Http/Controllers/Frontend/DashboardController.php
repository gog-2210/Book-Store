<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $date = $request->input('date', Carbon::today()->toDateString());
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);

        $revenueToday = $this->dashboardService->getRevenueByDate($date);
        $revenueThisMonth = $this->dashboardService->getRevenueByMonth($month, $year);
        $revenueThisYear = $this->dashboardService->getRevenueByYear($year);

        $orderStatistics = $this->dashboardService->getOrderStatistics();
        $latestOrders = $this->dashboardService->getLatestOrders();
        $newCustomersToday = $this->dashboardService->getNewCustomersByDate($date);

        return view('admin.index', [
            'revenueToday' => $revenueToday,
            'revenueThisMonth' => $revenueThisMonth,
            'revenueThisYear' => $revenueThisYear,
            'pendingOrders' => $orderStatistics['pending'],
            'deliveredOrders' => $orderStatistics['delivered'],
            'canceledOrders' => $orderStatistics['canceled'],
            'totalOrders' => $orderStatistics['total'],
            'latestOrders' => $latestOrders,
            'newCustomersToday' => $newCustomersToday,
        ]);
    }
}
