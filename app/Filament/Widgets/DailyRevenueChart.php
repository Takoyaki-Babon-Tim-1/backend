<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class DailyRevenueChart extends ChartWidget
{
    protected static ?string $heading = 'Pendapatan';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $dailyRevenue = [];

        $startDate = Carbon::now()->subDays(7);
        $endDate = Carbon::now();

        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $dailyRevenue[$date->format('Y-m-d')] = Order::where('status', 'success')
                ->whereDate('created_at', $date)
                ->sum('total_price');
        }

        return [
            'labels' => array_keys($dailyRevenue), 
            'datasets' => [
                [
                    'label' => 'Pendapatan', 
                    'data' => array_values($dailyRevenue), 
                    'fill' => 'start', 
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
