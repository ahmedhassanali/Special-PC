<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;

class FeedbackController extends Controller {

    public function index() {

          $feedbacks = Feedback::all();
        return view( 'admin.feedback.index', compact( 'feedbacks' ) );
    }
}
