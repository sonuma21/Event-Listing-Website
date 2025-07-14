<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Checkout;
use App\Models\event;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
             Stat::make('Total Events', event::where('status', 'approved')->count())
                ->icon('heroicon-o-calendar'),
            Stat::make('Total Tickets sold', Checkout::sum('quantity'))
                ->icon('heroicon-o-ticket'),
            Stat::make('Total Revenue', 'NRs. ' . number_format(Checkout::sum('total_amount'), 2))
                ->icon('heroicon-o-currency-rupee'),

        ];
    }
}
