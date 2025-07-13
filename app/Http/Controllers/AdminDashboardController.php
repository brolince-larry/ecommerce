<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
  //count total registerd customer
  public function index()
  {

    $totalCustomers = User::where('role', 2)->count();

    //count total paid orders
    $paidOrdersCount = Order::where('status', 'paid')->count();
    //chart data
    $allMonths = collect(range(1, 12))->mapWithKeys(fn($month)=>[$month=>0]);
    $monthlyOrders = Order::selectRaw('MONTH(created_at)as month, CAST(COUNT(*) AS DECIMAL(10,1)) as total')
      ->whereYear('created_at', now()->year)
      ->groupBy('month')
      ->pluck('total', 'month');
      $defaultRoles = collect([
    0 => 'admin',
    1 => 'seller',
    2 => 'customer',
]);

$userRoleCountRaw = User::select('role', DB::raw('count(*) as total'))
    ->groupBy('role')
    ->pluck('total', 'role');

$userRoleCount = $defaultRoles->mapWithKeys(function ($roleName, $roleId) use ($userRoleCountRaw) {
    return [$roleName => (int) ($userRoleCountRaw[$roleId] ?? 0)];
});
    $monthlyRevenue = Order::selectRaw('MONTH(created_at) as month, SUM(total) as revenue')
    //->where('status', 'paid')
    ->whereYear('created_at', now()->year)
    ->groupBy('month')
    ->pluck('revenue', 'month');

$monthlyRevenue = collect(range(1, 12))
    ->mapWithKeys(fn($m) => [$m => (float) ($monthlyRevenue[$m] ?? 0)]);

    return view('admin.dashboard', [
      'totalCustomers'=> $totalCustomers,
       'paidOrdersCount'=> $paidOrdersCount,
       'monthlyOrders'=> $monthlyOrders,
       'monthlyRevenue'=>$monthlyRevenue,
       'userRoleCounts'=>$userRoleCount,
    ]);
  }
}
