<?php

namespace App\Filament\Organizer\Widgets;

use App\Models\Checkout;
use App\Models\Event;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class StatWidget extends BaseWidget
{
    protected array | string | int $columnSpan = 'full';
    public static ?int $sort = 1;

    protected function getColumns(): int
    {
        return 3;
    }

    protected function getStats(): array
    {
        $organizerId = Auth::id();

        return [
            Stat::make('Total Events', Event::where('organizer_id', $organizerId)->where('status', 'approved')->count()),
            Stat::make('Total Checkouts', Checkout::where('organizer_id', $organizerId)->count()),
            Stat::make('Total Revenue', 'NRs. ' . number_format(Checkout::where('organizer_id', $organizerId)->sum('total_amount'), 2))
                ->description('Total revenue from all checkouts')
                ->color('success'),
        ];
    }
}
