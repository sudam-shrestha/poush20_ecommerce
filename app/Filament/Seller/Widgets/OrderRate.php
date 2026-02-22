<?php

namespace App\Filament\Seller\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderRate extends ChartWidget
{
    protected ?string $heading = 'Order Rate';

    protected string|array|int $columnSpan = 'full';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $sellerId = Auth::guard('seller')->id();

        // Get orders count grouped by month for the current year
        $currentYear = Carbon::now()->year;

        $ordersByMonth = Order::where('seller_id', $sellerId)
            ->whereYear('created_at', $currentYear)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Prepare data for all 12 months (fill missing months with 0)
        $data = [];
        for ($month = 1; $month <= 12; $month++) {
            $data[] = $ordersByMonth[$month] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label'       => 'Orders',
                    'data'        => $data,
                    'backgroundColor' => '#3b82f6',     // blue-500 (or use your --primary-color if you extract it)
                    'borderColor'     => '#2563eb',     // blue-600
                    'borderWidth'     => 1,
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    // Optional: nicer look / tooltips
    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'stepSize' => 5,           // adjust based on your typical order volume
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'top',
                ],
                'tooltip' => [
                    'enabled' => true,
                ],
            ],
        ];
    }
}
