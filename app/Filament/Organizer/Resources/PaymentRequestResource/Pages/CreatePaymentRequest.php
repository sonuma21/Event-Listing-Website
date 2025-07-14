<?php

namespace App\Filament\Organizer\Resources\PaymentRequestResource\Pages;

use App\Filament\Organizer\Resources\PaymentRequestResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Organizer\PaymentController;
use App\Models\PaymentRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CreatePaymentRequest extends CreateRecord
{
    protected static string $resource = PaymentRequestResource::class;

    protected function handleRecordCreation(array $data): Model
{
    $data['organizer_id'] = Auth::id();
    $request = new Request($data);
    $controller = new PaymentController();
    $response = $controller->request_payment($request);

    if ($response->getStatusCode() === 200) {
        toast('success', 'Payment request sent to admin successfully.');

        // Retrieve the payment request you created in the controller
        return PaymentRequest::latest()
            ->where('organizer_id', Auth::id())
            ->first();
    }

    toast('error', 'Failed to send payment request.');
    // Halt creation so no duplicate is saved
    $this->halt();

    // Optionally, throw an exception or return a dummy model to satisfy return type
    // throw new \RuntimeException('Payment request creation halted.');
    return new PaymentRequest(); // or return null and change return type to ?Model
}

}
