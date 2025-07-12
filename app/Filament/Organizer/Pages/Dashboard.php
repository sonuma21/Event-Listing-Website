<?php

namespace App\Filament\Organizer\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected function getHeaderWidgets(): array
    {
        return [\App\Filament\Organizer\Widgets\StatWidget::class,];
    }
    protected function getFooterWidgets(): array
    {
        return [\App\Filament\Organizer\Widgets\RecentCheckout::class,];
    }
}
