<?php

namespace App\Filament\Admin\Widgets;

use App\Models\event;
use Filament\Widgets\ChartWidget;

class EventCheckout extends ChartWidget
{
    protected static ?string $heading = 'Chart';
    protected array | string | int $columnSpan = 'full';
    public static ?int $sort = 2;




    protected function getData(): array
    {
        $events = [];
        $checkouts = [];
        $eventData = event::all()->where('status', 'approved')->sortByDesc('created_at');
        foreach ($eventData as $event) {
            $events[] = $event->title;
            $checkouts[] = $event->checkouts()->sum('quantity');
        }
        return [

            'datasets' => [
                [
                    'label' => 'Tickets Sold',
                    'data' => $checkouts,
                ],
            ],
            'labels' => $events,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
