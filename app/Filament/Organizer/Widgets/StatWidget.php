<?php

namespace App\Filament\Organizer\Widgets;

use App\Models\Checkout;
use App\Models\Event; // Ensure the model name is capitalized as per convention
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
        // Get the authenticated organizer's ID
        $organizerId = Auth::id();

        return [
            Stat::make('Total Events', Event::where('organizer_id', $organizerId)->where('status', 'approved')->count()),
            Stat::make('Total Checkouts', Checkout::where('organizer_id', $organizerId)->count()),
            Stat::make('Total Revenue', 'NRs. ' . Checkout::where('organizer_id', $organizerId)->sum('total_amount'))
                ->description('Total revenue from all checkouts')
                ->color('success'),
        ];
    }
}
