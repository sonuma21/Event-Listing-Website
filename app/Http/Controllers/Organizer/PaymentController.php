<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use App\Models\PaymentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentRequestNotification;

class PaymentController extends Controller
{
    public function request_payment(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'bank_name' => 'required|string',
            'bank_account_name' => 'required|string',
            'bank_account_number' => 'required|numeric',
            'amount' => [
                'required',
                'numeric',
                'min:1',
                'max:' . Checkout::where('organizer_id', Auth::id())->sum('total_amount'),
            ],
        ]);

        // Create a payment request record
        $paymentRequest = new PaymentRequest();
        $paymentRequest->bank_name = $request->bank_name;
        $paymentRequest->bank_account_name = $request->bank_account_name;
        $paymentRequest->bank_account_number = $request->bank_account_number;
        $paymentRequest->amount = $request->amount;
        $paymentRequest->organizer_id = Auth::id();
        $paymentRequest->save();


        $data = [
            'bank_name' => $paymentRequest->bank_name,
            'bank_account_name' => $paymentRequest->bank_account_name,
            'bank_account_number' => $paymentRequest->bank_account_number,
            'amount' => $paymentRequest->amount,
            'name' => $paymentRequest->organizer->name,
            'email' => $paymentRequest->organizer->email,
            'phone' => $paymentRequest->organizer->phone,
        ];

       Mail::to("sonumalmb@gmail.com")->queue(new PaymentRequestNotification($data));
        return response()->json([
            'message' => 'Payment request submitted successfully',
        ], 200);
    }
}
