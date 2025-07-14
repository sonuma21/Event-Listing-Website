<?php

namespace App\Filament\Admin\Resources\PaymentRequestResource\Pages;

use App\Filament\Admin\Resources\PaymentRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPaymentRequests extends ListRecords
{
    protected static string $resource = PaymentRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
