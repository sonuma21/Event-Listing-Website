<?php

namespace App\Filament\Organizer\Resources\PaymentRequestResource\Pages;

use App\Filament\Organizer\Resources\PaymentRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPaymentRequest extends EditRecord
{
    protected static string $resource = PaymentRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
