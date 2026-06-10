<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Captain;
use App\Traits\ApiResponser;

class CaptainNotificationController extends Controller {

    use ApiResponser;

    public function notifications( $id ) {
        try {
            $captain = Captain::where( 'id', $id )->first();
            $notifications = $captain->notifications;
            return $this->successResponse($notifications, 'All Notifications');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function read( $id, $not ) {
        try {
            $notification = Captain::find( $id )->unreadNotifications->find( $not );
            if ( $notification )
                $notification->markAsRead();
            return $this->successResponse('success' , 'marked as read!');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function delete( $id, $not ) {
        try {
            $notification = Captain::find( $id )->unreadNotifications->find( $not );
            if ( $notification )
                $notification->delete();
            return $this->successResponse('success' , 'deleted!');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        }
    }

}
