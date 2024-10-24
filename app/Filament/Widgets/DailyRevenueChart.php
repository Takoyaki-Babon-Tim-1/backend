<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class DailyRevenueChart extends ChartWidget
{
    protected static ?string $heading = 'Chart Pendapatan';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        // Inisialisasi data pendapatan per hari
        $dailyRevenue = [];

        // Mengambil pendapatan dari 7 hari terakhir
        $startDate = Carbon::now()->subDays(7);
        $endDate = Carbon::now();

        // Iterasi setiap hari dalam rentang waktu tersebut
        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $dailyRevenue[$date->format('Y-m-d')] = Order::where('status', 'success')
                ->whereDate('created_at', $date)
                ->sum('total_price');
        }

        // Mengembalikan data chart
        return [
            'labels' => array_keys($dailyRevenue), // Label untuk setiap hari
            'datasets' => [
                [
                    'label' => 'Pendapatan', // Label pada dataset
                    'data' => array_values($dailyRevenue), // Data pendapatan harian
                    'borderColor' => '#4CAF50', // Warna garis
                    'backgroundColor' => 'rgba(76, 175, 80, 0.1)', // Warna latar belakang
                    'fill' => true, // Mengisi area di bawah garis
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
