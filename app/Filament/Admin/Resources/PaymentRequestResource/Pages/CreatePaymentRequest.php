<?php

namespace App\Filament\Admin\Resources\PaymentRequestResource\Pages;

use App\Filament\Admin\Resources\PaymentRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePaymentRequest extends CreateRecord
{
    protected static string $resource = PaymentRequestResource::class;
}
