<?php

namespace App\Http\Controllers;

class NotificationController extends Controller {

    public function index() {
        return [
            'read'   => auth()->user()->readNotifications,
            'unread' => auth()->user()->unReadNotifications,
        ];
    }
}
