<?php
/**
 * Created by PhpStorm.
 * User: Byte7
 * Date: 3/17/2020
 * Time: 11:27 AM
 */

namespace App\Consumers\Notifications;


class Notification_ANDROID extends Notifications
{
    private const ANDROID_SENDER_ID ='768504406904';
    private const ANDROID_SERVER_KEY ='AAAAsu5uo3g:APA91bHQDxiM2PudD9XBMmd2PEt-tN6ZVQv61mLfwt8mz7HTUjsqj2czsAxHwZB1i1EjxK8ESANSsJ9rJ7wTs-eoUpu_qp_111UkYdcng-fyGodn4CtxX-WSy6S8X6MmEkjIg08utwik';
    public function set_config()
    {
        config(['fcm.http.sender_id' => self::ANDROID_SENDER_ID]);
        config(['fcm.http.server_key' => self::ANDROID_SERVER_KEY]);
        return $this;
    }
}
