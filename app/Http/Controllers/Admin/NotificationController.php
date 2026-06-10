<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // index

    public function index()
    {
        $notifications = [];
        return view('admin.notification.index', compact('notifications'));
    }


    public static function send_notification(Request $data)
    {
        $key = \App\Models\Setting::first()->server_key;

        $url = "https://fcm.googleapis.com/fcm/send";
        $header = array(
            "authorization: key=" . $key . "",
            "content-type: application/json",
        );

        $postdata = '{
                    "to": "/topics/livre",
                    "notification": {
                        "title": "' . $data->title . '",
                        "body": "' . $data->message . '",
                        "image" : "' . $data->image . '",
                        "sound": "default"
                    },
                    "data": {
                        "title": "' . $data->title . '",
                        "message": "' . $data->message . '",
                        "image" : "' . $data->image . '",
                        "click_action": "FLUTTER_NOTIFICATION_CLICK"

                    },
                    "apns": {
                        "headers": {
                            "apns-priority": "5"
                        }
                    },
                    "content_available": true,
                    "priority": "high"
                }';


        $ch = curl_init();
        $timeout = 120;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        // Get URL content
        $result = curl_exec($ch);
        // close handle to release resources
        curl_close($ch);

        return $result;
    }
}
