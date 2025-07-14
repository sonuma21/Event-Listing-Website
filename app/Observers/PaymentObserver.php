<?php

namespace App\Observers;

use App\Mail\PaymentApprovedNotification;
use App\Models\PaymentRequest;
use App\Models\Organizer;
use Illuminate\Support\Facades\Mail;

class PaymentObserver
{
    public function created(PaymentRequest $payment): void
    {
        //
    }


    public function updated(PaymentRequest $paymentRequest): void
    {
        if ($paymentRequest->isDirty('status') && $paymentRequest->status == 'approved') {
            $organizer = Organizer::find($paymentRequest->organizer_id);

            $data = [
                'name' => $organizer->name,
                'email' => $organizer->email,
                'phone' => $organizer->phone,
                'amount' => $paymentRequest->amount,
                'bank_account_number' => $paymentRequest->bank_account_number,
            ];

            Mail::to($organizer->email)->send(new PaymentApprovedNotification($data));
        
        }
    }


    /**
     * Handle the PaymentRequest "deleted" payment$payment.
     */
    public function deleted(PaymentRequest $payment): void
    {
        //
    }

    /**
     * Handle the PaymentRequest "restored" payment$payment.
     */
    public function restored(PaymentRequest $payment): void
    {
        //
    }

    /**
     * Handle the PaymentRequest "force deleted" payment$payment.
     */
    public function forceDeleted(PaymentRequest $payment): void
    {
        //
    }
}
