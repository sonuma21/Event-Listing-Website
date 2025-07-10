<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Checkout;
use App\Models\event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;

class CheckoutController extends Controller
{
    public function __construct()
    {

        $categories = Category::all();
        $latest_events = event::where('status', 'approved')->orderBy('id', 'desc')->limit(5)->get();
        View::share([
            'categories' => $categories,
            'latest_events' => $latest_events

        ]);
    }
    public function checkout(Request $request)
    {



        $checkout = new Checkout();
        $checkout->status = $request->total_amount == 0 ? 'completed' : 'pending';
        $checkout->quantity = $request->quantity;
        $checkout->total_amount = $request->total_amount;
        $checkout->organizer_id = $request->organizer_id;
        $checkout->user_id = Auth::user()->id;
        $checkout->event_id = $request->event_id;
        $checkout->payment_method = $request->total_amount == 0 ? 'NULL' : 'khalti';
        $checkout->save();

        Cookie::queue('checkout_id', $checkout->id);

        // Handle free event (total_amount is 0)
        if ($request->total_amount == 0) {
            toast("You have successfully registered for the free event!", "success");
            return redirect('/');
        }

        $response = Http::withHeaders([
            "Authorization" => "key d3b800cbd0934388abad40ab36069ed5",
            'Content-Type' => 'application/json'
        ])->post(
            'https://dev.khalti.com/api/v2/epayment/initiate/',
            [
                'return_url' => route('khalti_callback'),
                'website_url' => route('home'),
                'amount' => $request->total_amount * 100,
                'purchase_order_id' => $checkout->id,
                'purchase_order_name' => $checkout->organizer->name,

            ]
        );
        if ($response->successful()) {
            $paymentUrl = $response['payment_url'];
            return redirect($paymentUrl);
        } else {
            return back()->with('error', 'Failed to initiate khalti payment');
        }
    }

    public function khalti_callback(Request $request)
    {
        $response = Http::withHeaders([
            "Authorization" => "key d3b800cbd0934388abad40ab36069ed5",
            'Content-Type' => 'application/json'
        ])->post(
            'https://dev.khalti.com/api/v2/epayment/lookup/',
            [

                'pidx' => $request['pidx']
            ]
        );
        if ($response["status"] == "Completed") {
            $checkout_id = Cookie::get('checkout_id');
            $checkout = Checkout::find($checkout_id);
            $checkout->status = 'paid';
            $checkout->save();

            toast("Payment successful! Your invoice is ready for download.", "success");
            return redirect()->route('invoice', $checkout->id);
        }
        toast("Payment verification failed.", "error");
        return redirect('/');
    }
    public function index()
    {
        $checkouts = Checkout::where('user_id', Auth::id())
            ->with('event')
            ->latest()
            ->get();

        return view('frontend.checkout-history', compact('checkouts'));
    }

    public function voucher(Checkout $checkout)
    {
        if ($checkout->user_id !== Auth::id()) {
            return redirect()->route('checkout.history')->with('error', 'Unauthorized access.');
        }

        return view('checkout.invoice', compact('checkout'));
    }
}
