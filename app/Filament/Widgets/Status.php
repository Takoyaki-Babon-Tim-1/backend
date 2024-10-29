<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Status extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $buyerCount = User::role('buyer')->count();

        $dailyRevenues = [];
        $todayRevenue = 0;
        $startDate = Carbon::today()->subDays(6);
        $currentDate = Carbon::today();

        $dailyOrders = [];
        $todayOrders = 0;

        while ($startDate->lte($currentDate)) {
            $revenue = Order::where('status', 'success')
                ->whereDate('created_at', $startDate)
                ->sum('total_price');

            $dailyRevenues[] = $revenue;

            if ($startDate->isToday()) {
                $todayRevenue = $revenue;
            }

            $orderCount = Order::where('status', 'success')
                ->whereDate('created_at', $startDate)
                ->count();

            $dailyOrders[] = $orderCount;

            if ($startDate->isToday()) {
                $todayOrders = $orderCount;
            }

            $startDate->addDay();
        }

        $yesterdayRevenue = $dailyRevenues[count($dailyRevenues) - 2] ?? 0;
        $yesterdayOrders = $dailyOrders[count($dailyOrders) - 2] ?? 0;

        $revenueChange = $yesterdayRevenue > 0
            ? round((($todayRevenue - $yesterdayRevenue) / $yesterdayRevenue) * 100, 2)
            : 0;
        $orderChange = $yesterdayOrders > 0
            ? round((($todayOrders - $yesterdayOrders) / $yesterdayOrders) * 100, 2)
            : 0;

        $revenueDescription = $revenueChange > 0 ? "{$revenueChange}% increase" : "{$revenueChange}% decrease";
        $revenueIcon = $revenueChange > 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down';
        $revenueColor = $revenueChange > 0 ? 'success' : 'danger';

        $orderDescription = $orderChange > 0 ? "{$orderChange}% increase" : "{$orderChange}% decrease";
        $orderIcon = $orderChange > 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down';
        $orderColor = $orderChange > 0 ? 'success' : 'danger';

        return [
            Stat::make('Total Customer', $buyerCount)
                ->icon('heroicon-o-users'),

            Stat::make('Total Order', $todayOrders)
                ->description($orderDescription)
                ->descriptionIcon($orderIcon)
                ->color($orderColor)
                ->chart($dailyOrders)
                ->icon('heroicon-o-banknotes'),

            Stat::make('Pendapatan Hari Ini', 'Rp ' . number_format($todayRevenue, 0, ',', '.'))
                ->description($revenueDescription)
                ->descriptionIcon($revenueIcon)
                ->color($revenueColor)
                ->chart($dailyRevenues)
                ->icon('heroicon-o-currency-dollar'),
        ];
    }
}
