<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
             Stat::make('Total Events', 100),
            Stat::make('Total Checkouts', 200),
            Stat::make('Total Revenue', 'NRs. 500,000'),
        ];
    }
}
