<?php

namespace App\Filament\Admin\Resources\CarouselImageResource\Pages;

use App\Filament\Admin\Resources\CarouselImageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCarouselImages extends ListRecords
{
    protected static string $resource = CarouselImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
