<?php
/**
 * Created by PhpStorm.
 * User: Byte7
 * Date: 3/17/2020
 * Time: 11:41 AM
 */

namespace App\Consumers\Notifications;

use App\Models\NotificationUser\NotificationUser;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use App\Models\UserToken\UserToken;
use LaravelFCM\Response\DownstreamResponse;

abstract class Notifications
{
    public abstract function set_config ();
    public function send(NotificationUser $notificationUser, array $tokens)
    {
        $optionBuilder = new OptionsBuilder();;
        $optionBuilder->setTimeToLive(60 * 20);
        $notificationBuilder = new PayloadNotificationBuilder($notificationUser->title);
        $notificationBuilder->setBody($notificationUser->description)
            ->setSound('default');
        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['title' => $notificationUser->title,'body' => $notificationUser->description]);
        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();
        $downstreamResponse = FCM::getFacadeRoot()->sendTo($tokens, $option, $notification, null);
        return $downstreamResponse;
    }

//    public function handle_results(DownstreamResponse $downstreamResponse, $notification_id, $num_sent_to )
//    {
//        if (!$downstreamResponse)
//            return null;
//        $numberSuccess = $downstreamResponse->numberSuccess();
//        $numberFailure = $downstreamResponse->numberFailure();
//        $numberModification = $downstreamResponse->numberModification();
//
//        // return Array - you must remove all this tokens in your database
//        $tokensToDelete = $downstreamResponse->tokensToDelete();
//
//        // return Array (key : oldToken, value : new token - you must change the token in your database)
//        $tokensToModify = $downstreamResponse->tokensToModify();
//
//        // return Array - you should try to resend the message to the tokens in the array
//        $tokensToRetry = $downstreamResponse->tokensToRetry();
//
//        // return Array (key:token, value:error) - in production you should remove from your database the tokens present in this array
//        $tokensWithError = $downstreamResponse->tokensWithError();
//
////        $log = NotificationLogs::create([
////            'notification_id' => $notification_id,
////            'number_sent_to' => $num_sent_to,
////            'number_success' => $numberSuccess,
////            'number_failure' => $numberFailure,
////            'number_modification' => $numberModification,
////            'tokens_to_delete' => json_encode($tokensToDelete),
////            'tokens_to_modify' => json_encode($tokensToModify) ,
////            'tokens_to_retry' => json_encode($tokensToRetry),
////            'tokens_with_errors' => json_encode($tokensWithError),
////        ]);
//
//        return $log;
//    }
}
