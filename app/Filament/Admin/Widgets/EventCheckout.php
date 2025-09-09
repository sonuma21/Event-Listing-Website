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
        $colors = [];
        $eventData = event::all()->where('status', 'approved')->sortByDesc('created_at');

        // Define an array of colors for the bars
        $colorPalette = [
            'rgba(75, 192, 192, 0.6)', // Cyan
            'rgba(255, 99, 132, 0.6)', // Red
            'rgba(54, 162, 235, 0.6)', // Blue
            'rgba(255, 206, 86, 0.6)', // Yellow
            'rgba(153, 102, 255, 0.6)', // Purple
            'rgba(255, 159, 64, 0.6)', // Orange
            'rgba(199, 199, 199, 0.6)', // Grey
            'rgba(83, 102, 255, 0.6)',  // Indigo
            'rgba(255, 102, 255, 0.6)', // Pink
            'rgba(102, 255, 178, 0.6)', //
        ];

        foreach ($eventData as $index => $event) {
            $events[] = $event->title;
            $checkouts[] = $event->checkouts()->sum('quantity');
            // Assign a color from the palette, cycling through if more events than colors
            $colors[] = $colorPalette[$index % count($colorPalette)];
        }

        return [
            'datasets' => [
                [
                    'label' => 'Tickets Sold',
                    'data' => $checkouts,
                    'backgroundColor' => $colors,
                    'borderColor' => array_map(function ($color) {
                        // Convert rgba to solid color for borders by removing opacity
                        return str_replace('0.6', '1', $color);
                    }, $colors),
                    'borderWidth' => 1,
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
