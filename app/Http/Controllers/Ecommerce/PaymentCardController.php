<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\PaymentCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentCardController  extends Controller
{

    public function store(Request $request)
    {
        $customer =  Auth::guard('ecommerce')->user();
        $paymentCardData = $request->only(['name', 'card_number', 'expire_date', 'cvv', 'default']);

        if (isset($paymentCardData['default'])) {
            $paymentCardData['default'] = 1 ;
            $customer->paymentCards()->update(['default' => false]);
        }

        $paymentCard = $customer->paymentCards()->create($paymentCardData);

        return redirect()->back()->with('success', 'Payment card added successfully.');
    }

    public function destroy($id)
    {
        $paymentCard = PaymentCard::find($id);
        $paymentCard->delete();
        return redirect()->back()->with('success', 'Payment card deleted successfully.');
    }
}
