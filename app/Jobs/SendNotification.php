<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;


class SendNotification implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $subscribers = null;
    private $notification;
    private $offer_id;

    /**
    * SendEmails constructor.
    * @param  $subscribers
    * @param  $notification
    * @param  $id
    */

    public function __construct( $subscribers,  $notification, $offer_id = 0) {
        $this->subscribers = $subscribers;
        $this->notification = $notification;
        $this->offer_id = $offer_id;
    }

    public function NotificationModels( $type, $data ) {
        // App/Notifications

        $models = [
        ];

        return $models[ "$type" ];
    }

    /**
    * Execute the job.
    *
    * @return void
    */

    public function handle() {
        $subscribers = $this->subscribers;
        Log::info( json_encode( $subscribers ) );
        foreach ( $subscribers as $key => $user ) {
            if ( $user->fcm_token ) {
                $data[ 'fcm_token' ] = $user->fcm_token;
                $data['offer_id'] = $this->offer_id;
                $user->notify( $this->NotificationModels( $this->notification, $data ) );
            }

        }
    }
}
