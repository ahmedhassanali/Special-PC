<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;

class FeedbackController extends Controller
{
    use ApiResponser;

    public function feedback(Request $request)
    {
        try {

            $feedback = Feedback::where('customer_id', $request->customer_id)->where('product_id', $request->product_id)->first();

                if ($feedback) {
                    $feedback->rating = $request->rating;
                    $feedback->feedback = $request->feedback;
                    $feedback->save();
                    return $this->successResponse($feedback, 'feedback updated successfuly');
                } else {
                    if (isset($request->customer_id)) {
                        $feedback = Feedback::create($request->all());
                        return $this->successResponse($feedback, 'feedback saved successfuly');
                    } else {
                        return $this->errorResponse('sign in is required!', 401);
                    }
                }

        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }

    }
}
