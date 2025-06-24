<?php

namespace App\Filament\Organizer\Resources\EventResource\Pages;

use App\Filament\Organizer\Resources\EventResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateEvent extends CreateRecord
{
    protected static string $resource = EventResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['organizer_id'] = Auth::guard('organizer')->id();
        return $data;
    }
}
