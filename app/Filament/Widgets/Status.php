<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Product;
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
        $productCount = Product::count();

        // Menghitung total pendapatan selama 7 hari terakhir
        $sevenDaysAgo = Carbon::now()->subDays(7);
        $totalRevenueLast7Days = Order::where('status', 'success')
            ->where('created_at', '>=', $sevenDaysAgo)
            ->sum('total_price');

        return [
            Stat::make('Total User', $buyerCount)->icon('heroicon-o-users'),
            Stat::make('Total Produk', $productCount)->icon('heroicon-o-shopping-bag'),
            Stat::make('Pendapatan 7 Hari Terakhir', number_format($totalRevenueLast7Days, 0))
                ->icon('heroicon-o-currency-dollar'),
        ];
    }
}
