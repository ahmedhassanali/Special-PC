<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class NotificationController extends Controller
{

    public function markAsRead()
    {
        auth()->user()->notifications->markAsRead();
        return redirect()->back();
    }

    public function markAsAllRead()
    {
        $notifications = auth()->user()->unreadNotifications;
        foreach ($notifications as $notification) {
            $notification->markAsRead();
        }
        return redirect()->back();
    }

    public function notification($id)
    {
        $notification = auth()->user()->unreadNotifications->find($id);
        if ($notification) {
            $notification->markAsRead();
        }

        // $data = $notification->data;
        // $redirect = $data['url'];

        return redirect()->back();
    }

    // get unread notifications
    public function unread()
    {
        $notifications = auth()->user()->unreadNotifications;
        $notes = '';
        foreach ($notifications as $notification) {
            $data = $notification->data;
            $data['message'] = $notification->data['message'];
            $data['status'] = $notification->data['status'];
            $data['url'] = isset($notification->data['url']) ? $notification->data['url'] : '';
            $notes .= '<li><a href="' . route('notification.notification', $notification->id) . '" class="list-group-item-action border-0 border-bottom d-flex p-3">'
                . '<div class="me-3">'
                . '   <div class="avatar avatar-md">'
                . '     <i class="bi bi-bell fa-fw"></i>'
                . ' </div>'
                . '</div>'
                . '<div>'
                . '  <p class="text-body small m-0">'
                . __($data['message'])
                . ' </p>'

                . ' </div>'
                . ' </a>'
                . '</li>';
        }

        return  $notes;
    }
}
