<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Complain;

class ComplainStatsOverview extends ChartWidget
{
    protected static ?string $heading = 'उजुरी स्थिति विवरण (Complain Status Overview)';

    protected function getData(): array
    {
        $statuses = [
            'Processing',
            'Holding',
            'Finished',
        ];

        $data = [];

        foreach ($statuses as $status) {
            $data[] = Complain::where('status', $status)->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Complain Statuses',
                    'data' => $data,
                    'backgroundColor' => ['#f59e0b', '#6366f1', '#10b981'], // Amber, Indigo, Green
                ],
            ],
            'labels' => $statuses,
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
