<?php
/**
 * Created by PhpStorm.
 * User: Byte7
 * Date: 3/17/2020
 * Time: 11:27 AM
 */
namespace App\Consumers\Notifications;



class Notification_IOS extends  Notifications
{
    private const IOS_SENDER_ID ='';
    private const IOS_SERVER_KEY ='';
    public function set_config()
    {
        config(['fcm.http.sender_id' => self::IOS_SENDER_ID]);
        config(['fcm.http.server_key' => self::IOS_SERVER_KEY]);
        return $this;
    }

}
